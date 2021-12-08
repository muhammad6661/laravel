<?php

namespace App\Http\Controllers\Admin;
use App\Models\PhotoGallery;
use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class PhotoGalleryController extends Controller
{
   public function index(){
       return view('admin.photogallery.index',[
           'photoes'=>Photo::orderBy('created_at','desc')->paginate(15),
       ]);
   }

   public function create(){
       return view('admin.photogallery.create');
   }

   public function uploadGaleryToTemp(Request $request){
    return response()->json(['img'=>$this->uploadFile('temp',$request->file('image'))]);
   }
    public function unlinkGaleryFromTemp(Request $request){
        $this->unlinkFile('public/temp/'.$request->get('image'));
    return response([]);
   }

   public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'date'=>'required',
            'title_ru'=>'required',
            'slug'=>'required|unique:photos',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=20,min_height=20',

        ],[
                'date.required'=>'Введите дата активность!',
                'slug.required'=>'Введите Слаг!',
                'slug.unique'=>'Слаг должен быть уникальний!',
                'title_ru.required'=>'Введите заголовок RU!',
                'image.required'=>'Загрузить картинку',
                'image.image' => 'Эй, вы че? Загрузите картину!',
                'image.dimensions' => 'Картина доллжна быть 1920x400 px',
                'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'image.max' => 'Размер картины должна быть менее 2 МБ',
        ]);

         if(count($validator->errors())>0){
             $msg="";
             foreach($validator->errors()->all() as $item){
                 $msg=$msg."<p>".$item."</p>";
             }
             return response()->json(['err'=>1,'msg'=>$msg],200);
         }
       $input=$request->all();
       $input['image']=$this->uploadFile('/uploads/galleries',$request->file('image'));
       $photo=Photo::create($input);
       $galleries=explode(',',$input['galleries']);
       foreach($galleries as $item){
           if($galleries==""){
               continue;
           }
           $name=$item.time().'.'.File::extension('public/temp/'.$item);
           File::copy('public/temp/'.$item,'public/uploads/galleries/'.$name);
           $this->unlinkFile('public/temp/'.$item);
           PhotoGallery::create(['photo_id'=>$photo->id,'image'=>$name]);
       }
       Session::flush('success_message','Успешно сохранено');
       return response()->json(['err'=>0],200);
   }

   public function edit($id){
       return view('admin.photogallery.edit',[
           'photo'=>Photo::findOrFail($id),
       ]);
   }

   public function delete_gallery($id){

       $gallery=PhotoGallery::findORFail($id);
       $this->unlinkFile('public/uploads/galleries/'.$gallery->image);
       $gallery->delete();
       return response([]);
   }
   public function update(Request $request,$id){
    $photo=Photo::findORFail($id);
       $this->validate($request,[
        'date'=>'required',
        'title_ru'=>'required',
        'slug'=>'required|unique:photos,slug,'.$id .'',

       ],[
        'date.required'=>'Введите дата активность!',
        'slug.required'=>'Введите Слаг!',
        'slug.unique'=>'Слаг должен быть уникальний!',
        'title_ru.required'=>'Введите заголовок RU!',

       ]);
    $input=$request->all();

    if($photo->image==""||$request->file('image')!=""){
        $this->validate($request,[
        'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=20,min_height=20',
        ],
    [
        'image.required'=>'Загрузить картинку',
        'image.image' => 'Эй, вы че? Загрузите картину!',
        'image.dimensions' => 'Картина доллжна быть 1920x400 px',
        'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
        'image.max' => 'Размер картины должна быть менее 2 МБ',
    ]);
     $input['image']=$this->uploadFile('uploads/galleries',$request->file('image'),null,$photo->image);
    }
   $photo->update($input);
   return redirect('/admin/photogalleries/'.(isset($_COOKIE['pageurl'])? $_COOKIE['pageurl'] : ''))->with(['success_message'=>'Успешно сохранено']);
}

   public function uploadsGallery(Request $request,$id){
    $input['image']=$this->uploadFile('uploads/galleries',$request->file('image'));
    $input['photo_id']=$id;
    $gallery=PhotoGallery::create($input);
    return response()->json(['img'=>$input['image'],'id'=>$gallery->id],200);
   }

   public function active($id){
       $photo=Photo::findOrFail($id);
       $photo->is_active=!$photo->is_active;
       $photo->save();
       return response()->json($photo->is_active,200);
   }

   public function destroy($id){
       $photo=Photo::findOrFail($id);
       foreach($photo->galleries()->get() as $item){
           $this->unlinkFile('public/uploads/galleries/'.$item->image);
           $item->delete();
       }
       $photo->delete();
       return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
   }

}

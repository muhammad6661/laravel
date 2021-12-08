<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use App\Models\Log;

class VideoGalleryController extends Controller
{
    //
    public function index(){
        $videogalleries=VideoGallery::orderBy('created_at','desc')->paginate(15);

        return view ('admin.videogallery.index', compact('videogalleries'));
    }

    public function edit($id){
        // $link=UsefullLink::where('id',$id)->firstOrFail();                   //same
        $videogallery=VideoGallery::findorfail($id);

        return view('admin.videogallery.edit',compact('videogallery'));
    }

    public function create(){
        return view('admin.videogallery.create');
    }


    public function store(Request $request){
        $this->validate($request,[
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=40,min_height=40',
        ],[
            'image.required'=>'Загрузить картинку',
            'image.dimensions' => 'Картина доллжна быть 40x40 px',
            'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
            'image.max' => 'Размер картины должна быть менее 2 МБ',
            'image.image' => 'Эй, вы че? Загрузите картину!',
        ]);
        $input=$request->all();
        $input['image']=$this->uploadFile('uploads/videogalleries',$request->file('image'));
        $video=VideoGallery::create($input);

        Log::create(["user_id"=>Auth::user()->id,"text"=>"Строка номера ".$video->id." добавлен в таблице VideoGalleys"]);
       return redirect('/admin/videogalleries')->with(['success_message'=>'Успешно добавлено!']);
    }



    public function update(Request $request,$id){
        $video=VideoGallery::findOrFail($id);
        $input=$request->all();
        if($video->image==""|| $request->file('image')!=""){
        $this->validate($request,[
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=40,min_height=40',
        ],[
            'image.required'=>'Загрузить картинку',
            'image.dimensions' => 'Картина доллжна быть 40x40 px',
            'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
            'image.max' => 'Размер картины должна быть менее 2 МБ',
            'image.image' => 'Эй, вы че? Загрузите картину!',
        ]);
        $input['image']=$this->uploadFile('uploads/videogalleries',$request->file('image'),null,$video->image!=""? $video->image : null);
         }
        $video->update($input);
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Строка номера ".$video->id." редактирован в таблице VideoGalley"]);
        return redirect('/admin/videogalleries/')->with(['success_message'=>'Успешно сохранено!']);
    }


    public function delete($id){
        $video=VideoGallery::findOrFail($id);
         if($video->image!=""){
           unlink('public/uploads/videogalleries/'.$video->image);
         }
        $video->delete();
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Строка номера ".$id." удален из таблици VideoGalley"]);
        return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
    }

    public function active($id){
        $video=VideoGallery::findorFail($id);
        $is_active=$video->is_active?' деактивирована': ' активирована';
        $video->is_active=!$video->is_active;
        $video->save();
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Ссылка номера ".$video->id. $is_active]);
        return response()->json($video->is_active, 200);

    }

}

<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use App\Models\Ministry;
use App\Models\User;
use App\Models\Shareholder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(){
        $categories=Category::orderBy('created_at','desc')->paginate(15);
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request){
        $input=$request->all();
        $validator=Validator::make($request->all(),
        [
            'slug'=>'required|unique:categories',
        ],
        [
            'slug.required'=>'Введите слаг!',
            'slug.required'=>'Слаг должен бить уникальным!',
        ]);

        if(count($validator->errors())){
            $msg="";
            foreach($validator->errors()->all() as $item){
                $msg=$msg.'<p>'.$item.'</p>';
            }
            return response()->json(['err'=>1,'msg'=>$msg],200);
        }

        if(isset($input['image'])){
            $input['image']=$this->uploadFile('uploads/category',$request->file('image'));
        }
       Category::create($input);
       Session::flash('success_message','Успешно добавлено!');
       return response()->json(200);
    }


    public function edit($id){
        $category=Category::findOrFail($id);
        $html=View::make('admin.category._edit',compact('category'))->render();
        return response()->json(['err'=>0,'html'=>$html],200);
    }

    public function update(Request $request,$id){
        $category=Category::findOrFail($id);
        $validator=Validator::make($request->all(),
        [
            'slug'=>'required|unique:categories,slug,'.$id,
        ],
        [
            'slug.required'=>'Введите слаг!',
            'slug.required'=>'Слаг должен бить уникальным!',
        ]);

        if(count($validator->errors())){
            $msg="";
            foreach($validator->errors()->all() as $item){
                $msg=$msg.'<p>'.$item.'</p>';
            }
            return response()->json(['err'=>1,'msg'=>$msg],200);
        }

        $input=$request->all();
        if(isset($input['image'])){
            $input['image']=$this->uploadFile('uploads/category',$request->file('image'),null,$category->image!="" ? $category->image: null);
        }
        $category->update($input);

         Session::flash('success_message','Успено сохранено!');
         return response()->json(200);
    }

    public function active($id){
        $category=Category::findOrFail($id);
        $category->is_active=!$category->is_active;
        $category->save();
        return response()->json($category->is_active,200);
    }

    public function destroy($id){
        $category=Category::findOrFail($id);
        foreach($category->organizations()->get() as $item){
            $item->shareholders()->delete();
            $item->delete();
        }
        if($category->image!=""){
            $this->unlinkFile('public/uploads/category/'.$category->image);
        }
        $category->delete();
        return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
    }

    public function organizations($slug){
        $ministry=0;
        $category=Category::where('slug',$slug)->first();
         if(isset($_COOKIE['ministry'])){
             $ministry=$_COOKIE['ministry'];
         }
         $orgs=Organization::where('category_id',$category->id);
         $user=User::where('ministry_id',$ministry)->first();
         if($ministry!=0&&$user!=""){
             $orgs->where('user_id',$user->id??'');
         }
         $organizations=$orgs->orderBy('created_at','desc')->paginate(20);
         $ministries=Ministry::all();
         return view('admin.category.organization',compact('category','organizations','ministries'));
    }

    public function edit_organization($cat_slug,$org_id){
        $organization=Organization::findOrFail($org_id);
        $category=Category::where('slug',$cat_slug)->firstOrFail();
        $ministries=Ministry::orderBy('title_ru','asc')->get();
        return view('admin.category.edit_organization',compact('organization','category','ministries'));
    }

    public function shareholders($cat_slug,$org_id){
        $category=Category::where('slug',$cat_slug)->firstOrFail();
        $organization=Organization::findORFail($org_id);
        $shares=Shareholder::where('organization_id',$org_id)->paginate(15);
        return view('admin.category.shareholders',compact('category','organization','shares'));
    }

    public function view_shareholders($cat_slug,$org_id,$share_id){
        $organization=Organization::findOrFail($org_id);
        $category=Category::where('slug',$cat_slug)->firstOrFail();
        $shareholder=Shareholder::findoRfail($share_id);
        return view('admin.category.view_shareholder',compact('shareholder','organization','category'));

    }
}

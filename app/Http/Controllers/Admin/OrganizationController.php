<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ministry;
use App\Models\Organization;
use App\Models\User;
use App\Models\Shareholder;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\String\UnicodeString;

class OrganizationController extends Controller
{

      public function index(){
           $category=0;
           if(isset($_COOKIE['category'])){
               $category=$_COOKIE['category'];
           }
           $ministry=0;
           if(isset($_COOKIE['ministry'])){
               $ministry=$_COOKIE['ministry'];
           }
           if(Auth::user()->role_id==2){
           $orgs=Organization::where('user_id',Auth::user()->id);
           }else{
               if($ministry==0){
                $orgs=Organization::whereNotNull('title_ru');
               }else{
                   $user=User::where('ministry_id',$ministry)->first();
                   $orgs=Organization::where('user_id',$user->id??'');
               }
           }
           if($category!=0){
            $orgs->where('category_id',(integer)$category);
           }
           $qnt=count($orgs->get());
           $organizations=$orgs->orderBy('created_at','desc')->paginate(20);

           $categories=Category::where('is_active',1)->get();
           if(Auth::user()->role_id==2){
            $ministries=Ministry::findOrFail(Auth::user()->ministry_id)->title_ru;
        }else{
            $ministries=Ministry::orderBy('created_at','desc')->get();
        }
           return view('admin.organization.index',compact('organizations','categories','ministries','qnt'));
      }
      public function filter_category($id){
        setcookie('category',$id,time()+3600 ,'/admin/organizations');
        return redirect()->back();
       }
     public function create(){
         $categories=Category::where('is_active',1)->get();
        $ministries=Ministry::where('is_active',1)->orderBy('title_ru','asc')->get();
         return view('admin.organization.create',compact('categories','ministries'));

     }
    public function addForm_shareholder(Request $request){
        $countries=Country::orderBy('name_ru','asc')->get();
        $section=$request->get('section');
        $html=View::make('admin.organization.shareholder._add',compact('countries','section'))->render();
        return response()->json($html);
    }
    public function ediForm_shareholder(Request $request){
        $countries=Country::orderBy('name_ru','asc')->get();
        if($request->has('section')){
            $input=Shareholder::findORFail($request->get('id'));
            $input['section']="db";
        }else{
            $input=$request->all();
        }
        $categories=Category::where('is_active',1)->get();
        $html=View::make('admin.organization.shareholder._edit',compact('countries','input','categories'))->render();
        return response()->json($html);
    }
      public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'title_ru'=>'required',
            'title_tj'=>'required',
            'title_en'=>'required',
            'category_id'=>'required',
        ],[
            'title_ru.required'=> 'Введите заголовок (RU)',
            'title_tj.required'=>'Введите заголовок (TJ)',
            'title_en.required'=>'Введите заголовок (EN)',
            'category_id.required'=>'Выьерите категория',
        ]);
        if (count($validator->errors())>0){
            $msg="";
            foreach($validator->errors()->all() as $item){
                $msg.='<p class="margin-bottom:-0px;">'.$item.'</p>';
            }
         return response()->json(['err'=>1,'msg'=>$msg]);
        }
        if(Auth::user()->role_id==2){
            $request->merge(['user_id'=>Auth::user()->id]);
        }
        $organization=Organization::create($request->all());
        $shareholders=(json_decode($request->get('shareholders')));

        foreach($shareholders as $item){
            $item->organization_id=$organization->id;
            Shareholder::create((array)$item);
        }
        Session::flash('success_message','Успешно добавлено!');
        return response()->json(['err'=>0]);
      }
      public function edit($id){
          $organization=Organization::findOrFail($id);
          $categories=Category::where('is_active',1)->orderBy('title_ru','asc')->get();
          $ministries=Ministry::orderBy('title_ru','asc')->get();
         return view('admin.organization.edit',compact('organization','categories','ministries'));
      }

      public function update(Request $request,$id){
          $validator=Validator::make($request->all(),[
            'title_ru'=>'required',
            'title_tj'=>'required',
            'title_en'=>'required',
            'category_id'=>'required',
        ],[
            'title_ru.required'=>'Введите заголовок (RU) ',
            'title_tj.required'=>'Введите заголовок (TJ)',
            'title_en.required'=>'Введите заголовок (EN)',
            'category_id.required'=>'Выберите категория',
        ]);
        if (count($validator->errors())>0){
            $msg="";
            foreach($validator->errors()->all() as $item){
                $msg.='<p class="margin-bottom:-0px;">'.$item.'</p>';
            }
         return response()->json(['err'=>1,'msg'=>$msg]);
        }
        $organization=Organization::findOrFail($id);
          $organization->update($request->all());
          return response()->json(['err'=>0]);
      }

     public function active($id){
         $organization=Organization::findOrFail($id);
         $organization->is_active=!$organization->is_active;
         $organization->save();
         return response()->json($organization->is_active,200);
     }

     public function destroy($id){
         $organization=Organization::findOrFail($id);
         $organization->shareholders()->delete();
         $organization->delete();
         return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
     }

    public function valide_shareholder(Request $request){
         $validator=Validator::make($request->all(),[
             'fio_ru'=>'required',
            //  'fio_tj'=>'required',
            //  'fio_en'=>'required',
             'country_id'=>'required',

         ],[
             'fio_ru.required'=>'Введите название (RU)!',
            //  'fio_tj.required'=>'Введите название (TJ)!',
            //  'fio_en.required'=>'Введите название (EN)!',
             'country_id.required'=>'Выберите страна!',

         ]);
         if (count($validator->errors())>0){
             $msg="";
             foreach($validator->errors()->all() as $item){
                 $msg.='<p style="margin-bottom:0px;">'.$item.'</p>';
             }
             return response()->json(['err'=>1,'msg'=>$msg]);
         }
         return response()->json(['err'=>0]);
    }

    public function store_shareholder(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'fio_ru'=>'required',
            // 'fio_tj'=>'required',
            // 'fio_en'=>'required',
            'country_id'=>'required',
        ],[
            'fio_ru.required'=>'Введите название (RU)!',
            // 'fio_tj.required'=>'Введите название (TJ)!',
            // 'fio_en.required'=>'Введите название (EN)!',
            'country_id.required'=>'Выберите страна!',
        ]);
        if (count($validator->errors())>0){
            $msg="";
            foreach($validator->errors()->all() as $item){
                $msg.='<p style="margin-bottom:0px;">'.$item.'</p>';
            }
            return response()->json(['err'=>1,'msg'=>$msg]);
        }
        $request->merge(['organization_id'=>$id]);
            $shareholder=Shareholder::create($request->all());
        return response()->json(['err'=>0,'title'=>$shareholder->fio_ru,'id'=>$shareholder->id]);
    }

    public function shaeholder_update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'fio_ru'=>'required',
            // 'fio_tj'=>'required',
            // 'fio_en'=>'required',
            'country_id'=>'required',
        ],[
            'fio_ru.required'=>'Введите название (RU)!',
            // 'fio_tj.required'=>'Введите название (TJ)!',
            // 'fio_en.required'=>'Введите название (EN)!',
            'country_id.required'=>'Выберите страна!',
        ]);
        if (count($validator->errors())>0){
            $msg="";
            foreach($validator->errors()->all() as $item){
                $msg.='<p style="margin-bottom:0px;">'.$item.'</p>';
            }
            return response()->json(['err'=>1,'msg'=>$msg]);
        }
            $shareholder=Shareholder::findOrFail($id);
            $shareholder->update($request->all());
        return response()->json(['err'=>0]);
    }

    public function shareholder_destroy($id){
        $shareholder=Shareholder::findORFail($id);
        $shareholder->delete();
        return response()->json([]);
    }

}

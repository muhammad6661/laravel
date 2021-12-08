<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Admin\ShareholderController;
use App\Http\Controllers\Controller;
use App\LocalValue;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Section;
use App\Models\Faq;
use App\Models\Organization;
use App\Models\UsefullLink;
use App\Models\VideoGallery;
use App\Models\Photo;
use App\Models\Report;
use App\Models\Shareholder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\type;

class IndexController extends Controller
{

    public function index(){

        return view('front.index',[
            'setting'=>Setting::firstOrFail(),
            'links'=>UsefullLink::where('is_active',1)->get(),
            'categories'=>Category::where('is_active',1)->get(),
        ]);
    }
    public function contact(){
        return view('front.contact',[
            'page'=>Page::where('slug','kontakty')->firstOrFail(),
        ]);
    }
        public function section($slug){
           return view('front.section',[
                'section'=>Section::where(['is_active'=>1,'slug'=>$slug])->firstOrFail(),
            ]);
        }
        public function faq(){
            return view('front.faq',[
                 'faqs'=>Faq::all(),
                 'page'=>Page::where('slug','voprosy-i-otvety')->firstOrFail()
             ]);
         }
         public function eiti(){
            return view('front.eiti',[
                 'eiti'=>Page::where('slug','chto-takoe-ipdo')->firstOrFail(),
             ]);
         }
         public function eiti_standard(){
            return view('front.eiti-standard',[
                 'page'=>Page::where('slug','standart-ipdo')->firstOrFail(),
             ]);
         }
         public function recommendation(){
            return view('front.recommendation',[
                 'page'=>Page::where('slug','recommendation')->firstOrFail(),
             ]);
         }

         public function beneficial(){
             return view('front.beneficial',[
                'page'=>Page::where('slug','beneficiarnye-sobstvenniki')->firstOrFail(),
             ]);
         }
         public function videogallery(){
            return view('front.videogallery',[
                 'videos'=>VideoGallery::paginate(12),
             ]);
         }

         public function photo(){

            return view('front.photoes',[
                 'photoes'=>Photo::paginate(12),
             ]);
         }

        //  public function photogallery1(){
        //     return view('front.photogallery',[
        //          'photogallery'=>PhotoGallery::paginate(12),
        //      ]);
        //  }

         public function photogalleries($slug){
             $photo=Photo::where('slug',$slug)->firstOrFail();
                return view('front.photogalleries', compact('photo'));
            }

            public function appeal(){
               $page = Page::where('slug','obrashenie-grazhdan')->firstOrFail();
                return view('front.appeal', compact('page'));
            }
        public function category($slug){
              if(!Session::has('type_search')){
                   session(['type_search'=>1]);
              }
              if(Session::has('paginate')){
                $paginate=session('paginate');
            }
            $category=Category::where('slug',$slug)->firstOrFail();
                $categories=Category::where('is_active',1)->get();
                 $paginate=20;
              if(session('type_search')==1){
                 $qnt=count(Organization::where(['category_id'=>$category->id,'is_active'=>1])->get());
                 $organizations=Organization::where(['category_id'=>$category->id,'is_active'=>1])->paginate($paginate==0?$qnt: $paginate);
              }else{
                $qnt=0;
                $organizations=[];
              }
             $new_s=0;
            setcookie('pathname','/category/'.$slug,time()+3600,'/');
              return view('front.category',compact('new_s','category','categories','organizations','qnt'));
        }

        public function organization($slug,$id){
            $category=Category::where('slug',$slug)->firstOrFail();
            $organization=Organization::findOrFail($id);
            $shares=Shareholder::where(['organization_id'=>$id,'is_active'=>1])->get();
            return view('front.organization',compact('category','organization','shares'));
        }


        public function search($slug_cat){
            $input=$_GET;
            if(isset($input['search'])){
               if(trim($input['search'])==""){
                   return redirect()->back();
               }
               session(['search'=>$input['search']]);
            }
            if(Session::has('paginate')==false){
                session(['paginate'=>20]);
            }
            $search=session('search');
            $paginate=session('paginate');
            $categories=Category::where('is_active',1)->get();
            setcookie('pathname','/category1/'.$slug_cat.'/'.$search.'?',time()+3600,'/');
            $category=Category::where('slug',$slug_cat)->firstOrFail();
              if(session('type_search')==1){
                 $result=(new Organization())->search($category,$search,$paginate);
              }
              else{
                  $result=(new Shareholder())->search($category,$search,$paginate);
              }

              $qnt=$result['qnt'];
              $organizations=$result['organizations'];

             return view('front.search',compact('search','category','categories','qnt','organizations'));
        }




        public function filter_letter($slug){
                setcookie('letter',$slug,time()+3600,'/');
                setcookie('paginate',0,time()+3600,'/');

            return response([]);
        }
       public function filter_paginate($paginate){
         session(['paginate'=>$paginate]);
            return response([]);
        }

         public function live_search($slug,$search){
               if(session('type_search')==1){
                  $result=(new Organization())->live_search($slug,$search);
               }else{
                  $result=(new Shareholder())->live_search($slug,$search);
               }
            return response()->json(['status'=>count($result['organizations'])>0 ? 1 :0,'html'=>$result['html']],200);
         }
     public function type_change($type){
     session(['type_search'=>$type]);
     session(['paginate'=>20]);
     session(['search'=>""]);
     return response([]);
     }
     public function view_shareholder($id){
         $shareholder=Shareholder::findORFail($id);
         $html=View::make('front._view_shareholder',compact('shareholder'))->render();
         return response()->json(['err'=>0,'html'=>$html],200);
     }
   public function reports()
   {
       $reports = Report::where('is_active', 1)->orderBy('sort','asc')->get();
       $page = Page::where('slug','otchyetii-ipdo-tadzheekeestana')->firstOrFail();
       return view('front.reports', compact('reports','page'));
   }

   //Function send message to Email
   public function sendToEmail(Request $request)
   {
      $validator = Validator::make($request->all(),
      [
          'name' => 'required',
          'email' => 'required|email',
          'message' => 'required',
      ],
      [
           'name.required' => LocalValue::getValue('Ном ва насабро дохил намоед!', 'Введите ФИО', 'Enter  full name'),
           'email.required' => LocalValue::getValue('Email-ро дохил намоед', 'Введите Email', 'Enter Email!'),
           'email.email' => LocalValue::getValue('Email-ро дуруст дохил намоед', 'Неправленый Email', 'Invalid Email'),
           'message.required' => LocalValue::getValue('Муроҷиатро дохил намоед', 'Введите обращение', 'Enter an appeal'),
      ]);
      if (count($validator->errors())>0) {
          $msg = "";
          foreach ($validator->errors()->all()  as $item) {
              $msg.= "<p>". $item ."</p>";
          }
          return response()->json(['err'=>1, 'msg' => $msg]);
      }
      response([]);
        $email = Setting::findOrFail(1)->appeal_email;
       $url = "https://mmmmnnnnnn/api/ApiSendMail";
        $data['email'] = $email;
        $data['key']="**********";
        $data['subject']="Сообщения от PBO-EITI";
        $text='<div>
        <span> ФИО :</span><span>'.$request->get('name').'</span><br>
        <span>Email :</span><span>'.$request->get('email').'</span><br>
        <span><b>Сообщения :</b> </span><p>'.$request->get('message').'</p><br>
        </div>';
        $data['text']=$text;
        $response=Http::post($url,$data);
         return response([]);

   }

}



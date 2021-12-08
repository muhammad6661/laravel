<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Faq;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\Report;
use App\Models\Repotr;

class PageController extends Controller
{
    public function index(){
        return view('admin.pages.index',[
            'pages'=>Page::all(),
        ]);
    }
    // Returt to each index pages
    public function index_page($slug){
        $page=Page::where('slug',$slug)->firstOrFail();
        $view_page="";
        switch ($page->slug){
            case 'normativnye-dokumenty' : $view_page="n_document";break;
            case 'voprosy-i-otvety': $view_page="faq";break;
            case 'chto-takoe-ipdo' : $view_page="ipdo"; break;
            case 'obrashenie-grazhdan' : $view_page="appeal"; break;
            case 'kontakty' : $view_page="contact"; break;
            case 'standart-ipdo' : $view_page="standard"; break;
            case 'recommendation' : $view_page="recommendation"; break;
            case 'otchyetii-ipdo-tadzheekeestana' : $view_page="reports"; break;
            case 'beneficiarnye-sobstvenniki' : $view_page="benefit"; break;
        }
       return view('admin.pages.'.$view_page.'.index',compact('page'));
    }

    public function edit_page($slug){
        $page=Page::where('slug',$slug)->firstOrFail();
        if($page->slug=="normativnye-dokumenty"){
            return view('admin.pages.n_document.edit',compact('page'));
        }else if ($page->slug=="otchyetii-ipdo-tadzheekeestana"){
            return view('admin.pages.reports.edit',compact('page'));
        } else {
            return view('admin.pages.faq.edit',compact('page'));
        }
    }

     //Update page
     public function update(Request $request,$slug){
         $page=Page::where('slug',$slug)->firstOrFail();
      $input=$request->all();
    //   dd($input);
      if($request->file('image')!=""){
            $this->validate($request,[
                'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=20,min_height=20',
            ],[
                'image.required'=>'Загрузить картинку',
                'image.dimensions' => 'Картина доллжна быть 1920x400 px',
                'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'image.max' => 'Размер картины должна быть менее 2 МБ',
                'image.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['image']=$this->uploadFile('uploads/banners',$request->file('image'));

    }
        $page->update($input);

        //Log
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Страница редактирован"]);

        return redirect('/admin/pages')->with(['success_message'=>'Успешно сохранено!']);
     }

     public function faqs($slug){
         return view('admin.pages.faq.faqs',[
            'page'=>Page::where('slug',$slug)->firstOrFail(),
            'faqs'=>Faq::orderBy('created_at','desc')->paginate(15),
            ]
         );

     }
///////////////////////  Faqs action //////////////////////////////////////////////////////
     public function create_faq(){
         return view('admin.pages.faq.faq_create');
     }
     public function store_faq(Request $request){
         $this->validate($request,[
             'question_tj'=>'required',
         ],[
             'question_tj.required'=>'Введите вопрос!',
         ]);
         $faq=Faq::create($request->all());


         // Log
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Вопрос номера ".$faq->id." добавлен"]);
        return redirect('/admin/page/voprosy-i-otvety/faqs')->with(['success_message'=>'Успешно добавлено!']);
     }
     public function edit_faq($id){
         $faq=Faq::findOrFail($id);
         return view('admin.pages.faq.faq_edit',compact('faq'));
     }
     public function update_faq(Request $request,$id){
         $faq=Faq::findOrFail($id);
         $this->validate($request,[
            'question_tj'=>'required',
        ],[
            'question_tj.required'=>'Введите вопрос!',
        ]);
         $faq->updaet($request->all());

         Log::create(["user_id"=>Auth::user()->id,"text"=>"Вопрос номера ".$faq->id]." редактирован");

         return redirect('/admin/page/voprosy-i-otvety/faq/'.isset($_COOKIE['pageurl'])?$_COOKIE['pageurl'] : '' )->with(['success_message'=>'Успешно сохранено!']);
     }
     public function active_faq($id){
         $faq=Faq::findOrFail($id);
         $faq->is_active=!$faq->is_active;
         $faq->save();
         return response()->json($faq->is_active,200);
     }
     public function delete_faq($id){
         Faq::findOrFail($id)->delete();
         Log::create(["user_id"=>Auth::user()->id,"text"=>"Вопрос номера ".$id." удален"]);
        return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
     }


/////////////////////// Section action //////////////////////////////////////////////////////

     public function sections($slug){
         return view('admin.pages.n_document.sections',[
             'sections'=>Section::orderBy('created_at','desc')->paginate(15),
             'page'=>Page::where('slug',$slug)->firstOrFail(),
         ]);
     }

     public function create_section(){
        return view('admin.pages.n_document.section_create');
     }

     public function store_section(Request $request){
         $this->validate($request,[
             'title_ru'=>'required',
             'title_tj'=>'required',
             'slug'=>'unique:sections,slug',
             'title_en'=>'required',
         ],[
             'title_ru.required'=>'Введите заголовок (RU)! ',
             'title_tj.required'=>'Введите заголовок (TJ)!',
             'title_en.required'=>'Введите заголовок (EN)!',
             'slug'=>'Слаг должен бить уинкалный!'
         ]);

         $section=Section::create($request->all());
         Log::create(["user_id"=>Auth::user()->id,"text"=>"Section  ".$section->id." добавлен"]);
         $pageurl=isset($_COOKIE['pageurl']) ? $_COOKIE['pageurl'] : '';
         return redirect('/admin/page/normativnye-dokumenty/sections/'.$pageurl)->with(['success_message'=>'Успешно добавлено!']);
     }

     public function edit_section($slug){

         $section=Section::where('slug',$slug)->firstOrFail();
         return view('admin.pages.n_document.section_edit',compact('section'));
     }

     public function update_section(Request $request,$id){
        $this->validate($request,[
            'title_ru'=>'required',
            'title_tj'=>'required',
            'slug'=>'unique:sections,slug,'.$id.',id',
            'title_en'=>'required',
        ],[
            'title_ru.required'=>'Введите заголовок (RU)! ',
            'title_tj.required'=>'Введите заголовок (TJ)!',
            'title_en.required'=>'Введите заголовок (EN)!',
            'slug'=>'Слаг должен бить уинкалный!'
        ]);
         $section=Section::findOrFail($id);
         $section->update($request->all());
         Log::create(["user_id"=>Auth::user()->id,"text"=>"Section  ".$id." изменен"]);
         $pageurl=isset($_COOKIE['pageurl']) ? $_COOKIE['pageurl'] : '';
    return redirect('/admin/page/normativnye-dokumenty/sections/'.$pageurl)->with(['success_message'=>'Успешно сохранено!']);
     }

     public function active_section($id){
         $section=Section::findOrFail($id);
         $section->is_active=!$section->is_active;
         $section->save();
         return response()->json($section->is_active,200);
     }

     public function delete_section($id){
        $section=Section::findOrFail($id);
        $section->documents()->delete();
        // $document=Document::where('section_id',$id);
        // $document->delete();

        $title_ru=$section->title_ru;
        $section->delete();

         Log::create(["user_id"=>Auth::user()->id,"text"=>"Section  ".$title_ru." удален"]);
        return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
     }


/////////////////////// Documents of section action //////////////////////////////////////////////////////

   public function documents($slug){
       $section=Section::where('slug',$slug)->firstOrFail();
     return view('admin.pages.n_document.documents',[
         'documents'=>Document::where('section_id',$section->id)->orderBy('created_at','desc')->paginate(15),
         'section'=>$section,
     ]);
   }

   public function creat_document($slug){
       $section=Section::where('slug',$slug)->firstOrFail();
       $sort=Document::where('section_id',$section->id)->orderBy('sort','desc')->first();
       return view('admin.pages.n_document.document_create',[
           'section'=>$section,
           'sort'=>$sort!="" ? $sort->sort : 1,
       ]);
   }


   public function store_document(Request $request,$id){
    $this->validate($request,[
        'title_ru'=>'required',
        'title_tj'=>'required',
        'title_en'=>'required',
    ],[
        'title_ru.required'=>'Введите заголовок (RU)! ',
        'title_tj.required'=>'Введите заголовок (TJ)!',
        'title_en.required'=>'Введите заголовок (EN)!',
    ]);
    $input=$request->all();
    if($input['type_link']==1){
        $this->validate($request,[
            'file_ru'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ],[
            'file_ru.required'=>'Загрузите файл (RU)!',
            'file_ru.mimes'=>'Загрузите файл (RU) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ]);
        $input['file_ru'] = $this->uploadFile('uploads/documents',$request->file('file_ru'));
        if ($request->file('file_tj')) {
            $this->validate($request,[
                'file_tj'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
            ],[
                'file_tj.required'=>'Загрузите файл (TJ)!',
                'file_tj.mimes'=>'Загрузите файл (TJ) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
            ]);
        $input['file_tj'] = $this->uploadFile('uploads/documents',$request->file('file_tj'));
        }
        if ($request->file('file_en')) {
            $this->validate($request,[
                'file_en'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
            ],[
                'file_en.required'=>'Загрузите файл (EN)!',
                'file_en.mimes'=>'Загрузите файл (EN) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
            ]);
        $input['file_tj'] = $this->uploadFile('uploads/documents',$request->file('file_en'));
        }
        $input['link_ru'] = "";
        $input['link_tj'] = "";
        $input['link_en'] = "";
    } else {
        $input['file_ru'] = "";
        $input['file_tj'] = "";
        $input['file_en'] = "";
    }
    $input['section_id']=$id;
    $section=Section::FindOrFail($id);
    $documentId=Document::create($input);
    Log::create(["user_id"=>Auth::user()->id,"text"=>"Документ номера ".$documentId->id." добавлен в section ".$section->title]);
    return redirect('/admin/page/normativnye-dokumenty/section/'.$section->slug)->with(['success_message'=>'Успешно добавлено!']);
}

  public function edit_document($sec_id,$doc_id){
    return view('admin.pages.n_document.document_edit',[
        'document'=>Document::findOrFail($doc_id),
        'sections'=>Section::orderBy('created_at','desc')->get(),
    ]);
  }

  public function update_document(Request $request,$sec_id,$doc_id){
    $this->validate($request,[
        'title_ru'=>'required',
        'title_tj'=>'required',
        'title_en'=>'required',
    ],[
        'title_ru.required'=>'Введите заголовок (RU)! ',
        'title_tj.required'=>'Введите заголовок (TJ)!',
        'title_en.required'=>'Введите заголовок (EN)!',
    ]);
    $input=$request->all();
    $document=Document::findOrFail($doc_id);
  if($input['type_link']==1){
    if ($request->file('file_ru')!=""){
        $this->validate($request,[
            'file_ru'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ],[
            'file_ru.required'=>'Загрузите файл (RU)!',
            'file_ru.mimes'=>'Загрузите файл (RU) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ]);
        $input['file_ru']=$this->uploadFile('uploads/documents',$request->file('file_ru'),null,$document->file_ru!="" ? $document->file_ru: '');
    }
    if ($request->file('file_tj')) {
        $this->validate($request,[
            'file_tj'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ],[
            'file_tj.required'=>'Загрузите файл (TJ)!',
            'file_tj.mimes'=>'Загрузите файл (TJ) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ]);
        $input['file_tj']=$this->uploadFile('uploads/documents',$request->file('file_tj'),null,$document->file_tj!="" ? $document->file_tj: '');
    }
   if ($request->file('file_en')) {
        $this->validate($request,[
            'file_en'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ],[
            'file_en.required'=>'Загрузите файл (EN)!',
            'file_en.mimes'=>'Загрузите файл (EN) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ]);
        $input['file_en']=$this->uploadFile('uploads/documents',$request->file('file_en'),null,$document->file_en!="" ? $document->file_en: '');
    }

    $input['link_ru']="";
    $input['link_tj']="";
    $input['link_en']="";
  } else {
    if ($document->file_ru!="") {
        $this->unlinkFile('public/uploads/documents/'.$document->file_ru);
        $input['file_ru']="";
    }
    if ($document->file_tj!=""){
        $this->unlinkFile('public/uploads/documents/'.$document->file_tj);
        $input['file_tj']="";
    }
    if ($document->file_en!=""){
        $this->unlinkFile('public/uploads/documents/'.$document->file_en);
        $input['file_en']="";
    }
  }
    $document->update($input);
    Log::create(["user_id"=>Auth::user()->id,"text"=>"Документ номера ".$document->title_ru." редактирован"]);
    $pageurl=isset($_COOKIE['pageurl']) ? $_COOKIE['pageurl'] : '';
    return redirect('/admin/page/normativnye-dokumenty/section/'.$document->section()->first()->slug.'/'.$pageurl)->with(['success_message'=>'Успешно сохранено!']);
  }

  public function active_document($id){
      $document=Document::findOrFail($id);
      $document->is_active=!$document->is_active;
      $document->save();
      return response()->json($document->is_active,200);
  }

  public function delete_document($id){
      $document=Document::findOrFail($id);
      $title_ru=$document->title_ru;
        if($document->file!=""){
            unlink('public/uploads/documents/'.$document->file);
        }
      $section_id=$document->section_id;

      $document->delete();
      Log::create(["user_id"=>Auth::user()->id,"text"=>"Документ  ".$title_ru." из section ".$section_id." удален"]);
      return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
  }

  //Reports
  public function report_documents(){
      $reports=Report::orderBy('sort','asc')->paginate(15);
      return view('admin.pages.reports.reports',compact('reports'));
  }

  public function report_create_document(){
      $sort=Report::orderBy('sort','asc')->first()->sort??1;
      return view('admin.pages.reports.report_create',compact('sort'));
  }

  public function report_store_document(Request $request){
    $this->validate($request,[
        'title_ru'=>'required',
        'title_tj'=>'required',
        'title_en'=>'required',
        'file_ru'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
    ],[
        'title_ru.required'=>'Введите заголовок (RU)! ',
        'title_tj.required'=>'Введите заголовок (TJ)!',
        'title_en.required'=>'Введите заголовок (EN)!',
        'file_ru.required'=>'Загрузите файл (RU)!',
        'file_ru.mimes'=>'Загрузите файл (RU) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
    ]);
    $input=$request->all();
    if ($request->file('file_tj')){
        $input['file_tj'] = $this->uploadFile('uploads/reports',$request->file('file_tj'));
    }
    if ($request->file('file_en')) {
        $input['file_en'] = $this->uploadFile('uploads/reports',$request->file('file_en'));
    }
    $input['file_ru'] = $this->uploadFile('uploads/reports',$request->file('file_ru'));
    $documentId=Report::create($input);
    Log::create(["user_id"=>Auth::user()->id,"text"=>"Документ номера ".$documentId->title_ru." добавлен в Отчеты ИПДО Таджикистана"]);
    return redirect('/admin/page/otchyetii-ipdo-tadzheekeestana/documents')->with(['success_message'=>'Успешно добавлено!']);
  }

   public function report_edit_document ($id)
   {
     $report = Report::findOrFail($id);
     return view('admin.pages.reports.report_edit',compact('report'));
   }

   public function report_update_document (Request $request, $id)
   {
    $this->validate($request,[
        'title_ru'=>'required',
        'title_tj'=>'required',
        'title_en'=>'required',
    ],[
        'title_ru.required'=>'Введите заголовок (RU)! ',
        'title_tj.required'=>'Введите заголовок (TJ)!',
        'title_en.required'=>'Введите заголовок (EN)!',
    ]);
   $input = $request->all();
   $report = Report::findOrFail($id);
    if ($request->file('file_ru')) {
        $this->validate($request,
        [
            'file_ru'=>'required|mimes:pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ],
        [
            'file_ru.required'=>'Загрузите файл (RU)!',
            'file_ru.mimes'=>'Загрузите файл (RU) pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip',
        ]);
        $input['file_ru'] = $this->uploadFile('uploads/reports', $request->file('file_ru'), null, $report->file_ru ?? null);
    }

   if ($request->file('file_tj') != "") {
       $input['file_tj'] = $this->uploadFile('uploads/reports', $request->file('file_tj'), null, $report->file_tj ?? null);
   }
   if ($request->file('file_en') != "") {
       $input['file_en'] = $this->uploadFile('uloads/reports', $request->file('file_en'), null, $report->file_en ?? null);
   }
   $report->update($input);
   Log::create(["user_id"=>Auth::user()->id,"text"=>"Документ  ".$report->title_ru." редактирован"]);
   $pageurl=isset($_COOKIE['pageurl']) ? $_COOKIE['pageurl'] : '';
   return redirect('/admin/page/otchyetii-ipdo-tadzheekeestana/documents')->with(['success_message'=>'Успешно сохранено!']);
   }

  public function report_active_document($id)
  {
      $report = Report::findOrFail($id);
      $report->is_active = !$report->is_active;
      $report->save();
      return response()->json($report->is_active);
  }

  public function report_delete_document($id)
  {
      $report = Report::findOrFail($id);
      if ($report->file_ru != "") {
          $this->unlinkFile('public/uploads/reports/' . $report->file_ru);
      }
      if ($report->file_tj != "") {
          $this->unlinkFile('public/uploads/reports/' . $report->file_tj);
      }
      if ($report->file_en != "") {
          $this->unlinkFile('public/uploads/reports/' . $report->file_en);
      }
      $report->delete();
      Log::create(["user_id"=>Auth::user()->id,"text"=>"Документ  ".$report->title_ru." из Отчеты ИПДО Таджикистана удален"]);
      return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
  }
}

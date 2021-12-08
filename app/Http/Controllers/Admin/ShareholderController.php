<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Category;
use App\Models\Ministry;
use App\Models\Organization;
use App\Models\Shareholder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareholderController extends Controller
{
    public function index($id){
        $organization=Organization::findOrFail($id);
        $shares=Shareholder::where('organization_id',$id)->orderBy('created_at','desc')->paginate(25);
        return view('admin.shareholder.index',compact('shares','organization'));

    }
    public function create($id){
        $organization=Organization::findOrFail($id);
        $countries=Country::orderBy('name_ru','asc')->get();
        return view('admin.shareholder.create',compact('organization','countries'));
    }
    public function store(Request $request,$org_id){
        $this->validate($request,[
            'fio_ru'=>'required',
            'fio_tj'=>'required',
            'fio_en'=>'required',
            'country_id'=>'required',
        ],[
            'fio_ru.required'=>'Введите ФИО RU',
            'fio_tj.required'=>'Введите ФИО TJ',
            'fio_en.required'=>'Введите ФИО EN',
            'country_id.required'=>'',
        ]);
          $input=$request->all();
          $input['organization_id']=$org_id;
        Shareholder::create($input);
        return redirect('/admin/organization/'.$org_id.'/shareholders')->with(['success_message'=>'Успешно добавлено!']);
    }
    public function edit($id){
    return view('admin.shareholder.edit',[
        'shareholder'=>Shareholder::findOrFail($id),
        'countries'=>Country::orderBy('name_en','asc')->get(),
        'categories'=>Category::orderBy('title_ru','asc')->get(),
    ]);
    }
    public function update(Request $request,$id){
        // dd($request->all());
        $this->validate($request,[
            'fio_ru'=>'required',
            'fio_tj'=>'required',
            'fio_en'=>'required',
            'country_id'=>'required',
        ],[
            'fio_ru.required'=>'Введите ФИО RU',
            'fio_tj.required'=>'Введите ФИО TJ',
            'fio_en.required'=>'Введите ФИО EN',
            'country_id.required'=>'',
        ]);
        $shareholder=Shareholder::findOrFail($id);
        $shareholder->update($request->all());
        return redirect('/admin/organization/'.$shareholder->organization()->first()->id.'/shareholders')->with(['success_message'=>'Успешно сохранено!']);
    }

     public function active($id){
         $shareholder=Shareholder::findOrFail($id);
         $shareholder->is_active=!$shareholder->is_active;
         $shareholder->save();
         return response()->json($shareholder->is_active,200);
     }
     public function destroy($id){
         $shareholder=Shareholder::findOrFail($id);
         $shareholder->delete();
         return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
     }
     //Add Shareholder menu
   public function add_index(){
      $ministry="";
    $ministry=Ministry::findOrFail(Auth::user()->ministry_id)->title_ru;
     $shareholders=(new Shareholder())->showModerator();
    $categories=Category::orderBy('created_at','desc')->get();
    return view('admin.shareholder.add_shareholder.index',compact('shareholders','ministry','categories'));
   }



   public function filter_category($id){
    setcookie('category',$id,time()+3600 ,'/admin/organizations');
    return response()->json(200);
   }
  public function filter_ministry($id){
    setcookie('ministry',$id,time()+3600 ,'/');
    return response()->json(200);
   }

   public function add_create(){
    return view('admin.shareholder.add_shareholder.create',[
        'categories'=>Category::orderBY('title_ru','asc')->get(),
        'countries'=>Country::orderBy('name_en','asc')->get(),
    ]);
   }

   public function add_store_organization(Request $request){
      $organization=Organization::create($request->all());
      return response()->json(['err'=>0,'id'=>$organization->id,'title'=>$organization->title],200);
   }

   public function change_category($id){
       $organizations=Organization::where('category_id',$id)->get();
       $html='<option value="">===============-- Выберите --==============</option>';
       foreach($organizations as $item){
        $html=$html.'<option value="'.$item->id.'">'.$item->title.'</option>';
       }
       return response()->json(['html'=>$html]);
   }
   public function add_store(Request $request){
       $this->validate($request,[
        'fio'=>'required',
        'birthday'=>'required',
        'country_id'=>'required',
        'stock'=>'required',
        'plz'=>'required',
        'organization_id'=>'required',
    ],[
        'fio.required'=>'Введите ФИО',
        'birthday.required'=>'Введите дата рождения',
        'country_id.required'=>'Выберите Страна',
        'stock.required'=>'Введите холдинг (%)',
        'plz.required'=>'Введите ПЛЗ',
        'organization_id.required'=>'Выберите организация',
    ]);
    Shareholder::create($request->all());
    return redirect('/admin/shareholders')->with(['success_message'=>'Успешно добавлено!']);
   }


   public function add_edit($id){
    $shareholder=Shareholder::findOrFail($id);
    $countries=Country::orderBy('name_en','asc')->get();
    $categories=Category::orderBy('title_ru','asc')->get();
    $organizations=Organization::where('category_id',$shareholder->organization()->first()->category_id)->get();
    return view('admin.shareholder.add_shareholder.edit',compact('shareholder','countries','categories','organizations'));
    }

    public function add_update(Request $request,$id){
       dd($request->all());

        $shareholder=Shareholder::findOrFail($id);
        $this->validate($request,[
            'fio'=>'required',
            'birthday'=>'required',
            'country_id'=>'required',
            'stock'=>'required',
            'plz'=>'required',
            'organization_id'=>'required',
        ],[
            'fio.required'=>'Введите ФИО RU',
            'birthday.required'=>'Введите дата рождения',
            'country_id.required'=>'Выберите Страна',
            'stock.required'=>'Введите холдинг (%)',
            'plz.required'=>'Введите ПЛЗ',
            'organization_id.required'=>'Выберите организация',
        ]);
         $shareholder->update($request->all());
        return redirect('/admin/shareholders')->with(['success_message'=>'Успешно сохранено!']);
    }

    // public function regex(){
    //     $shares=Organization::where('latin_title',null)->get();
    //     return view('admin.shareholder.regex',compact('shares'));
    //  }

    //  public function fio_regex(Request $request,$id){
    //   $share=Organization::find($id);
    //   $share->update($request->all());
    //   return response([]);
    //  }
}

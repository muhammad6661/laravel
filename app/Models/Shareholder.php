<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class Shareholder extends Model
{
    use HasFactory;

    protected $fillable=['organization_id','fio_ru','fio_tj','fio_en','type','stock','is_active','country_id','plz','birja_ru','birja_tj','birja_en'];

    public function organization(){
        return $this->belongsTo(Organization::class,'organization_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function live(){
        return $this->belongsTo(Country::class,'place_live','id');
    }

    public function showAdmin(){
        $category=0;$ministry=0;
       if(isset($_COOKIE['category'])){
           $category=$_COOKIE['category'];
       }
       if(isset($_COOKIE['ministry'])){
           $ministry=$_COOKIE['ministry'];
       }
      if($ministry==0){
          if($category==0){
              $shareholders=Shareholder::orderBy('created_at','desc')->get();
          }else{
              $orgs=Organization::where(['category_id'=>$category])->get();
              $ides=[];
              foreach($orgs as $item){
                  $ids[]=$item->id;
              }
              $shareholders=Shareholder::whereIn('organization_id',$ids)->orderBy('created_at','desc')->get();
          }
      }else{
           $ministry_model=Ministry::findOrFail($ministry);
           if($category==0){
            $orgs=Organization::where('user_id',$ministry_model->user_id)->orderBy('created_at','desc')->get();
           }else{
            $orgs=Organization::where(['category_id'=>$category,'user_id'=>$ministry_model->user_id])->get();
            }
            $ids=[];
            foreach($orgs as $item){
                $ids[]=$item->id;
           }
           $shareholders=Shareholder::whereIn('organization_id',$ids)->orderBy('created_at','desc')->get();

      }
      return $shareholders;
    }


     public function showModerator(){
        $category=0;
        if(isset($_COOKIE['category'])){
           $category=$_COOKIE['category'];
       }
       if($category==0){
           $orgs=Organization::where('user_id',Auth::user()->id)->get();
       }else{
        $orgs=Organization::where(['user_id'=>Auth::user()->id,'category_id'=>$category])->get();
          }
         $ids=[];
          foreach($orgs as $item){
             $ids[]=$item->id;
          }
        $shareholders=Shareholder::whereIn('organization_id',$ids)->orderBy('created_at','desc')->get();
       return $shareholders;
    }

    public function live_search($slug,$search){
      $category=Category::where('slug',$slug)->firstOrFail();
      $ids=[];
      foreach($category->organizations()->get() as $item){
        $ids[]=$item->id;
      }
      $shareholders=Shareholder::whereIn('organization_id',$ids)->where('is_active',1)
      ->where(function($query) use($search){
         $query->orWhere('fio_ru','Like','%'.$search.'%')->orWhere('fio_tj','Like','%'.$search.'%')
         ->orWhere('fio_en','Like','%'.$search.'%');
     })->take(15)->get();

     $html=' <ul class="text_wrapper">';
     foreach($shareholders as $item){
        $title=\App\LocalValue::getValue($item->fio_tj,$item->fio_ru,$item->fio_en);
        $title=str_ireplace(mb_strtoupper($search),'#' . mb_strtoupper($search) . "*",($title)) ;
        $title=str_ireplace(mb_strtolower($search),'#' . mb_strtolower($search) . "*",($title)) ;
        $title=str_ireplace(($search),'#' . ($search) . "*",($title)) ;
        $title=str_ireplace(('#'),'<strong class="sblTxt" >',($title)) ;
        $title=str_ireplace(('*'),'</strong>',($title)) ;
        $html=$html.'
        <li><a href="/category/'.$item->organization()->first()->category()->first()->slug.'/'.$item->organization_id.'">'.\App\LocalValue::getValue($item->organization()->first()->title_tj,$item->organization()->first()->title_ru,$item->organization()->first()->title_en  ).'<br>
        <small>'.$title.'</small>
        </a>
        </li>';
    }
    $html=$html.'</ul>';

    return [
        'html'=>$html,
        'organizations'=>$shareholders,
    ];
    }

    public function search($category,$search,$paginate){
        $ids=[];
        foreach($category->organizations()->get() as $item){
            $ids[]=$item->id;
        }
        $qnt=count(Shareholder::whereIn('organization_id',$ids)->where('is_active',1)
        ->where(function($query) use($search){
             $query->orWhere('fio_ru','Like','%'.$search.'%')->orWhere('fio_tj','Like','%'.$search.'%')
             ->orWhere('fio_en','Like','%'.$search.'%');
         })->get());

       $shareholders=Shareholder::whereIn('organization_id',$ids)->where('is_active',1)
       ->where(function($query) use($search){
            $query->orWhere('fio_ru','Like','%'.$search.'%')->orWhere('fio_tj','Like','%'.$search.'%')
            ->orWhere('fio_en','Like','%'.$search.'%');
        })->paginate($paginate==0? $qnt : $paginate);
       return [
           'qnt'=>$qnt,
           'organizations'=>$shareholders,
       ];
        }
}

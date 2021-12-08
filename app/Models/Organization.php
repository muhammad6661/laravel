<?php

namespace App\Models;

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shareholder;
class Organization extends Model
{
    use HasFactory;
   protected $fillable=['title_ru','title_tj','title_en','name_head_ru','name_head_tj','name_head_en','inn','contacts','is_active','category_id','user_id','address_ru','address_tj','address_en'];

   public function shareholders(){
       return $this->HasMany(Shareholder::class,'organization_id','id');
   }
   public function category(){
       return $this->belongsTo(Category::class,'category_id','id');
   }

   public function live_search($slug,$search){
    $category=Category::where('slug',$slug)->firstOrFail();
    $organizations=Organization::where(function($query) use ($category){
       $query->where(['category_id'=>$category->id,'is_active'=>1]);
    })->where(function($query) use($search){
        $query->orWhere('title_ru','Like','%'.$search.'%')->orWhere('title_tj','Like','%'.$search.'%')
        ->orWhere('title_en','Like','%'.$search.'%');
    })->take(15)->get();

     $html=' <ul class="text_wrapper">';
     foreach($organizations as $item){
        $title=\App\LocalValue::getValue($item->title_tj,$item->title_ru,$item->title_en);
        $title=str_ireplace(mb_strtolower($search),'#' . mb_strtolower($search) . "*",($title)) ;
        $title=str_ireplace(mb_strtoupper($search),'#' . mb_strtoupper($search) . "*",($title)) ;
        $title=str_ireplace(($search),'#' . ($search) . "*",($title)) ;
        $title=str_ireplace(('#'),'<strong class="sblTxt" >',($title)) ;
        $title=str_ireplace(('*'),'</strong>',($title)) ;
        $html=$html.'<a href="/category/'.$item->category()->first()->slug.'/'.$item->id.'"><li>'.$title.'</li>    </a>';
    }
    $html=$html.'</ul>';
    return [
        'html'=>$html,
        'organizations'=>$organizations,
    ];
}

   public function search($category,$search,$paginate){
    $qnt=count(Organization::where(function($query) use ($category){
        $query->where(['category_id'=>$category->id,'is_active'=>1]);
     })->where(function($query) use($search){
         $query->orWhere('title_ru','Like','%'.$search.'%')->orWhere('title_tj','Like','%'.$search.'%')
         ->orWhere('title_en','Like','%'.$search.'%');
     })->get());

   $organizations=Organization::where(function($query) use ($category){
        $query->where(['category_id'=>$category->id,'is_active'=>1]);
     })->where(function($query) use($search){
         $query->orWhere('title_ru','Like','%'.$search.'%')->orWhere('title_tj','Like','%'.$search.'%')
         ->orWhere('title_en','Like','%'.$search.'%');
     })->paginate($paginate==0? $qnt : $paginate);
   return [
       'qnt'=>$qnt,
       'organizations'=>$organizations,
   ];
    }

}

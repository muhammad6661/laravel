<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['title_ru','slug','title_tj','title_en','is_active','image'];

    public function organizations(){
        return $this->hasMany(Organization::class,'category_id','id');
    }


}

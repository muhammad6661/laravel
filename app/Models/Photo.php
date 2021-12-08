<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable=['title_tj','title_ru','title_en','date','slug','text_tj','text_ru','text_en','image','is_active'];

    public function galleries(){
        return $this->HasMany(PhotoGallery::class,'photo_id','id');
    }

}

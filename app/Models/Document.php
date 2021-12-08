<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
class Document extends Model
{
    use HasFactory;
    protected $fillable=['title_tj','title_ru', 'sort','title_en','type_link','link_ru','link_tj','link_en','file_ru','file_tj','file_en','section_id','is_active'];

    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
}

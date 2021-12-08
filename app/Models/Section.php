<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable=['title_tj','slug','title_ru','title_en'];

    public function documents()
    {
        return $this->HasMany(Document::class,'section_id','id');
    }
}

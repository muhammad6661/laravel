<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['title_tj','title_ru', 'title_en', 'sort','file_ru','file_tj','file_en','is_active'];
}

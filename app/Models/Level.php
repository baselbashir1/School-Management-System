<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $table = 'levels';
    protected $fillable = ['name', 'notes'];
    public $timestamps = true;
}

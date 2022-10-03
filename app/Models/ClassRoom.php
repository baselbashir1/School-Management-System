<?php

namespace App\Models;

use App\Models\Level;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClassRoom extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $table = 'classrooms';
    protected $fillable = ['name', 'level_id'];
    public $timestamps = true;

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

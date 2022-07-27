<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name'
    ];

    public $translatable = ['name'];

    public function parts(){
        return $this->hasMany(Part::class);
    }
}

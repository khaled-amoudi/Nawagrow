<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    use HasTranslations;


    protected $fillable = [
        'name',
        'category_id'
    ];

    public $translatable = ['name'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

}

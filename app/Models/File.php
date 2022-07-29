<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file', 'image', 'image_base64'
    ];


    // public function getImageBase64Attribute($value)
    // {
    //     return base64_decode($value);
    // }

    public function setImageBase64Attribute($value)
    {
        $this->attributes['image_base64'] = base64_encode($value);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['original_name', 'filename'];

    public static $rules = [
        'img' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];
    
    public static $messages = [
        'img.mimes' => 'Uploaded file is not in image format',
        'img.required' => 'Image is required'
    ];
}

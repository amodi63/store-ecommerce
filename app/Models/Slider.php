<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'created_at', 'updated_at'];
    public function getPhotoAttr($val)
    {
        return ($val !== null) ? asset('assets/images/sliders/' . $val) : "";
    }
}

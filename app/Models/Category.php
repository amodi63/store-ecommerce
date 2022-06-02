<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Translatable;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['name', 'is_active', 'slug', 'parent_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at', 'translations'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

}

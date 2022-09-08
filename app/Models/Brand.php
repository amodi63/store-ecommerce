<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Translatable;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['photo', 'is_active', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at', 'translations'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function isActive()
    {
        return $this->is_active == 0 ? __('admin/category.not_active') : __('admin/category.active');
    }
    public function getPhotoAttr($val)
    {
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
                                                    
}

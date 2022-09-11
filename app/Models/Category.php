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
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }
    public function isActive()
    {
        return $this->is_active == 0 ? __('admin/category.not_active') : __('admin/category.active');
    }
    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->withDefault();
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}

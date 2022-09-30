<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name', 'description', 'short_description'];
    protected $fillable = ['brand_id', 'slug', 'price', 'special_price', 'special_price_type', 'special_price_start', 'special_price_end', 'selling_price', 'sku', 'qty', 'manage_stock', 'viewed', 'is_active', 'in_stock', 'deleted_at', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'translations'];
    protected $casts = [
        'is_active' => 'boolean',
        'in_stock' => 'boolean',

    ];
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'deleted_at',
    ];
    public function isActive()
    {
        return $this->is_active == 0 ? __('admin/category.not_active') : __('admin/category.active');
    }
    public function scopeActive($q) {
        return $q->where('is_active', 1);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->withDefault();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
    public function options()
    {
        return $this->hasMany(AttributeOption::class, 'product_id');
    }
    public function getPhotoAttr($val)
    {
        return ($val !== null) ? asset('assets/images/products/' . $val) : "";
    }
    
}

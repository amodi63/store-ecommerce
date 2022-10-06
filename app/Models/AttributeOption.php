<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class AttributeOption extends Model
{
    use HasFactory, Translatable;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['product_id', 'price', 'attribute_id','created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at', 'translations'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function attributes() {
       return  $this->belongsTo(Attribute::class, 'attribute_id');
    }
}

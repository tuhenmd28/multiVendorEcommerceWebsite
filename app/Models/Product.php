<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttribute;
use App\Models\AddProductImage;
use App\Models\Section;
use App\Models\Category;
use App\Models\Admin;
class Product extends Model
{
    use HasFactory;

    public function section()
    {
       return $this->belongsTo(Section::class,'section_id');
    }
    public function categories()
    {
       return $this->belongsTo(Category::class,'category_id');
    }
    public function attributes()
    {
       return $this->hasMany(ProductAttribute::class,'product_id');
    }
    public function images()
    {
       return $this->hasMany(AddProductImage::class,'product_id');
    }
}

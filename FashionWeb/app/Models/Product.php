<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category', 'color', 'is_on_sale', 'new_collection', 'size', 'stock'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}



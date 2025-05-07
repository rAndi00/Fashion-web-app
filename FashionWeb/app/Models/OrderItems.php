<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'productPriceQuantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

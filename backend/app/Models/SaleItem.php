<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = ['sale_id','product_id','qty','unit_price','total'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

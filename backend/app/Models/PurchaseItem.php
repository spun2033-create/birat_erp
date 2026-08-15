<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = ['purchase_id','product_id','qty','unit_price','total'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

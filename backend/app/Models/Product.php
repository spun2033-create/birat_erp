<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku','name','description','unit','purchase_price','sale_price','opening_stock','reorder_level','category'];
}

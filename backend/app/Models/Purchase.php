<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['party_id','invoice_no','total','tax','status'];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}

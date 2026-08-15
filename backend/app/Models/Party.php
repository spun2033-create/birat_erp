<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = ['type','name','phone','address','tax_id','opening_balance'];
}

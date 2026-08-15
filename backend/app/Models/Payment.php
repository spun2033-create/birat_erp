<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['party_id','amount','method','ref_type','ref_id','note'];
}

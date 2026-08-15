<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employee_id','date_ad','date_bs','check_in','check_out','hours','status','remarks'];
}

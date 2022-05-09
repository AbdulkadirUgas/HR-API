<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'attDate',
        'punched_in',
        'punched_out' ,
        'empID' ,
        'status'
    ];
}

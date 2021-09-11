<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    
    protected $table = 'meeting';
    protected $fillable = ['user_id','agenda','meeting_time','link'];
}

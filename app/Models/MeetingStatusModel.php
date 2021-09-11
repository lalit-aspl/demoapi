<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingStatusModel extends Model
{
    use HasFactory;
    protected $table = 'user_meeting_status';
    protected $fillable = ['user_id','meeting_id','status','link'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'image25',
        'image50',
        'image75',
        'image100',
        'fee_status',
        'done_lesson',
    ];
}

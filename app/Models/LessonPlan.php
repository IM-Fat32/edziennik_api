<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        "lesson_date",
        "lesson_time",
        "lesson_class_room",
        "lesson_subject",
        "lesson_teacher"
    ];
}

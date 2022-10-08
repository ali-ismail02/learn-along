<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'student_assignments';

    protected $fillable = [
        'student_id',
        'course_id',
        'assignment',
    ];
}

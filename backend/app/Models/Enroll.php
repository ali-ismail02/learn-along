<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'enrolls';

    protected $fillable = [
        'student_id',
        'course_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'courses';

    protected $fillable = [
        'id',
        'name',
        'instructor_id',
    ];
}

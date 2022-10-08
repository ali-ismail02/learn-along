<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'courses';

    protected $fillable = [
        'name',
        'instructor_id',
        'created_at',
    ];
}

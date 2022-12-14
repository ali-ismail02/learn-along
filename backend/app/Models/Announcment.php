<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Announcment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'announcments';

    protected $fillable = [
        'id',
        'course_id',
        'title',
        'description',
    ];
}

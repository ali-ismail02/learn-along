<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Assingnment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'assingnments';

    protected $fillable = [
        'id',
        'course_id',
        'title',
        'description',
        'due_date',
    ];
}

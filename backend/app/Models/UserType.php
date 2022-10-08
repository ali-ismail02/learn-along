<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    
    protected $connection = 'mongodb';
    protected $collection = 'user_types';

    protected $fillable = [
        'id',
        'type',
    ];
}

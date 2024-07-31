<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=[
        'course_name',
        'price_online',
        'price_offline',
        'course_rar',
        'course_picture',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session_client extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'phone',
        'type',
        'session_type',
        'session_time',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'picture',
        'book_pdf',
        'pdf',
        'inside_Egypt',
        'outside_Egypt',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'volume',
        'ISBN',
        'edition',
        'publication_year',
        'publication_house',
        'price'
    ];

    // protected $casts = [
    //     'author' => 'array',
    // ];
}

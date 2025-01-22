<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

use App\Models\Reservation;
use App\Models\Review;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'author',
        'publishedYear',
        'genre',
        'totalCopies',
        'availableCopies',
        'coverUrl',
    ];

    
    //Get the author that owns the book.
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    //Get the loans for the book.
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

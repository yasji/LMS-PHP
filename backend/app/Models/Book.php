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

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // public function borrowRecords()
    // {
    //     return $this->hasMany(BorrowRecord::class);
    // }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

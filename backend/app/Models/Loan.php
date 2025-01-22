<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    protected $table = 'loans';

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_date',
        'due_date',
        'status',
    ];

    public $timestamps = false;


    // Establishes a relationship indicating that a loan belongs to a book.
    public function book()
    {
        return $this->belongsTo(Book::class);
    }


    // Establishes a relationship indicating that a loan belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
?>



    
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



    public function book()

    {

        return $this->belongsTo(Book::class);

    }



    public function user()

    {

        return $this->belongsTo(User::class);

    }
}
?>



    
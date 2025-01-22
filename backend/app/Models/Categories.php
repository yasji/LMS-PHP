<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;


class Categories extends Model
{

    protected $fillable = ['name'];

    public $timestamps = false;



 
     // Get the books associated with the category.
    public function books()
    {
        return $this->hasMany(Book::class, 'genre', 'name');
    }
}

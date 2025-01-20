<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;


class Categories extends Model
{

    protected $fillable = ['name'];

    public $timestamps = false;



    public function books()
    {
        return $this->hasMany(Book::class, 'genre', 'name');
    }
}

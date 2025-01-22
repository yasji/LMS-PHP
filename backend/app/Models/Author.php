<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BorrowRecord;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;



    // Define a relationship to get the books associated with the author
    public function books()
    {
        return $this->hasMany(Book::class, 'author', 'name');
    }

    // Get authors along with their book count
    public static function getAuthorsWithBookCount()
    {
        return self::withCount('books')->get();
    }
}

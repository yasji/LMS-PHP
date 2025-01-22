<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    // retunr all the books in json format
    public function index()
    {
        Log::info('Showing all books');
        $books = Book::all();
        return response()->json($books);
    }
    #This fuction return a particular book selected
    public function show(Book $book)
    {
        return response()->json($book);
    }
    #This fuction store newly added or created books in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publishedYear' => 'required|integer',
            'genre' => 'required|string|max:255',
            'totalCopies' => 'required|integer',
            'availableCopies' => 'required|integer',
            'coverUrl' => 'nullable|url',
    ]);
        $author = Author::firstOrCreate(
            ['name' => $request->input('author')],
            ['bio' => $request->input('bio', null), 'birthdate' => $request->input('birthdate', null)]
        );

        $validated['author_id'] = $author->id;

        $book = Book::create($validated);
        return response()->json($book, 201);
    }
    #This fuction update a particular selected book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'publishedYear' => 'sometimes|required|integer',
            'genre' => 'sometimes|required|string|max:255',
            'totalCopies' => 'sometimes|required|integer',
            'availableCopies' => 'sometimes|required|integer',
            'coverUrl' => 'sometimes|url',
        ]);

        $book->update($validated);
        return response()->json($book);
    }
     #This fuction deletes a selected book
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
    #This fuction is use to borrow a book if it's available (for members only)
    public function borrow(Request $request, Book $book)
    {
        $user = $request->user();

        if ($user->cannot('borrow-books')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($book->availableCopies < 1) {
            return response()->json(['message' => 'Book is not available for borrowing'], 400);
        }

        $existingLoan = Loan::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->where('status', '!=', 'Returned')
            ->first();

        if ($existingLoan) {
            return response()->json(['message' => 'You already have this book borrowed'], 400);
        }

        $book->availableCopies -= 1;
        $book->save();

        $loan = Loan::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'borrowed_date' => now(),
            'due_date' => now()->addDays(14), // 2 weeks borrowing period
            'status' => 'Borrowed',
        ]);

        return response()->json($loan, 201);
    }

    #This fuction is use to return a book (for members only)
    public function returnBook(Request $request, Book $book)
    {
        $user = $request->user();

        if ($user->cannot('return-books')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $loan = Loan::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['Borrowed', 'Overdue'])
            ->orderBy('borrowed_date', 'desc')
            ->first();

        if (is_null($loan)) {
            return response()->json(['message' => 'Book is not borrowed'], 400);
        }

        $book->availableCopies += 1;
        $book->save();

        $loan->status = 'Returned';
        // $loan->returned_date = now();
        $loan->save();

        return response()->json($loan);
    }
    
}

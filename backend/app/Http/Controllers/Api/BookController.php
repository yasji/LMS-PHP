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
    /**
     * @OA\Get(
     *     path="/api/books",
     *     tags={"Books"},
     *     summary="Get all books",
     *     @OA\Response(
     *         response=200,
     *         description="A list of books",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
     *     )
     * )
     */

    // Define the Book schema here
    /**
     * @OA\Schema(
     *   schema="Book",
     *   type="object",
     *   @OA\Property(property="id", type="integer", description="Book ID"),
     *   @OA\Property(property="title", type="string", description="Book title"),
     *   @OA\Property(property="isbn", type="string", description="ISBN"),
     *   @OA\Property(property="author_id", type="integer", description="Author ID"),
     *   @OA\Property(property="published_date", type="string", format="date", description="Published date"),
     *   @OA\Property(property="status", type="string", enum={"Available", "Borrowed"}, description="Book status")
     * )
     */

    #This fuction returns all the books in the database with both search query by title, isnb, author or name

    // retunr all the books in json format
    public function index()
    {
        Log::info('Showing all books');
        $books = Book::all();
        return response()->json($books);
    }

    // public function index(Request $request)
    // {
    //     $page = $request->get('page', 1);
    //     $search = $request->get('search');
    
    //     return Cache::remember("books.page.{$page}.search.{$search}", 60*60, function () use ($request) {
    //         $query = Book::query();
    
    //         if ($request->has('search')) {
    //             $search = $request->input('search');
    //             $query->where(function ($q) use ($search) {
    //                 $q->where('title', 'like', "%$search%")
    //                   ->orWhere('isbn', 'like', "%$search%")
    //                   ->orWhereHas('author', function ($q) use ($search) {
    //                       $q->where('name', 'like', "%$search%");
    //                   });
    //             });
    //         }
    
    //         return $query->with('author')->paginate(15);
    //     });
    // }

    /**
     * @OA\Get(
     *     path="/api/books/{book}",
     *     tags={"Books"},
     *     summary="Get a specific book by ID",
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         required=true,
     *         description="The ID of the book",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single book",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */

    #This fuction return a particular book selected
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * @OA\Post(
     *     path="/api/books",
     *     tags={"Books"},
     *     summary="Create a new book",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "isbn", "published_date", "author_id", "status"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="isbn", type="string"),
     *             @OA\Property(property="published_date", type="string", format="date"),
     *             @OA\Property(property="author_id", type="integer"),
     *             @OA\Property(property="status", type="string", enum={"Available", "Borrowed"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book created",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */

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


    /**
     * @OA\Put(
     *     path="/api/books/{book}",
     *     tags={"Books"},
     *     summary="Update a book",
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         required=true,
     *         description="The ID of the book to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="isbn", type="string"),
     *             @OA\Property(property="published_date", type="string", format="date"),
     *             @OA\Property(property="author_id", type="integer"),
     *             @OA\Property(property="status", type="string", enum={"Available", "Borrowed"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book updated",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */

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

    /**
     * @OA\Delete(
     *     path="/api/books/{book}",
     *     tags={"Books"},
     *     summary="Delete a book",
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         required=true,
     *         description="The ID of the book to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book deleted"
     *     )
     * )
     */

    #This fuction deletes a selected book
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/books/{book}/borrow",
     *     tags={"Books"},
     *     summary="Borrow a book",
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         required=true,
     *         description="The ID of the book to borrow",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book borrowed",
     *         @OA\JsonContent(ref="#/components/schemas/BorrowRecord")
     *     )
     * )
     */

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

    /**
     * @OA\Post(
     *     path="/api/books/{book}/return",
     *     tags={"Books"},
     *     summary="Return a borrowed book",
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         required=true,
     *         description="The ID of the book to return",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book returned",
     *         @OA\JsonContent(ref="#/components/schemas/BorrowRecord")
     *     )
     * )
     */

    #This fuction return a borrowed book if it's borrowed (for members only)
    // public function return(Book $book)
    // {
    //     if ($book->status !== 'Borrowed') {
    //         return response()->json(['message' => 'Book is not borrowed'], 400);
    //     }

    //     $book->availableCopies -= 1;
    //     $book->save();

    //     $borrowRecord = $book->borrowRecords()->latest()->first();
    //     $borrowRecord->returned_at = now();
    //     $borrowRecord->save();

    //     return response()->json($borrowRecord);
    // }


    public function returnBook(Request $request, Book $book)
    {
        $user = $request->user();

        if ($user->cannot('return-books')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $loan = Loan::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->where('status', 'Borrowed')
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

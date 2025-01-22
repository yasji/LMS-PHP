<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class UserController extends Controller
{

    public function index()
    {
        $users = User::where('role', '!=', 'Admin')
            ->withCount('loans')
            ->with(['loans' => function ($query) {
                $query->where('status', '!=', 'Returned');
            }])
            ->get();

        $users->each(function ($user) {
            $user->active_loans_count = $user->loans->count();
            unset($user->loans);
        });

        return response()->json($users);
    }



    // Retrieve info of authenticated user
     public function me(Request $request)
    {
        Log::info('Entering me method');
        $authenticatedUser = $request->user();
        if (!$authenticatedUser) {
            Log::error('No authenticated user found');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Log::info('Authenticated user', ['user_id' => $authenticatedUser->id]);

        // Load borrowed books
        $borrowedBooks = $authenticatedUser->loans->map(function ($loan) {
            return [
                'book_id' => $loan->book_id,
                'status' => $loan->status,
                'due_date' => $loan->due_date,
            ];
        });
        Log::info('Borrowed books array', ['borrowed_books' => $borrowedBooks]);

        return response()->json([
            'user' => $authenticatedUser->only(['id', 'name', 'email', 'role', 'email_verified_at']),
            'borrowedBooks' => $borrowedBooks
        ]);
    }



    #This fuction return a specific registered user for admin
    public function show(User $user)
    {
        return response()->json($user);
    }

    #This fuction store a new added user by admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Admin,Borrower',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }


    #This fuction update a particular user detail for admin
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|in:Admin,Borrower',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return response()->json($user);
    }

    #This fuction delete a particular user in the database for admin
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/**
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   @OA\Property(property="id", type="integer", description="User ID"),
 *   @OA\Property(property="name", type="string", description="User's name"),
 *   @OA\Property(property="email", type="string", description="User's email"),
 *   @OA\Property(property="password", type="string", description="User's password"),
 *   @OA\Property(property="role", type="string", description="User's role", enum={"Admin", "Librarian", "Member"})
 * )
 */

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get all users",
     *     @OA\Response(
     *         response=200,
     *         description="A list of users",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    #This fuction return all registered users in the database for admin
    // public function index()
    // {
    //     $users = User::all();
    //     return response()->json($users);
    // }
    /**
     * @OA\Get(
     *     path="/api/users/non-admin",
     *     tags={"Users"},
     *     summary="Get all non-admin users with borrowed books count",
     *     @OA\Response(
     *         response=200,
     *         description="A list of non-admin users with borrowed books count",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/users/me",
     *     tags={"Users"},
     *     summary="Get authenticated user info",
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user details",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */






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




    /**
     * @OA\Get(
     *     path="/api/users/userinfo",
     *     tags={"Users"},
     *     summary="Get authenticated user info",
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user details",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
   

    /**
     * @OA\Get(
     *     path="/api/users/authenticated",
     *     tags={"Users"},
     *     summary="Get authenticated user info",
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user details",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    
    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Get a specific user",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User details",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    #This fuction return a specific registered user for admin
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Update an existing user",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Delete a user",
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    #This fuction delete a particular user in the database for admin
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}

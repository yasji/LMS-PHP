<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    
    public function index()
    {
        $categories = Categories::select('id', 'name')
            ->withCount(['books' => function ($query) {
                $query->whereColumn('genre', 'name');
            }])->get();
        return response()->json($categories);
    }

    // public function show($id)
    // {
    //     $category = Category::find($id);
    //     if (!$category) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
    //     return response()->json($category);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categories::create($request->all());
        return response()->json($category, 201);
    }


    public function destroy($id)
    {
        $category = Categories::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
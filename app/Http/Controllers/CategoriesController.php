<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        return response()->json(Categories::all(), 200);
    }   
    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return response()->json(["data" => $category, 'message' => "Showing category with ID: $id"], 200 );                
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Categories::create($validated);
        // Validate and create a new category
        return response()->json(["data" => $validated, 'message' => 'Category created successfully'], 201);
    }   
    public function update(Request $request, $id)                   
    {
        $categories = Categories::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $categories->update($validated);
        // Validate and update the category with the given ID
        return response()->json(["data" => $validated, 'message' => "Category with ID: $id updated successfully"], 200);       
    }   
    public function destroy($id)
    {
        Categories::findOrFail($id)->delete();
        // Delete the category with the given ID
        return response()->json(['message' => "Category with ID: $id deleted successfully"], 200);
    }   
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    //
    public function index()
    {
        return response()->json(Products::all(), 200);
    }   
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return response()->json(["data" => $product, 'message' => "Showing product with ID: $id"], 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imageFile' => 'nullable|image|max:2048',
        ]);
        Products::create($validated);
        // Validate and create a new product
        return response()->json(["data" => $validated, 'message' => 'Product created successfully'], 201);
    }
    public function update(Request $request, $id)       
    {
        $products = Products::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'cost_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imageFile' => 'nullable|image|max:2048',
        ]);

        $products->update($validated);
        // Validate and update the product with the given ID
        return response()->json(["data" => $validated, 'message' => "Product with ID: $id updated successfully"], 200);       
    }

    public function destroy($id)
    {
        Products::findOrFail($id)->delete();
        // Delete the product with the given ID
        return response()->json(['message' => "Product with ID: $id deleted successfully"], 200);
    }
}

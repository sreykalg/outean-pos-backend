<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItems;

class SaleItemsController extends Controller
{
    //
    public function index()
    {
        return response()->json(SaleItems::all(), 200);
    }   
    public function show($id)
    {
        $saleItem = SaleItems::findOrFail($id);
        return response()->json(["data" => $saleItem, 'message' => "Showing sale item with ID: $id"], 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_id' => 'required|integer|exists:sales,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        SaleItems::create($validated);
        // Validate and create a new sale item
        return response()->json(["data" => $validated, 'message' => 'Sale item created successfully'], 201);
    }   
    public function update(Request $request, $id)       
    {
        $saleItems = SaleItems::findOrFail($id);

        $validated = $request->validate([
            'sale_id' => 'required|integer|exists:sales,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        $saleItems->update($validated);
        // Validate and update the sale item with the given ID
        return response()->json(["data" => $validated, 'message' => "Sale item with ID: $id updated successfully"], 200);
    }   
    public function destroy($id)
    {
        SaleItems::findOrFail($id)->delete();
        // Delete the sale item with the given ID
        return response()->json(['message' => "Sale item with ID: $id deleted successfully"], 200);
    }
}
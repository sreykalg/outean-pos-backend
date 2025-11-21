<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    //
    public function index()
    {
        return response()->json(Sales::all(), 200);
    }
    public function show($id)
    {
        $sale = Sales::findOrFail($id);
        return response()->json(["data" => $sale, 'message' => "Showing sale with ID: $id"], 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'sub_total' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|in:paid,unpaid,partial',
        ]);

        Sales::create($validated);
        // Validate and create a new sale
        return response()->json(["data" => $validated, 'message' => 'Sale created successfully'], 201);
    }
    public function update(Request $request, $id)
    {
        $sales = Sales::findOrFail($id);
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|in:paid,unpaid,partial',
        ]);
        $sales->update($validated);
        // Validate and update the sale with the given ID
        return response()->json(["data" => $validated, 'message' => "Sale with ID: $id updated successfully"], 200);
    }
    public function destroy($id)
    {
        Sales::findOrFail($id)->delete();
        // Delete the sale with the given ID
        return response()->json(['message' => "Sale with ID: $id deleted successfully"], 200);
    }
}
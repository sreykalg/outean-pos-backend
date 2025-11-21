<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportsController extends Controller
{
    //
    public function index()
    {
        return response()->json(Reports::all(), 200);
    }   
    public function show($id)
    {
        $report = Reports::findOrFail($id);
        return response()->json(["data" => $report, 'message' => "Showing report with ID: $id"], 200);
    }
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'report_type' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Reports::create($validated);
        // Validate and create a new report
        return response()->json(["data" => $validated, 'message' => 'Report created successfully'], 201);
    }   
    public function update(Request $request, $id)                   
    {
        $report = Reports::findOrFail($id);
        $validated = $request->validate([
            'report_type' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $report->update($validated);
        // Validate and update the report with the given ID
        return response()->json(["data" => $validated, 'message' => "Report with ID: $id updated successfully"], 200);       
    }   
    public function destroy($id)
    {
        Reports::findOrFail($id)->delete();
        // Delete the report with the given ID
        return response()->json(['message' => "Report with ID: $id deleted successfully"], 200);
    }   
}
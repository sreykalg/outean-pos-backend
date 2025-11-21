<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index()
    {
        return response()->json(User::all(), 200);
    }
     
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(["data" => $user, 'message' => "Showing user with ID: $id"], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,staff',
            'status' => 'required|string|in:active,inactive',
        ]);

        User::create($validated);

        // Validate and create a new user
        return response()->json(["data" => $validated, 'message' => 'User created successfully'], 201);
    }   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,staff',
            'status' => 'required|string|in:active,inactive',
        ]);

        $user->update($validated);
        // Validate and update the user with the given ID
        return response()->json(["data" => $validated, 'message' => "User with ID: $id updated successfully"], 200);
    }   
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        // Delete the user with the given ID
        return response()->json(['message' => "User with ID: $id deleted successfully"], 200);
    }
}

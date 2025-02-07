<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        return Todo::create([
            'description' => $validated['description']
        ]);
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        return $todo;
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['message' => 'Todo deleted']);
    }
}
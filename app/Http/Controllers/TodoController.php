<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        \Log::info('Auth Debug', [
            'user' => auth()->user(),
            'check' => auth()->check(),
            'session_id' => session()->getId(),
            'cookies' => request()->cookies->all()
        ]);
    
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    
        return auth()->user()->todos()->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        // Include user_id when creating todo
        return Todo::create([
            'description' => $validated['description'],
            'user_id' => auth()->id()  // Add this line
        ]);
    }

    public function update(Request $request, Todo $todo)
    {
        // Ensure user can only update their own todos
        if ($todo->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        
        return $todo;
    }

    public function destroy(Todo $todo)
    {
        // Ensure user can only delete their own todos
        if ($todo->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $todo->delete();
        return response()->json(['message' => 'Todo deleted']);
    }
}
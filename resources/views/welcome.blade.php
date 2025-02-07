<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        @auth
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}</h1>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
            <div id="app">
                <todo-list></todo-list>
            </div>
        @else
            <div class="text-center">
                <h1 class="text-2xl mb-4">Welcome to Todo App</h1>
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Register</a>
                </div>
            </div>
        @endauth
    </div>
</body>
</html>
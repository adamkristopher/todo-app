<!-- welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-violet-50 via-indigo-50 to-purple-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        @auth
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">
                    Welcome, {{ Auth::user()->name }}
                </h1>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-xl hover:from-red-500 hover:to-red-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Logout
                    </button>
                </form>
            </div>
            <div id="app">
                <todo-list></todo-list>
            </div>
        @else
            <div class="flex flex-col items-center justify-center min-h-[80vh] space-y-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">
                    Welcome to Todo App
                </h1>
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-gradient-to-r from-violet-500 to-indigo-500 text-white rounded-xl hover:from-violet-600 hover:to-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-violet-600 rounded-xl hover:bg-violet-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Register
                    </a>
                </div>
            </div>
        @endauth
    </div>
</body>
</html>
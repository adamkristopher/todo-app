@extends('layouts.app')

@section('content')
<div class="w-full sm:max-w-md mx-auto bg-white rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">
        {{ __('Register') }}
    </h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Name') }}
            </label>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autocomplete="name" 
                autofocus
                class="w-full px-4 py-2 border-2 border-violet-100 rounded-xl focus:border-violet-300 focus:ring-2 focus:ring-violet-200 transition-all duration-200 @error('name') border-red-300 @enderror" 
            >

            @error('name')
                <span class="mt-1 text-sm text-red-500" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Email Address') }}
            </label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email"
                class="w-full px-4 py-2 border-2 border-violet-100 rounded-xl focus:border-violet-300 focus:ring-2 focus:ring-violet-200 transition-all duration-200 @error('email') border-red-300 @enderror" 
            >

            @error('email')
                <span class="mt-1 text-sm text-red-500" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Password') }}
            </label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password"
                class="w-full px-4 py-2 border-2 border-violet-100 rounded-xl focus:border-violet-300 focus:ring-2 focus:ring-violet-200 transition-all duration-200 @error('password') border-red-300 @enderror" 
            >

            @error('password')
                <span class="mt-1 text-sm text-red-500" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Confirm Password') }}
            </label>
            <input 
                id="password-confirm" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                class="w-full px-4 py-2 border-2 border-violet-100 rounded-xl focus:border-violet-300 focus:ring-2 focus:ring-violet-200 transition-all duration-200" 
            >
        </div>

        <div>
            <button 
                type="submit" 
                class="w-full py-2.5 px-4 rounded-xl shadow-lg text-sm font-medium text-white bg-gradient-to-r from-violet-500 to-indigo-500 hover:from-violet-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all duration-200 hover:shadow-xl"
            >
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection
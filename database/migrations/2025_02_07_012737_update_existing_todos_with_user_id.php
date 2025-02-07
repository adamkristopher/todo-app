<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Get the first user or a specific user's ID
        $userId = \App\Models\User::first()->id ?? null;
        
        if ($userId) {
            \App\Models\Todo::whereNull('user_id')->update(['user_id' => $userId]);
        }
    }

    public function down()
    {
        \App\Models\Todo::where('user_id', \App\Models\User::first()->id)
            ->update(['user_id' => null]);
    }
};
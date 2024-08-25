<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::insert([
            "first_name" => "Super",
            "last_name" => "Admin",
            "email" => "superadmin@example.com",
            "username" => "superadmin",
            "email_verified_at" => Carbon::today()->toDateString(),
            "password" => Hash::make('HNrtuh22pESrzCN5@'),
            "type" => 0
        ]);

        User::insert([
            "first_name" => "Admin",
            "last_name" => "One",
            "email" => "admin1@example.com",
            "username" => "admin",
            "email_verified_at" => Carbon::today()->toDateString(),
            "password" => Hash::make('HNrtuh22pESrzCN5@'),
            "type" => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email',"superadmin@example.com")->forceDelete();
        User::where('email','admin1@example.com')->forceDelete();
    }
};

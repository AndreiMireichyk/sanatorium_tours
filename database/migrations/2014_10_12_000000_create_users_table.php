<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 60)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        \App\User::create([
            'name' => 'Api user',
            'email' => 'dnsxss@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Leto2020'),
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

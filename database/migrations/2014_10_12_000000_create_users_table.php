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
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();

            $table->string('name')->comment('Friendly name of the user');
            $table->string('email')->comment('Email associated to the user')->unique();
            $table->timestamp('email_verified_at')->comment('Whether and when the email was verified')->nullable();
            $table->string('password')->comment('Password the user logs in with');
            $table->rememberToken();

            $table->timestamps();
        });
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

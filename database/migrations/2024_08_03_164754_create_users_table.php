<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 100)->nullable(false);
            $table->string('email')->nullable(false)->unique('users_email_unique');
            $table->string('npwp', 15)->nullable(false)->unique('users_npwp_unique');
            $table->string('nik', 16)->nullable(false)->unique('users_nik_unique');
            $table->string('password')->nullable(false);
            $table->string('token', 100)->nullable()->unique('users_token_unique');
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
};

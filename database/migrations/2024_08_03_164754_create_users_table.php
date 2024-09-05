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
            $table->string('email')->nullable(false)->unique('users_email_unique');
            $table->string('password')->nullable(false);
            $table->string('passphrase')->nullable(false)->unique('users_passphrase');
            $table->string('role', 100)->enum('company', 'individual')->default('individual')->nullable(false);
            $table->unsignedBigInteger('profileable_id')->nullable(false);
            $table->string('profileable_type', 100)->nullable(false);
            $table->string('token', 100)->nullable()->unique('users_token_unique');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['profileable_id', 'profileable_type']);
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

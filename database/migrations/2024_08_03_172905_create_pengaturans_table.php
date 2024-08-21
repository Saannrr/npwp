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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->enum('bertindak_sebagai', ['pengurus', 'kuasa']);
            $table->enum('identitas', ['npwp', 'nik']);
            $table->string('npwp_id', 15)->nullable()->unique('pengaturans_npwp_id_unique');
            $table->string('nik_id', 16)->nullable()->unique('pengaturans_nik_id_unique');
            $table->string('nama_penandatangan');
            $table->unsignedBigInteger('user_id');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

            // Menambahkan foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturans');
    }
};

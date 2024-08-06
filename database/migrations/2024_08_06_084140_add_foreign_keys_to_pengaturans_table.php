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
        Schema::table('pengaturans', function (Blueprint $table) {
            // Indeks pada kolom foreign key
            $table->index('npwp_id');
            $table->index('nik_id');

            // Menambahkan foreign key
            $table->foreign('npwp_id')->references('npwp')->on('identitas_orangs')->onDelete('set null');
            $table->foreign('nik_id')->references('nik')->on('identitas_orangs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->dropForeign(['npwp_id']);
            $table->dropForeign(['nik_id']);
            $table->dropIndex(['npwp_id']);
            $table->dropIndex(['nik_id']);
        });
    }
};

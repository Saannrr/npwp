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
        Schema::table('pph_pasals', function (Blueprint $table) {
            // Indeks pada kolom foreign key
            $table->index('kode_objek_pajak');

            $table->foreign('kode_objek_pajak')->on('objek_pajaks')->references('kode_pajak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pph_pasals', function (Blueprint $table) {
            //
        });
    }
};

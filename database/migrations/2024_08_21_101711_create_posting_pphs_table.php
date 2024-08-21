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
        Schema::create('posting_pphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pph_id');
            $table->string('pph_type'); // Menyimpan tipe pajak
            $table->year('tahun_pajak'); // Kolom tahun pajak
            $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']); // Kolom masa pajak
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['pph_id', 'pph_type']); // Untuk mempermudah pencarian
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posting_pphs');
    }
};

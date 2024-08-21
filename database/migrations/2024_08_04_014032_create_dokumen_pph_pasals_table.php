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
        Schema::create('dokumen_pph_pasals', function (Blueprint $table) {
            $table->id();
            $table->enum('nama_dokumen', ['faktur pajak', 'invoice', 'pengumuman', 'surat perjanjian', 'bukti pembayaran', 'akta perikatan', 'akta rups', 'surat pernyataan']);
            $table->string('no_dokumen');
            $table->date('tgl_dokumen');
            $table->unsignedBigInteger('pphpasal_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pphpasal_id')->references('id')->on('pph_pasals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_pph_pasals');
    }
};

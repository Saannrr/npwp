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
        Schema::create('rekam_spt_bps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('jenis_bukti_penyetoran', ['surat setoran pajak', 'pemindahbukuan']);
            $table->string('npwp_id', 15);
            $table->string('ntpn_id', 16)->nullable();
            $table->string('nomor_pemindahbukuan')->nullable();
            $table->year('tahun_pajak');
            $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
            $table->string('jenis_pajak');
            $table->string('jenis_setoran');
            $table->integer('jumlah_setor');
            $table->integer('pph_yang_dipotong');
            $table->timestamp('tanggal_setor');
            $table->boolean('beda_npwp_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ntpn_id')->references('ntpn')->on('pembayaran_spts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekam_spt_bps');
    }
};

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
        Schema::create('pembayaran_spts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('npwp_id', 15);
            $table->string('nama_wp');
            $table->text('alamat_wp');
            $table->string('ntpn', 16)->unique('pembayaran_spts_ntpn_unique');
            $table->string('kode_billing', 15);
            $table->string('kode_jenis_pajak');
            $table->string('kode_jenis_setoran');
            $table->integer('pph_yang_dipotong');
            $table->integer('jumlah_setor');
            $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
            $table->year('tahun_pajak');
            $table->string('nop');
            $table->string('nomor_ketetapan');
            $table->string('uraian')->nullable();
            $table->string('nama_bank');
            $table->string('nomor_transaksi_bank');
            $table->string('npwp_penyetor', 15);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kode_billing')->references('id_billing')->on('perekaman_bps')->onDelete('cascade');
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
        Schema::dropIfExists('pembayaran_spts');
    }
};

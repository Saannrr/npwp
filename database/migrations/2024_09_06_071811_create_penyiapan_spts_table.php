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
        Schema::create('penyiapan_spts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->year('tahun_pajak');
            $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
            $table->string('pbtl_ke')->default('0');
            $table->integer('jumlah_pph_kurang_setor');
            $table->string('status_spt')->default('draft');
            $table->enum('keterangan_spt', ['kurang setor', 'lengkapi spt', 'siap kirim'])->default('kurang setor');
            $table->enum('bertindak_sebagai', ['pengurus', 'kuasa'])->nullable();
            $table->unsignedBigInteger('pengaturan_id')->nullable();
            $table->timestamps();

            $table->foreign('pengaturan_id')->references('id')->on('pengaturans')->onDelete('cascade');
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
        Schema::dropIfExists('penyiapan_spts');
    }
};

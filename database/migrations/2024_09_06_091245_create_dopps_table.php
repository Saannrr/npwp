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
        Schema::create('dopps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyiapan_spt_id');
            $table->unsignedBigInteger('pajak_penghasilan_id');
            $table->string('dopp_point_id');
            $table->string('kode_objek_pajak')->nullable();
            $table->integer('jumlah_dpp')->nullable();
            $table->integer('jumlah_pph')->nullable();
            $table->timestamps();

            $table->foreign('penyiapan_spt_id')->references('id')->on('penyiapan_spts')->onDelete('cascade');
            $table->foreign('pajak_penghasilan_id')->references('id')->on('pajak_penghasilans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dopps');
    }
};

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
        Schema::create('spt', function (Blueprint $table) {
            $table->id();
            $table->string('no_bpe_ntte', 20)->unique();
            $table->string('masa_tahun_pajak', 10);
            $table->integer('pbtl_ke');
            $table->date('tanggal_kirim');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spt');
    }
};

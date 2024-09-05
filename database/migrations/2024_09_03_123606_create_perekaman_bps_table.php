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
        Schema::create('perekaman_bps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pajak_penghasilan_id');
            $table->year('tahun_pajak');
            $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
            $table->string('jenis_pajak');
            $table->string('jenis_setoran');
            $table->integer('pph_yang_dipotong')->nullable();
            $table->string('id_billing')->nullable()->unique('perekaman_bps_id_billing_unique');
            $table->integer('pph_yang_disetor')->nullable();
            $table->integer('selisih')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('perekaman_bps');
    }
};

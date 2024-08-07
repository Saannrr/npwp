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
        Schema::create('pph_pasals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaturan_id')->nullable(false);
            $table->string('tahun_pajak');
            $table->string('masa_pajak');
            $table->string('nama');
            $table->enum('identitas',['npwp','nik']);
            $table->string('npwp_id', 15)->nullable()->unique('pph_pasals_npwp_id_unique');
            $table->string('nik_id', 16)->nullable()->unique('pph_pasals_nik_id_unique');
            $table->unsignedBigInteger('dasar_pemotongan_id')->nullable();
            $table->string('kode_objek_pajak');
            $table->enum('fasilitas_pajak_penghasilan',['tanpa fasilitas','surat keterangan bebas','pph ditanggung pemerintah','surat keterangan berdasarkan pp no 23 2018','fasilitas lainnya berdasarkan']);
            $table->string('no_fasilitas')->nullable();
            $table->string('jumlah_penghasilan_bruto');
            $table->string('tarif');
            $table->string('jumlah_setor');
            $table->enum('kelebihan_pemotongan',['pengembalian','pemindahbukuan']);
            $table->string('status');
            $table->timestamps();

//            $table->foreign('npwp_id')->on('identitas_orangs')->references('npwp');
//            $table->foreign('nik_id')->on('identitas_orangs')->references('nik');
//            $table->foreign('dasar_pemotongan_id')->on('dasar_pemotongans')->references('id');
//            $table->foreign('kode_objek_pajak')->on('objek_pajaks')->references('kode_pajak');
            $table->foreign('pengaturan_id')->on('pengaturans')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pph_pasals');
    }
};

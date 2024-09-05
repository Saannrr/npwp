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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pengaturan_id')->nullable(false);
            $table->enum('penandatangan_bukti_potong', ['pengurus', 'kuasa']);
            $table->year('tahun_pajak');
            $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);
            $table->string('nama');
            $table->enum('identitas', ['npwp', 'nik'])->nullable(false);
            $table->string('npwp_id', 15)->nullable()->unique('pph_pasals_npwp_id_unique');
            $table->string('nik_id', 16)->nullable()->unique('pph_pasals_nik_id_unique');
            $table->unsignedBigInteger('dokumen_pph_pasal_id');
            $table->string('kode_objek_pajak');
            $table->enum('fasilitas_pajak_penghasilan', ['tanpa fasilitas', 'surat keterangan bebas', 'pph ditanggung pemerintah', 'surat keterangan berdasarkan pp no 23 2018', 'fasilitas lainnya berdasarkan'])->nullable(false);
            $table->string('no_fasilitas')->nullable();
            $table->integer('jumlah_penghasilan_bruto');
            $table->decimal('tarif', 5, 4);
            $table->integer('jumlah_setor');
            $table->enum('kelebihan_pemotongan', ['pengembalian', 'pemindahbukuan'])->nullable(false);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
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

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
        Schema::create('pajak_penghasilans', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('pengaturan_id')->nullable();
            // $table->enum('jenis_bukti_penyetoran', ['surat setoran pajak', 'pemindahbukuan'])->nullable();
            // $table->string('nomor_bukti')->nullable();
            // $table->string('nomor_pemindahbukuan')->nullable();
            // $table->enum('masa_pajak', ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->nullable();
            // $table->year('tahun_pajak')->nullable();
            // $table->string('jenis_pajak')->nullable();
            // $table->string('jenis_setoran')->nullable();
            // $table->string('kode_objek_pajak')->nullable();
            // $table->integer('jumlah_penghasilan_bruto')->nullable();
            // $table->integer('jumlah_setor')->nullable();
            // $table->dateTime('tanggal_setor')->nullable();
            // $table->string('nama')->nullable();
            // $table->enum('identitas', ['npwp', 'nik'])->nullable();
            // $table->string('npwp_id', 15)->nullable();
            // $table->string('nik_id', 16)->nullable();
            // $table->enum('penandatangan_bukti_potong', ['pengurus', 'kuasa'])->nullable();
            // $table->unsignedBigInteger('dokumen_pph_pasal_id')->nullable();
            // $table->enum('fasilitas_pajak', ['tanpa fasilitas', 'surat keterangan bebas', 'pph ditanggung pemerintah', 'surat keterangan berdasarkan pp no 23 2018', 'fasilitas lainnya berdasarkan'])->nullable();
            // $table->string('no_fasilitas')->nullable();
            // $table->enum('kelebihan_pemotongan', ['pengembalian', 'pemindahbukuan'])->nullable();
            // $table->string('status')->default('pending');
            // $table->string('tin')->nullable();
            // $table->text('alamat')->nullable();
            // $table->string('negara')->nullable();
            // $table->string('tempat_lahir')->nullable();
            // $table->date('tanggal_lahir')->nullable();
            // $table->string('no_pasport', 16)->nullable();
            // $table->string('no_kitas', 11)->nullable();
            // $table->string('netto')->nullable();
            // $table->decimal('tarif', 5, 4)->nullable();
            // $table->string('pernyataan')->nullable();
            $table->boolean('is_posted')->default(0);
            $table->timestamp('posting_date')->nullable();
            $table->enum('tipe_pph', ['pph sendiri', 'pph pasal', 'pph non', 'import data'])->nullable();
            $table->unsignedBigInteger('pphpasal_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pphpasal_id')->references('id')->on('pph_pasals');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('dokumen_pph_pasal_id')->references('id')->on('dokumen_pph_pasals');
            // $table->foreign('pengaturan_id')->references('id')->on('pengaturans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pajak_penghasilans');
    }
};

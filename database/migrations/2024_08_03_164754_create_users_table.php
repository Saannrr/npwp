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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // Unik otomatis
            $table->string('password');
            $table->string('passphrase')->unique(); // Tidak perlu memberi nama indeks unik
            $table->enum('role', ['company', 'individual'])->default('individual'); // Menggunakan enum yang valid
            $table->string('token', 100)->nullable()->unique(); // Token bisa nullable dan unik
            $table->string('nama');
            $table->string('nip')->nullable(); // NIP hanya untuk individu
            $table->string('jabatan')->nullable(); // Jabatan untuk individu
            $table->string('kategori_perusahaan')->nullable(); // Hanya untuk perusahaan
            $table->string('npwp', 15)->unique(); // NPWP unik dengan panjang 15 karakter
            $table->string('nik', 16)->nullable()->unique(); // NIK hanya untuk individu dan bisa nullable
            $table->text('alamat'); // Alamat tidak nullable
            $table->timestamps();
            $table->softDeletes(); // Soft delete (kolom deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

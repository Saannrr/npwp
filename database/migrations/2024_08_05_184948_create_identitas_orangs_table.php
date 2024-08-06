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
        Schema::create('identitas_orangs', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 200);
                $table->string('nip', 20)->unique('identitas_orang_nip_unique');
                $table->string('jabatan', 100);
                $table->string('npwp', 15)->unique('identitas_orang_npwp_unique');
                $table->string('nik', 16)->unique('identitas_orang_nik_unique');
                $table->text('alamat');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identitas_orangs');
    }
};

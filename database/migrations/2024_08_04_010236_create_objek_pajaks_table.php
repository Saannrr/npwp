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
        Schema::create('objek_pajaks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pajak')->unique('objek_pajaks_kode_pajak_unique');
            $table->string('nama_pajak');
            $table->decimal('persen', 5, 4);
            $table->string('netto')->nullable();
            $table->enum('jenis', ['non_residen', 'pasal']);
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
        Schema::dropIfExists('objek_pajaks');
    }
};

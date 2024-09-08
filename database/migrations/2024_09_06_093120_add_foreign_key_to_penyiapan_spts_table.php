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
        Schema::table('penyiapan_spts', function (Blueprint $table) {
            $table->unsignedBigInteger('lampiran_doss_id')->nullable();
            $table->unsignedBigInteger('lampiran_dopp_id')->nullable();

            $table->foreign('lampiran_doss_id')->references('id')->on('dosses')->onDelete('set null');
            $table->foreign('lampiran_dopp_id')->references('id')->on('dopps')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyiapan_spts', function (Blueprint $table) {
            //
        });
    }
};

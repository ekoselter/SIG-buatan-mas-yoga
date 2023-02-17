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
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id');
            $table->string('map_title')->unique();
            $table->string('map_address');
            $table->text('map_desc');
            $table->text('map_url')->nullable();
            $table->string('map_postcode')->nullable();
            $table->string('map_telp')->nullable();
            $table->string('map_email')->nullable();
            $table->text('map_web')->nullable();
            $table->text('map_img')->nullable();
            $table->string('map_jambuka')->nullable();
            $table->text('map_pimpinan')->nullable();
            $table->string('pend_akredit')->nullable();
            $table->string('pend_kurikulum')->nullable();
            $table->string('pend_waktu')->nullable();
            $table->boolean('kes_rawatinap')->nullable();
            $table->string('kes_igd')->nullable();
            $table->string('kes_harilayanan')->nullable();
            $table->integer('kes_pasien')->nullable();
            $table->string('perd_luas')->nullable();
            $table->string('perd_statustanah')->nullable();
            $table->string('perd_haripasaran')->nullable();
            $table->string('perd_komoditas')->nullable();
            $table->integer('perd_jmlpedagang')->nullable();
            $table->integer('perd_jmlkios')->nullable();
            $table->text('sosmed_fb')->nullable();
            $table->text('sosmed_ig')->nullable();
            $table->text('sosmed_twit')->nullable();
            $table->string('map_latitude');
            $table->string('map_longitude');
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
        Schema::dropIfExists('maps');
    }
};

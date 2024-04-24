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
        Schema::create('pemberitahuan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->text('keterangan')->nullable();
            $table->boolean('dibaca')->default(false);
            $table->enum('status',['terdaftar_periode','rekomendasi_naik_pangkat','batal_rekomendasi_naik_pangkat','perbaikan_berkas','berkas_diterima','sk_kp_dikirim','semua_sk_kp_dikirim'])->nullable(); 
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
        Schema::dropIfExists('pemberitahuans');
    }
};

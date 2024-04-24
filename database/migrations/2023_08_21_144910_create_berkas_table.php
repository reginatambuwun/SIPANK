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
        Schema::create('berkas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('periode_id');
            $table->uuid('alternatif_id');
            $table->string('surat_pengantar_instansi')->nullable();
            $table->string('sk_cpns_pns')->nullable();
            $table->string('kartu_pegawai')->nullable();
            $table->string('skp')->nullable();
            $table->string('sk_pangkat_akhir')->nullable();
            $table->string('sk_jabatan_akhir')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('sk_kp')->nullable(); // berkas ini akan dikirim oleh BKPSDM
            $table->enum('status',['dikirim','perbaikan','diterima'])->nullable();
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
        Schema::dropIfExists('berkas');
    }
};

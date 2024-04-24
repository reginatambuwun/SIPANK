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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('jabatan');

            $table->string('nipl')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();

            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->enum('gol_darah',['A','B','AB','O'])->nullable();
            $table->enum('identitas_diri',['KTP','SIM','Paspor'])->nullable();
            $table->string('nomor_identitas')->nullable();

            $table->string('npwp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kelurahan_desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_telp')->nullable();
            $table->enum('agama',['Islam','Kristen','Katholik','Hindu','Budha'])->nullable();
            $table->enum('status_pernikahan',['Singel','Menikah','Janda','Duda'])->nullable();

            $table->string('tinggi')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('hobi')->nullable();
            $table->date('tmt_bekerja_cpns')->nullable();
            $table->date('tmt_sk_akhir')->nullable();
            $table->string('gol_ruang_awal')->nullable();
            $table->double('nilai_skp')->nullable();
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
        Schema::dropIfExists('pegawais');
    }
};

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
        Schema::create('peninjauan_berkas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('periode_id');
            $table->uuid('alternatif_id');
            $table->string('keterangan')->nullable();
            $table->enum('status',['perbaikan','diterima'])->nullable();
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
        Schema::dropIfExists('peninjauan_berkas');
    }
};

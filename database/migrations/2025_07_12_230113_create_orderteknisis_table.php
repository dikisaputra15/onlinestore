<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderteknisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teknisi_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tarif_id')->nullable();
            $table->unsignedBigInteger('jenis_kerusakan_id');
            $table->date('tgl_order');
            $table->string('nama_pelanggan');
            $table->text('alamat_pelanggan');
            $table->string('pelanggan_latitude');
            $table->string('pelanggan_longitude');
            $table->string('no_hp');
            $table->text('deskripsi');
            $table->double('total_biaya');
            $table->string('status_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderteknisis');
    }
};

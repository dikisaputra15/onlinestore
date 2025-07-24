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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->date('tgl_pemesanan');
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->string('alamat');
            $table->double('total_bayar');
            $table->enum('status', ['Unpaid', 'Paid']);
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

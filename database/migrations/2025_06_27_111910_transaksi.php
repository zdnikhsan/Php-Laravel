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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan')->constrained('pelanggan'); 
            $table->string('id_admin');
            $table->string('no_hp');
            $table->double('berat_pakaian');
            $table->dateTime('tgl_masuk');
            $table->dateTime('tgl_selesai');
            $table->enum('paket', ['1 Hari', '3 Hari', 'Ekspress'])->default('3 Hari');
            $table->integer('jml_transaksi');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

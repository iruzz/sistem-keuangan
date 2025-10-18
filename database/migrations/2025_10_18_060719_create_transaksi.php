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
            $table->string('kode_transaksi', 20)->unique();
            $table->datetime('tanggal');
            $table->string('deskripsi');
            $table->enum('tipe', ['Pemasukan', 'Pengeluaran']);
            $table->decimal('total', 15, 2);
            $table->enum('metode', ['Tunai', 'Transfer']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->index(['tanggal']);
            $table->index(['tipe']);
            $table->index(['user_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

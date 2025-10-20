<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');
            $table->foreignId('akun_id')->constrained('akun')->onDelete('restrict');
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('kredit', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('transaksi_id');
            $table->index('akun_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
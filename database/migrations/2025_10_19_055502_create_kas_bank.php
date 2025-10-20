<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kas_bank', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rekening', 100);
            $table->string('nomor_rekening', 50)->nullable();
            $table->enum('tipe', ['Kas', 'Bank']);
            $table->decimal('saldo', 15, 2)->default(0);
            $table->timestamps();

            $table->index('tipe');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kas_bank');
    }
};
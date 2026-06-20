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
        Schema::create('table_a', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_toko_baru');
            $table->integer('kode_toko_lama')->nullable();
        });

        Schema::create('table_b', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_toko');
            $table->decimal('nominal_transaksi', 8, 2);
        });

        Schema::create('table_c', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_toko');
            $table->string('area_sales', 10);
        });

        Schema::create('table_d', function (Blueprint $table) {
            $table->string('kode_sales', 255);
            $table->string('nama_sales', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_d');
        Schema::dropIfExists('table_c');
        Schema::dropIfExists('table_b');
        Schema::dropIfExists('table_a');
    }
};
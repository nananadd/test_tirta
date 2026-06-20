<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('table_a')->insert([
            ['kode_toko_baru' => 1, 'kode_toko_lama' => 6],
            ['kode_toko_baru' => 2, 'kode_toko_lama' => null],
            ['kode_toko_baru' => 3, 'kode_toko_lama' => 7],
            ['kode_toko_baru' => 4, 'kode_toko_lama' => 9],
            ['kode_toko_baru' => 5, 'kode_toko_lama' => 8],
        ]);

        DB::table('table_b')->insert([
            ['kode_toko' => 1, 'nominal_transaksi' => 1000.00],
            ['kode_toko' => 2, 'nominal_transaksi' => 1000.00],
            ['kode_toko' => 4, 'nominal_transaksi' => 1000.00],
            ['kode_toko' => 6, 'nominal_transaksi' => 1000.00],
            ['kode_toko' => 7, 'nominal_transaksi' => 1000.00],
        ]);

        DB::table('table_c')->insert([
            ['kode_toko' => 1, 'area_sales' => 'A'],
            ['kode_toko' => 2, 'area_sales' => 'A'],
            ['kode_toko' => 3, 'area_sales' => 'A'],
            ['kode_toko' => 4, 'area_sales' => 'B'],
            ['kode_toko' => 5, 'area_sales' => 'B'],
        ]);

        DB::table('table_d')->insert([
            ['kode_sales' => 'A1', 'nama_sales' => 'Alpha'],
            ['kode_sales' => 'A2', 'nama_sales' => 'Blue'],
            ['kode_sales' => 'A3', 'nama_sales' => 'Charlie'],
            ['kode_sales' => 'B1', 'nama_sales' => 'Delta'],
            ['kode_sales' => 'B2', 'nama_sales' => 'Echo'],
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableA;
use App\Models\TableB;
use App\Models\TableC;
use App\Models\Sales;

class DashboardController extends Controller
{
    public function index()
    {
        $total_toko = TableA::count();
        $raw_transaksi = TableB::sum('nominal_transaksi');
        $count_transaksi = TableB::count();
        $total_area = TableC::count();
        $total_sales = Sales::count();

        $total_transaksi = $this->formatSingkat($raw_transaksi);

        return view('dashboard', compact('total_toko', 'total_transaksi', 'count_transaksi', 'total_area', 'total_sales'));
    }

    private function formatSingkat($angka)
    {
        if ($angka >= 1000000000000) {
            return number_format($angka / 1000000000000, 2, ',', '.') . ' T';
        } elseif ($angka >= 1000000000) {
            return number_format($angka / 1000000000, 2, ',', '.') . ' M';
        } elseif ($angka >= 1000000) {
            return number_format($angka / 1000000, 2, ',', '.') . ' Jt';
        }
        
        return number_format($angka, 0, ',', '.');
    }
}
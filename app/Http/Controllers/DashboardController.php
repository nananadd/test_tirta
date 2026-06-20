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
        $total_transaksi = TableB::count();
        $total_area = TableC::count();
        $total_sales = Sales::count();

        return view('dashboard', compact('total_toko', 'total_transaksi', 'total_area', 'total_sales'));
    }
}
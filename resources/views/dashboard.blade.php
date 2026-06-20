@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold text-dark mb-1">Dashboard Overview</h2>
        <p class="text-muted">Selamat datang di Sistem Administrasi Master Data Tirta Dev.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-start border-primary border-4 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Toko (Tabel A)</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">{{ $total_toko ?? '5' }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-store fa-2x text-primary opacity-50"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-start border-success border-4 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Transaksi (Tabel B)</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">{{ $total_transaksi ?? '5' }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-money-bill-wave fa-2x text-success opacity-50"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-start border-info border-4 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">Total Area (Tabel C)</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">{{ $total_area ?? '5' }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-map-location-dot fa-2x text-info opacity-50"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-white border-start border-warning border-4 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">Total Sales (Tabel D)</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">{{ $total_sales ?? '5' }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-user-tie fa-2x text-warning opacity-50"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2 g-4">
    <div class="col-lg-8">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark border-bottom pb-3 mb-4">
                    <i class="fa-solid fa-chart-column text-primary me-2"></i>Distribusi Volume Data
                </h6>
                <div style="height: 300px; width: 100%;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-white border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark border-bottom pb-3 mb-4">
                    <i class="fa-solid fa-chart-pie text-success me-2"></i>Proporsi Master Data
                </h6>
                <div style="height: 300px; display: flex; justify-content: center; align-items: center;">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataValues = [
            {{ $total_toko ?? 0 }}, 
            {{ $total_transaksi ?? 0 }}, 
            {{ $total_area ?? 0 }}, 
            {{ $total_sales ?? 0 }}
        ];
        
        const labels = ['Toko (A)', 'Transaksi (B)', 'Area (C)', 'Sales (D)'];
        
        const bgColors = [
            'rgba(13, 110, 253, 0.7)',
            'rgba(25, 135, 84, 0.7)',
            'rgba(13, 202, 240, 0.7)',
            'rgba(255, 193, 7, 0.7)'
        ];
        const borderColors = [
            'rgb(13, 110, 253)', 
            'rgb(25, 135, 84)', 
            'rgb(13, 202, 240)', 
            'rgb(255, 193, 7)'
        ];

        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Record',
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 20, usePointStyle: true }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection
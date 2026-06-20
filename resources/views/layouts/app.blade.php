<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirta Dev - Master Data Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #11794A;
            --primary-green-hover: #0B5A36;
            --primary-green-light: #E8F3EE;
            --dark-green: #073B23;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #F4F9F6; 
            color: #333;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 260px;
            max-width: 260px;
            min-height: 100vh;
            background-color: var(--dark-green);
            box-shadow: 4px 0 20px rgba(0,0,0,0.05);
            z-index: 100;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px;
            font-size: 1.4rem;
            font-weight: 800;
            color: #ffffff; 
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 15px;
        }

        .sidebar-brand .text-primary, 
        .sidebar-brand i.text-primary {
            color: #4ade80 !important; 
        }

        .sidebar-nav {
            padding: 0 15px;
            list-style: none;
            margin: 0;
        }

        .sidebar-nav .nav-item { margin-bottom: 5px; }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #9ab3a5; 
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 30px;
            text-align: center;
            margin-right: 10px;
            transition: color 0.3s ease;
        }

        .sidebar-nav .nav-link:hover, 
        .sidebar-nav .nav-link.active {
            background-color: var(--primary-green-hover); 
            color: #ffffff; 
        }

        .sidebar-nav .nav-link:hover i,
        .sidebar-nav .nav-link.active i {
            color: #ffffff;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 800;
            color: #5c7e6a; 
            margin: 20px 0 10px 15px;
            letter-spacing: 1px;
        }

        #page-content {
            width: calc(100% - 260px);
            margin-left: 260px;
            min-height: 100vh;
        }

        .top-navbar {
            background-color: #ffffff;
            height: 80px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
            display: flex;
            align-items: center;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .top-navbar .fa-circle-user.text-primary {
            color: var(--primary-green) !important;
        }

        .card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 166, 81, 0.04); transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { box-shadow: 0 8px 25px rgba(0, 166, 81, 0.08); }
        .btn-custom { border-radius: 10px; font-weight: 600; padding: 10px 20px; letter-spacing: 0.3px; }
        
        .btn-primary {
            background-color: var(--primary-green) !important;
            border-color: var(--primary-green) !important;
            color: white !important;
        }
        .btn-primary:hover {
            background-color: var(--primary-green-hover) !important;
            border-color: var(--primary-green-hover) !important;
        }

        .btn-success {
            background-color: var(--dark-green) !important; 
            border-color: var(--dark-green) !important;
            color: white !important;
        }
        .btn-success:hover {
            background-color: #11261c !important; 
            border-color: #11261c !important;
        }

        .btn-outline-success {
            color: var(--dark-green) !important;
            border-color: var(--dark-green) !important;
        }
        .btn-outline-success:hover {
            background-color: var(--dark-green) !important;
            color: white !important;
        }

        .bg-primary.bg-opacity-10 {
            background-color: var(--primary-green-light) !important;
        }
        .text-primary {
            color: var(--primary-green) !important;
        }
        .border-primary {
            border-color: var(--primary-green) !important;
        }

        .table-responsive { border-radius: 12px; overflow: hidden; border: 1px solid #E5F6ED; }
        .table { margin-bottom: 0; }
        .table thead th { 
            background-color: var(--primary-green-light); 
            color: var(--dark-green); 
            font-weight: 700; 
            text-transform: uppercase; 
            font-size: 0.8rem; 
            letter-spacing: 0.5px; 
            padding: 15px; 
            border-bottom: 2px solid #c7ebd7; 
        }
        .table tbody td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f0f9f4; }
        
        .form-control { border-radius: 10px; padding: 10px 15px; border: 1px solid #d1eadd; }
        .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(17, 121, 74, 0.2); border-color: var(--primary-green); }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: var(--primary-green); 
            border-color: #E5F6ED;
            font-weight: 600;
        }

        .pagination .page-link:hover {
            background-color: var(--primary-green-light);
            color: var(--primary-green-hover);
            border-color: #c7ebd7;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
        }

        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.25rem rgba(17, 121, 74, 0.2); 
            color: var(--primary-green);
        }

        #sidebar, #page-content, .sidebar-brand, .nav-link, .sidebar-heading, .sidebar-header {
            transition: all 0.3s ease-in-out;
        }

        body.sidebar-toggled #sidebar {
            min-width: 80px;
            max-width: 80px;
        }

        body.sidebar-toggled #page-content {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        body.sidebar-toggled .brand-text,
        body.sidebar-toggled .brand-icon {
            display: none; 
        }
        
        body.sidebar-toggled .sidebar-header {
            justify-content: center !important; 
            padding: 0 !important;
        }

        body.sidebar-toggled .nav-link {
            font-size: 0; 
            justify-content: center;
            padding: 15px 0;
        }
        body.sidebar-toggled .nav-link i {
            font-size: 1.2rem;
            margin-right: 0;
        }

        body.sidebar-toggled .sidebar-heading {
            display: none;
        }
    </style>
</head>
<body>
    <script>
        if (localStorage.getItem('sidebarState') === 'mini') {
            document.body.classList.add('sidebar-toggled');
        }
    </script>

    <div id="wrapper">
        
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center justify-content-between px-4" style="height: 80px; border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 15px;">
                <a class="sidebar-brand m-0 p-0 border-0 d-flex align-items-center text-decoration-none text-white fw-bold fs-4" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-layer-group text-primary me-2 brand-icon"></i>
                    <span class="brand-text">Tirta<span class="text-primary">Dev</span></span>
                </a>
                <button id="sidebarToggle" class="btn btn-link shadow-none p-0 text-decoration-none">
                    <i class="fa-solid fa-bars fa-lg text-primary"></i>
                </button>
            </div>

            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                </li>
                
                <div class="sidebar-heading">Master Data</div>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('table_a.*') ? 'active' : '' }}" href="{{ route('table_a.index') }}">
                        <i class="fa-solid fa-store"></i> Toko
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('table_b.*') ? 'active' : '' }}" href="{{ route('table_b.index') }}">
                        <i class="fa-solid fa-money-bill-wave"></i> Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('table_c.*') ? 'active' : '' }}" href="{{ route('table_c.index') }}">
                        <i class="fa-solid fa-map-location-dot"></i> Area
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}" href="{{ route('sales.index') }}">
                        <i class="fa-solid fa-user-tie"></i> Sales
                    </a>
                </li>
            </ul>
        </nav>

        <div id="page-content">
            
            <div class="top-navbar">
                <div class="text-muted fw-bold small">
                    <i class="fa-solid fa-calendar-day me-2"></i> {{ date('d F Y') }}
                </div>   
                <div class="ms-auto d-flex align-items-center">
                    <span class="text-dark fw-bold me-2">Administrator</span>
                    <i class="fa-solid fa-circle-user text-primary fa-2x"></i>
                </div>
            </div>

            <div class="container-fluid px-4 py-5">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Ups! Ada kesalahan',
                html: `
                    <ul class="text-start mb-0" style="list-style-position: inside;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Tutup'
            });
        @endif

        function confirmFormSubmit(buttonClass, title, text, icon, confirmColor, confirmText) {
            document.querySelectorAll(buttonClass).forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: confirmColor,
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: confirmText,
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            confirmFormSubmit('.btn-delete', 'Yakin ingin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', 'warning', '#dc3545', '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus!');

            confirmFormSubmit('.btn-confirm-create', 'Simpan Data Baru?', 'Pastikan data yang diisi sudah benar.', 'question', '#0d6efd', '<i class="fa-solid fa-save me-1"></i> Ya, Simpan!');
            
            confirmFormSubmit('.btn-confirm-edit', 'Simpan Perubahan?', 'Data lama akan ditimpa dengan data baru ini.', 'question', '#ffc107', '<i class="fa-solid fa-check me-1"></i> Ya, Update!');
            
            confirmFormSubmit('.btn-confirm-import', 'Import File Excel?', 'Pastikan format file sudah sesuai ketentuan.', 'info', '#198754', '<i class="fa-solid fa-cloud-arrow-up me-1"></i> Ya, Import!');

            const excelButtons = document.querySelectorAll('.btn-preview-excel');
            excelButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.href;

                    Swal.fire({
                        title: 'Preview Export Excel',
                        text: 'Seluruh data pada tabel ini akan diekstrak ke dalam format .xlsx. Lanjutkan proses unduh?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="fa-solid fa-download me-1"></i> Ya, Download!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

        const sidebarToggle = document.getElementById('sidebarToggle');
            const body = document.body;

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    body.classList.toggle('sidebar-toggled');

                    if (body.classList.contains('sidebar-toggled')) {
                        localStorage.setItem('sidebarState', 'mini');
                    } else {
                        localStorage.setItem('sidebarState', 'full');
                    }
                });
            }
        });
    </script>
</body>
</html>
@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-4">
        <h3 class="fw-bold text-dark m-0 ms-3"><i class="fa-solid fa-map-location-dot text-primary me-2"></i> Data Area</h3>
        <p class="text-muted small m-0 mt-1 ms-3">Kelola data pembagian area.</p>
    </div>
    <div class="col-md-8 text-md-end mt-3 mt-md-0 pe-3">
        <button class="btn btn-primary btn-custom shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fa-solid fa-plus me-1"></i> Tambah Data
        </button>
        <button class="btn btn-success btn-custom shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fa-solid fa-cloud-arrow-up me-1"></i> Import
        </button>
        <a href="{{ route('table_c.export.excel') }}" class="btn btn-outline-success btn-custom me-2 btn-preview-excel"><i class="fa-solid fa-file-excel"></i> Excel</a>
        <a href="{{ route('table_c.export.pdf') }}" target="_blank" class="btn btn-outline-danger btn-custom"><i class="fa-solid fa-file-pdf"></i> PDF</a>
    </div>
</div>

<div class="card bg-white shadow-sm border-0" style="border-radius: 16px;">
    <div class="card-body p-0">
        <div class="card-body p-4 pb-0">
            <form method="GET" action="{{ route('table_c.index') }}" id="searchForm">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>

                    <input type="text"
                        id="searchInput"
                        name="search"
                        class="form-control"
                        placeholder="Cari Kode Toko atau Area Sales..."
                        value="{{ request('search') }}"
                        onkeyup="searchData()">
                </div>
            </form>
        </div>
        <div class="table-responsive p-4">
            <table class="table table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th>Kode Toko</th>
                        <th>Area Sales</th>
                        <th style="width: 15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($table_c_data as $index => $item)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                        <td><span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2" style="border-radius: 8px;">{{ $item->kode_toko }}</span></td>
                        <td class="fw-bold text-dark"><i class="fa-solid fa-location-dot text-danger me-1 small"></i> Area {{ $item->area_sales }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-warning text-dark fw-bold" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->kode_toko }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                <form action="{{ route('table_c.destroy', $item->kode_toko) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger fw-bold btn-delete" style="border-radius: 8px;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fa-regular fa-folder-open fa-3x mb-3 d-block"></i>Belum ada data area.</td></tr>
                    @endforelse
                </tbody>
            </table>
            </div> <div class="d-flex justify-content-end mt-4">
                {{ $table_c_data->links() }}
            </div>
        </div>
    </div>
</div>

@foreach($table_c_data as $item)
<div class="modal fade" id="editModal{{ $item->kode_toko }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="fw-bold text-dark"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Edit Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('table_c.update', $item->kode_toko) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kode Toko (Primary Key)</label>
                        <input type="text" class="form-control bg-light text-muted" value="{{ $item->kode_toko }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Area Sales</label>
                        <input type="text" class="form-control" name="area_sales" value="{{ $item->area_sales }}" required>
                    </div>
                    <button type="button" class="btn btn-warning w-100 fw-bold text-dark btn-confirm-edit" style="border-radius: 10px;">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="fw-bold text-dark"><i class="fa-solid fa-plus text-primary me-2"></i>Tambah Data Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('table_c.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kode Toko</label>
                        <input type="number" class="form-control" name="kode_toko" placeholder="Kode Toko" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Area Sales</label>
                        <input type="text" class="form-control" name="area_sales" placeholder="Area Sales" required>
                    </div>
                    <button type="button" class="btn btn-primary w-100 fw-bold btn-confirm-create" style="border-radius: 10px;">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="fw-bold text-dark"><i class="fa-solid fa-cloud-arrow-up text-success me-2"></i>Import Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('table_c.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-bold text-muted m-0">Pilih File (.xlsx, .xls)</label>
                            <a href="{{ asset('templates/template_area_table_c.xlsx') }}" download class="text-decoration-none small text-primary fw-bold">
                                <i class="fa-solid fa-download me-1"></i>Download Template
                            </a>
                        </div>
                        <input type="file" class="form-control" name="file_excel" required>
                    </div>
                    <button type="button" class="btn btn-success w-100 fw-bold btn-confirm-import" style="border-radius: 10px;">Upload & Import</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let timer;

    function searchData() {
        clearTimeout(timer);

        timer = setTimeout(() => {
            localStorage.setItem('searchFocus', 'true');
            document.getElementById('searchForm').submit();
        }, 500);
    }

    window.addEventListener('load', () => {
        if (localStorage.getItem('searchFocus') === 'true') {
            const input = document.getElementById('searchInput');

            input.focus();

            const length = input.value.length;
            input.setSelectionRange(length, length);

            localStorage.removeItem('searchFocus');
        }
    });
</script>
@endsection
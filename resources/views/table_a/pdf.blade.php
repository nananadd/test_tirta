<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Toko</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #2c3e50; margin: 30px; font-size: 14px; }
        .header { text-align: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 3px solid #3498db; }
        .header h2 { margin: 0; padding: 0; text-transform: uppercase; color: #2c3e50; font-size: 24px; font-weight: 800; letter-spacing: 1px; }
        .header p { margin: 8px 0 0 0; color: #7f8c8d; font-size: 12px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; border-radius: 8px; overflow: hidden; }
        th, td { border: 1px solid #ecf0f1; padding: 14px 12px; text-align: left; }
        th { background-color: #f8f9fa; color: #2c3e50; text-transform: uppercase; font-size: 12px; font-weight: bold; border-bottom: 2px solid #bdc3c7; }
        tr:nth-child(even) { background-color: #fafbfc; }
        
        .badge { background-color: #ebf5fb; color: #2980b9; padding: 5px 10px; border-radius: 4px; font-weight: bold; font-size: 12px; display: inline-block; border: 1px solid #d6eaf8; }
        .footer { text-align: center; margin-top: 50px; font-size: 11px; color: #95a5a6; border-top: 1px solid #ecf0f1; padding-top: 20px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Toko</h2>
        <p>Dicetak pada tanggal: {{ date('d-m-Y H:i:s') }} | Sistem Administrasi Tirta Dev</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">No</th>
                <th style="width: 45%;">Kode Toko Baru</th>
                <th>Kode Toko Lama</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($table_a_data as $item)
                <tr>
                    <td style="text-align: center; color: #7f8c8d;">{{ $no++ }}</td>
                    <td><span class="badge">{{ $item->kode_toko_baru }}</span></td>
                    <td style="font-weight: bold; color: #34495e;">{{ $item->kode_toko_lama ?? 'Tidak Ada' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #95a5a6; font-style: italic; padding: 20px;">Tidak ada data toko di database.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini sah di-generate otomatis dari sistem basis data Tirta Dev.</p>
    </div>

</body>
</html>
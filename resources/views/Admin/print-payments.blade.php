<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Semua Pembayaran</title>
</head>
<body>

<h1>Daftar Semua Pembayaran</h1>

{{-- Rekap ini berisi semua pembayaran agar admin bisa print sekaligus. --}}
<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Customer</th>
            <th>Bukti Pembayaran</th>
            <th>Tanggal & Waktu Upload</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        {{-- Loop semua data pembayaran dari AdminController@printPayments. --}}
        @forelse($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->customer_name }}</td>
                <td>
                    @if($payment->payment_proof)
                        <img src="{{ asset('storage/' . $payment->payment_proof) }}" alt="Bukti Pembayaran" width="120">
                    @else
                        Belum Upload
                    @endif
                </td>
                <td>{{ $payment->submitted_at }}</td>
                <td>{{ $payment->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada pembayaran</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Tombol untuk mencetak rekap lewat browser. --}}
<button onclick="window.print()">Print</button>

</body>
</html>

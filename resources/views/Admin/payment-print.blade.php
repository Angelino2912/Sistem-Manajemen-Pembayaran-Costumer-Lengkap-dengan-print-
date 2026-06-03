<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Pembayaran</title>
</head>
<body>

<h1>Bukti Pembayaran</h1>

{{-- Tabel ringkasan data pembayaran untuk dicetak. --}}
<table>
    <tr>
        <td>ID</td>
        <td>{{ $payment->id }}</td>
    </tr>
    <tr>
        <td>Nama Customer</td>
        <td>{{ $payment->customer_name }}</td>
    </tr>
    <tr>
        <td>Tanggal & Waktu Upload</td>
        <td>{{ $payment->submitted_at }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>{{ $payment->status }}</td>
    </tr>
    <tr>
        <td>Catatan</td>
        <td>{{ $payment->note }}</td>
    </tr>
</table>

@if($payment->payment_proof)
    {{-- Gambar bukti upload customer ikut tampil di halaman cetak. --}}
    <h2>Bukti Upload</h2>
    <img src="{{ asset('storage/' . $payment->payment_proof) }}" alt="Bukti Pembayaran" width="300">
@endif

{{-- window.print() memanggil fitur print bawaan browser. --}}
<button onclick="window.print()">Print</button>

</body>
</html>

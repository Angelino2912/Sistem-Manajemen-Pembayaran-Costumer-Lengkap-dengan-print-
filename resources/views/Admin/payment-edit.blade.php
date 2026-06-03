<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pembayaran</title>
</head>
<body>

<h1>Edit Pembayaran</h1>

@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form ini dipakai admin untuk mengubah data pembayaran customer. --}}
<form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        {{-- Data utama customer yang nanti tampil di dashboard dan halaman print. --}}
        <label for="customer_name">Nama Customer</label>
        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $payment->customer_name) }}" required>
    </div>

    <div>
        {{-- Tanggal dan waktu upload dibuat otomatis oleh sistem, admin hanya melihat saja. --}}
        <p>Tanggal & Waktu Upload</p>
        <p>{{ $payment->submitted_at }}</p>
    </div>

    <div>
        {{-- Status dipakai admin untuk menandai pembayaran pending, lunas, atau ditolak. --}}
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="pending" @selected(old('status', $payment->status) === 'pending')>Pending</option>
            <option value="paid" @selected(old('status', $payment->status) === 'paid')>Lunas</option>
            <option value="rejected" @selected(old('status', $payment->status) === 'rejected')>Ditolak</option>
        </select>
    </div>

    <div>
        <label for="note">Catatan</label>
        <textarea id="note" name="note">{{ old('note', $payment->note) }}</textarea>
    </div>

    <div>
        {{-- Link ini membuka file bukti pembayaran yang diupload customer. --}}
        <p>Bukti Pembayaran</p>
        @if($payment->payment_proof)
            <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank">
                Lihat bukti pembayaran
            </a>
        @else
            <span>Belum ada bukti pembayaran</span>
        @endif
    </div>

    <button type="submit">Simpan</button>
    <a href="{{ route('admin.dashboard') }}">Kembali</a>
</form>

</body>
</html>

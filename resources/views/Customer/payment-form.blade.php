@extends('Template.Costumer')

@section('content')
<div class="dashboard-layout">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    
    <form action="/upload"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" required>
    <label for="gambar">Upload Bukti Pembayaran:</label>
    <input type="file" name="gambar" id="gambar" accept="image/*" required>

    <button type="submit">Upload</button>

    <button type="button" onclick="window.location.href='{{ route('customer.payments.create') }}'">Kembali</button>
    </form>
</div>
@endsection

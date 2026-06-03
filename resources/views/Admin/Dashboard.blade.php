<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        Dashboard Pembayaran
    </h1>

    {{-- Print semua data pembayaran sekaligus, jadi admin tidak perlu cetak satu-satu. --}}
    <div class="mb-4">
        <a href="{{ route('admin.payments.print') }}" target="_blank">
            Print Semua Pembayaran
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nama Customer</th>
                    <th class="p-3 text-left">Bukti Pembayaran</th>
                    <th class="p-3 text-left">Tanggal & Waktu Upload</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                    <th class="p-3 text-left">Edit</th>
                    <th class="p-3 text-left">Print</th>
                </tr>

            </thead>

            <tbody>

                {{-- Loop semua data pembayaran yang dikirim dari AdminController@dashboard. --}}
                @forelse($payments as $payment)

                <tr class="border-t">

                    <!-- ID -->
                    <td class="p-3">
                        {{ $payment->id }}
                    </td>

                    <!-- Nama Customer -->
                    <td class="p-3">
                        {{ $payment->customer_name }}
                    </td>

                    <!-- Bukti Pembayaran -->
                    <td class="p-3">

                        @if($payment->payment_proof)

                            <!-- Klik gambar untuk melihat ukuran asli -->
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}"
                               target="_blank">

                                <img
                                    src="{{ asset('storage/' . $payment->payment_proof) }}"
                                    alt="Bukti Pembayaran"
                                    class="w-24 h-24 object-cover border rounded">

                            </a>

                        @else

                            <span class="text-gray-400">
                                Belum Upload
                            </span>

                        @endif

                    </td>

                    <!-- Tanggal dan waktu upload dibuat otomatis oleh sistem. -->
                    <td class="p-3">
                        {{ $payment->submitted_at }}
                    </td>

                    <!-- Status -->
                    <td class="p-3">

                        @if($payment->status == 'paid')

                            <span class="text-green-600 font-bold">
                                Lunas
                            </span>

                        @else

                            <span class="text-yellow-600 font-bold">
                                Pending
                            </span>

                        @endif

                    </td>

                    <!-- Tombol verifikasi untuk mengubah status pembayaran menjadi lunas. -->
                    <td class="p-3">

                        @if($payment->status != 'paid')

                            <form action="{{ route('admin.verify', $payment->id) }}"
                                  method="POST">

                                @csrf

                                <button
                                    class="bg-green-500 text-white px-3 py-1 rounded">

                                    Verifikasi

                                </button>

                            </form>

                        @else

                            ✓

                        @endif

                    </td>

                    <td class="p-3">
                        {{-- Masuk ke form edit data pembayaran customer. --}}
                        <a href="{{ route('admin.payments.edit', $payment->id) }}">
                            Edit
                        </a>
                    </td>

                    <td class="p-3">
                        {{-- Buka halaman cetak untuk satu pembayaran. --}}
                        <a href="{{ route('admin.payments.print-single', $payment->id) }}"
                           target="_blank">
                            Print
                        </a>
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center p-5 text-gray-500">
                        Belum ada pembayaran
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>

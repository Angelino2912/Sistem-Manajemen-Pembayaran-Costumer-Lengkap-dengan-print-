<?php

namespace App\Http\Controllers;
use App\Models\WifiPayment;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function store(Request $request)
    {
        // Validasi input dari form customer sebelum data disimpan.
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
        ]);

        // Simpan file bukti pembayaran ke folder storage/app/public/payment-proofs.
        $path = $request->file('gambar')->store('payment-proofs', 'public');

        // Waktu ini dibuat otomatis oleh sistem saat customer submit form.
        $submittedAt = now();

        // Buat data pembayaran baru agar upload customer muncul di dashboard admin.
        WifiPayment::create([
            'customer_name' => $request->nama,
            'paid_at' => $submittedAt->toDateString(),
            'payment_proof' => $path,
            'submitted_at' => $submittedAt,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil dikirim');
    }
}

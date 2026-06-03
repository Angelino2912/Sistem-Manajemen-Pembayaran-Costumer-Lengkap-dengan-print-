<?php

namespace App\Http\Controllers;

use App\Models\WifiPayment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua pembayaran terbaru untuk ditampilkan di dashboard admin.
        $payments = WifiPayment::latest()->get();

        return view('Admin.Dashboard', compact('payments'));
    }

    public function verifyPayment($id)
    {
        // Cari data pembayaran berdasarkan ID dari route.
        $payment = WifiPayment::findOrFail($id);

        // Ubah status menjadi paid/lunas setelah admin mengecek bukti pembayaran.
        $payment->update([
            'status' => 'paid',
        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi'
        );
    }

    public function editPayment($id)
    {
        // Ambil satu data pembayaran lalu kirim ke halaman form edit.
        $payment = WifiPayment::findOrFail($id);

        return view('Admin.payment-edit', compact('payment'));
    }

    public function updatePayment(Request $request, $id)
    {
        // Validasi data dari form edit admin sebelum update database.
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,rejected',
            'note' => 'nullable|string',
        ]);

        // Simpan perubahan data pembayaran yang diedit oleh admin.
        // Tanggal tidak ikut diupdate karena harus otomatis mengikuti waktu server.
        $payment = WifiPayment::findOrFail($id);
        $payment->update($request->only([
            'customer_name',
            'status',
            'note',
        ]));

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Data pembayaran berhasil diperbarui');
    }

    public function printPayments()
    {
        // Ambil semua pembayaran agar admin bisa print rekap sekaligus.
        $payments = WifiPayment::latest()->get();

        return view('Admin.print-payments', compact('payments'));
    }

    public function printPayment($id)
    {
        // Ambil satu pembayaran untuk dicetak sebagai bukti/nota.
        $payment = WifiPayment::findOrFail($id);

        return view('Admin.payment-print', compact('payment'));
    }
}

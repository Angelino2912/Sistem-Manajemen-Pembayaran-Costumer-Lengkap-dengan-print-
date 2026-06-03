<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::latest()->get();
        return view('admin.dashboard', compact('pelanggan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:lunas,pending,ditolak',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->status_bayar = $request->status;
        $pelanggan->save();

        return response()->json(['success' => true]);
    }
}
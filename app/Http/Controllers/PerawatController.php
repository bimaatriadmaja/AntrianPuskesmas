<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    // public function index()
    // {
    //     return view('perawat.index');
    // }

    public function index(Request $request)
    {
        // Ambil data search dan poli_filter dari request
        $search = $request->get('search');
        $poli_filter = $request->get('poli_filter');

        // Ambil list poli untuk filter
        $poli_list = JadwalDokter::select('poli')->distinct()->pluck('poli');

        // Ambil antrian dengan relasi ke jadwal_dokter dan filter berdasarkan tanggal hari ini
        $antrians = Antrian::with('jadwalDokter')
            ->whereDate('tgl_antrian', now()->toDateString()) // Filter hanya untuk hari ini
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('no_antrian', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('jadwalDokter', function ($q) use ($search) {
                        $q->where('nama_dokter', 'like', '%' . $search . '%')
                            ->orWhere('poli', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when($poli_filter, function ($query) use ($poli_filter) {
                $query->whereHas('jadwalDokter', function ($q) use ($poli_filter) {
                    $q->where('poli', $poli_filter);
                });
            })
            ->paginate(10);

        return view('perawat.index', compact('antrians', 'poli_list', 'search', 'poli_filter'));
    }

    public function editStatus($id)
    {
        // Cari antrian berdasarkan ID
        $antrian = Antrian::findOrFail($id);

        // Tampilkan halaman untuk mengubah status
        return view('perawat.edit-antrian', compact('antrian'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi status yang dikirimkan
        $request->validate([
            'status' => 'required|in:ditunda,dipanggil,dibatalkan',
        ]);

        // Cari antrian berdasarkan ID
        $antrian = Antrian::findOrFail($id);

        // Perbarui status
        $antrian->status = $request->status;
        $antrian->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('perawat.index')->with('success', 'Status antrian berhasil diperbarui.');
    }
}

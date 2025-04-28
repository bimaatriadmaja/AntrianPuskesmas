<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Antrian;
use App\Models\JadwalDokter;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'totalUsers' => User::count(),
            'totalAntrian' => Antrian::whereDate('tgl_antrian', now()->toDateString())->count(),
            'totalDokter' => JadwalDokter::count(),
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return view('admin.menu.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'no_ktp' => 'required|string|max:16',
            'no_hp' => 'required|string|max:15',
            'pekerjaan' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.menu.show-user')->with('success', 'Data berhasil diperbarui!');
    }

    public function profile()
    {
        {
            $users = User::All();
    
            return view('admin.menu.show-user', compact('users'));
        }
    
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.menu.show-user')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function jadwal()
    {
        $jadwal = JadwalDokter::all(); 
        return view('admin.menu.jadwal-show', compact('jadwal'));
    }

    public function create() {
        return view('admin.menu.jadwal-create');
    }

    public function store(Request $request) {
        $request->validate([
            'nip' => 'required|string|unique:jadwal_dokter,nip',
            'nama_dokter' => 'required|string|max:255',
            'poli' => 'required|string',
            'sesi' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        JadwalDokter::create($request->all());

        return redirect()->route('admin.menu.jadwal-show')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function editjadwal($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        return view('admin.menu.jadwal-edit', compact('jadwal'));
    }

    public function updatejadwal(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
    
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'poli' => 'required|in:umum,gigi,tht,lansia & disabilitas,balita,kia & kb,nifas/pnc',
            'sesi' => 'required|in:Pagi,Siang,Sore,Malam',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal->nama_dokter = $request->nama_dokter;
        $jadwal->poli = $request->poli;
        $jadwal->sesi = $request->sesi;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->save();
    
        return redirect()->route('admin.menu.jadwal-show')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function lihatAntrian(Request $request)
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

        // Return view ke admin.menu.antrian-show
        return view('admin.menu.antrian-show', compact('antrians', 'poli_list', 'search', 'poli_filter'));
    }

    
    public function laporanAntrian(Request $request)
    {
        // Ambil data search dan poli_filter dari request
        $search = $request->get('search');
        $poli_filter = $request->get('poli_filter');

        // Ambil list poli untuk filter
        $poli_list = JadwalDokter::select('poli')->distinct()->pluck('poli');

        // Ambil antrian dengan relasi ke jadwal_dokter
        $antrians = Antrian::with('jadwalDokter')
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    // Cari berdasarkan kolom-kolom yang relevan
                    $q->where('no_antrian', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%') // Tambahkan pencarian berdasarkan status
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

        // Return view dengan data antrian dan list poli
        return view('admin.menu.laporan-antrian-show', compact('antrians', 'poli_list', 'search', 'poli_filter'));
    }


    public function panduan()
    {
        // return view('admin.menu.panduan');
    }
}


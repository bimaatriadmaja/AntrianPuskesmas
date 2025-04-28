<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\JadwalDokter;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

class AntrianController extends Controller
{
    public $nip, $nama_dokter, $poli, $kuota, $jam_mulai, $jam_selesai, $no_antrian, $tgl_antrian; 
    public $updateMode = false;
    public $search;
    public $poli_filter; 
    protected $queryString = ['search']; 
    
    // public function index(Request $request)
    // {
    //     $search = $request->get('search'); // Ambil parameter pencarian

    //     // Menjalankan query untuk menggabungkan antrian, users, dan jadwal_dokter
    //     $antrians = Antrian::query()
    //         ->join('users', 'antrian.user_id', '=', 'users.id') // Join dengan tabel users
    //         ->leftJoin('jadwal_dokter', 'antrian.jadwal_dokter_id', '=', 'jadwal_dokter.id') // Left join dengan jadwal_dokter
    //         ->when($search, function ($query) use ($search) {
    //             $query->where('users.name', 'like', '%' . $search . '%') // Cari berdasarkan nama pengguna
    //                 ->orWhere('jadwal_dokter.nama_dokter', 'like', '%' . $search . '%') // Cari berdasarkan nama dokter
    //                 ->orWhere('jadwal_dokter.poli', 'like', '%' . $search . '%'); // Cari berdasarkan poli
    //         })
    //         ->select('antrian.no_antrian', 'antrian.tgl_antrian', 'users.name', 'jadwal_dokter.poli', 'jadwal_dokter.nama_dokter') // Pilih kolom yang dibutuhkan
    //         ->paginate(10); // Paginate hasilnya

    //     // Mengambil daftar poli untuk filter
    //     $poli_list = JadwalDokter::select('poli')->groupBy('poli')->pluck('poli');

    //     return view('dashboard.utama', compact('antrians', 'search', 'poli_list')); // Kirim data ke view
    // }


    public function create()
    {
        // Ambil semua jadwal dokter untuk ditampilkan di form
        $jadwalDokter = JadwalDokter::all();
    
        return view('dashboard.antrian.create', compact('jadwalDokter'));
    }

    public function store(Request $request)
    {
        // Cek waktu saat ini
        $now = Carbon::now();
        $start = Carbon::createFromTime(0, 0);
        $end = Carbon::createFromTime(23, 0);

        if (!$now->between($start, $end)) {
            return redirect()->back()->with('error', 'Pengambilan antrian hanya bisa dilakukan antara jam 00.00 sampai 17.00.');
        }

        // Validasi input
        $request->validate([
            'jadwal_dokter_id' => 'required|exists:jadwal_dokter,id',
        ]);

        $tanggalHariIni = Carbon::today()->toDateString();
        $user = auth()->user();

        // Cek apakah user sudah daftar antrian hari ini untuk jadwal dokter yang sama
        $sudahAda = Antrian::where('user_id', $user->id)
            ->where('jadwal_dokter_id', $request->jadwal_dokter_id)
            ->where('tgl_antrian', $tanggalHariIni)
            ->exists();

        if ($sudahAda) {
            return redirect()->back()->with('error', 'Anda sudah mengambil antrian untuk jadwal dokter tersebut hari ini.');
        }

        // Ambil jadwal dokter dan poli-nya
        $jadwal = JadwalDokter::findOrFail($request->jadwal_dokter_id);
        $poli = strtolower($jadwal->poli);
        $prefix = strtoupper(substr($poli, 0, 1));

        // Cek antrian terakhir hari ini untuk poli tersebut
        $lastAntrian = Antrian::where('tgl_antrian', $tanggalHariIni)
            ->whereHas('jadwalDokter', function ($q) use ($poli) {
                $q->where('poli', $poli);
            })
            ->orderByDesc('no_antrian')
            ->first();

        if ($lastAntrian) {
            $lastNumber = (int) substr($lastAntrian->no_antrian, 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $noAntrian = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Cek kuota
        if ($jadwal->kuota <= 0) {
            return redirect()->back()->with('error', 'Kuota untuk jadwal dokter ini sudah penuh.');
        }

        // Simpan antrian
        Antrian::create([
            'no_antrian' => $noAntrian,
            'user_id' => $user->id,
            'jadwal_dokter_id' => $request->jadwal_dokter_id,
            'tgl_antrian' => $tanggalHariIni,
        ]);

        // Kurangi kuota
        $jadwal->kuota -= 1;
        $jadwal->save();

        return redirect()->route('dashboard.utama')->with('success', 'Antrian berhasil diambil!');
    }


    

    public function save($poli)
    {
        $latestAntrian = Antrian::where('poli', $poli)
            ->where('tgl_antrian', now()->toDateString())
            ->latest('id')
            ->first();
    
        if (!$latestAntrian) {
            $prefixes = [
                'umum' => 'U', 'gigi' => 'G', 'tht' => 'T', 'lansia & disabilitas' => 'L',
                'balita' => 'B', 'kia & kb' => 'K', 'nifas/pnc' => 'N'
            ];
            $no_antrian = isset($prefixes[$poli]) ? $prefixes[$poli] . '1' : 'X1';
        } else {
            $kode_awal = substr($latestAntrian->no_antrian, 0, 1);
            $angka = (int) substr($latestAntrian->no_antrian, 1) + 1;
            $no_antrian = $kode_awal . $angka;
        }
    
        return $no_antrian;
    }

    public function cetakAntrian($id)
    {
        $antrian = Antrian::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $pdf = FacadePdf::loadView('dashboard.antrian.cetak', compact('antrian'));
        return $pdf->stream('antrian-' . $antrian->no_antrian . '.pdf');
    }

    // public function hapusSemua(Request $request)
    // {
    //     // Ambil semua antrian yang ada
    //     $antrians = Antrian::all();
        
    //     // Iterasi setiap antrian untuk mengembalikan kuota
    //     foreach ($antrians as $antrian) {
    //         // Cek apakah jadwal dokter ada
    //         if ($antrian->jadwalDokter) {
    //             // Ambil jadwal dokter
    //             $jadwalDokter = $antrian->jadwalDokter;

    //             // Kembalikan kuota
    //             $jadwalDokter->kuota += 1;
    //             $jadwalDokter->save();
    //         }
    //     }

    //     // Menghapus seluruh data antrian
    //     Antrian::truncate();

    //     // Redirect kembali dengan pesan sukses
    //     return redirect()->route('admin.menu.antrian-show')->with('success', 'Semua antrian telah dihapus dan kuota telah dikembalikan!');
    // }
    

    // Hapus otomatis pake windows task scheduler
    // public function hapusAntrianKadaluarsa()
    // {
    //     $hariIni = Carbon::today()->toDateString();
    
    //     // Ambil semua antrian yang lebih kecil dari hari ini
    //     $antrianKadaluarsa = Antrian::where('tgl_antrian', '<', $hariIni)->get();
    
    //     $jumlahTerhapus = $antrianKadaluarsa->count();
    
    //     // Loop untuk mengupdate kuota jadwal dokter yang relevan
    //     foreach ($antrianKadaluarsa as $antrian) {
    //         $jadwalDokter = $antrian->jadwalDokter;  // Ambil jadwal dokter terkait
    //         if ($jadwalDokter) {
    //             // Tambahkan kuota dokter
    //             $jadwalDokter->kuota += 1;
    //             $jadwalDokter->save();
    //         }
    //     }
    
    //     // Hapus antrian yang kadaluarsa
    //     Antrian::where('tgl_antrian', '<', $hariIni)->delete();
    
    //     return response()->json([
    //         'message' => "$jumlahTerhapus antrian kadaluarsa berhasil dihapus dan kuota dokter telah ditambahkan."
    //     ]);
    // }  
    
    public function editStatus($id)
    {
        // Cari antrian berdasarkan ID
        $antrian = Antrian::findOrFail($id);

        // Tampilkan halaman untuk mengubah status
        return view('admin.menu.edit-status-antrian', compact('antrian'));
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
        return redirect()->route('admin.menu.antrian-show')->with('success', 'Status antrian berhasil diperbarui.');
    }

}

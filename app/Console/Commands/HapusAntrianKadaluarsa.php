<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Antrian;
use Carbon\Carbon;

class HapusAntrianKadaluarsa extends Command
{
    protected $signature = 'antrian:hapus-kadaluarsa';
    protected $description = 'Menghapus antrian yang sudah lewat dari hari ini';

    public function handle()
    {
        $hariIni = Carbon::today()->toDateString();
        $jumlahTerhapus = Antrian::where('tgl_antrian', '<', $hariIni)->delete();

        $this->info("$jumlahTerhapus antrian kadaluarsa berhasil dihapus.");
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;


    protected $table = 'jadwal_dokter';


    protected $fillable = [
        'nip',
        'nama_dokter',
        'poli',
        'kuota',
        'jam_mulai',
        'jam_selesai',
    ];

    public $timestamps = false;

    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}

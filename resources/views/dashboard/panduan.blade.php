@extends('dashboard.layouts.app')

@section('title', 'Panduan') 

@section('content') 
<section id="antrian" class="d-flex align-items-center py-3">
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="card-title mb-4">Panduan Penggunaan Sistem Antrian Puskesmas</h1>
                <p>Selamat datang di sistem antrian online Puskesmas. Panduan ini akan membantu Anda memahami cara menggunakan fitur-fitur yang tersedia.</p>

                <hr>

                <h4 class="mt-4">1. Registrasi Akun</h4>
                <p>Langkah-langkah untuk mendaftar:</p>
                <ul>
                    <li>Klik menu <strong>Register</strong>.</li>
                    <li>Isi data seperti: Nomor KTP, Nama, Email, Alamat, Pekerjaan, Password, dan Konfirmasi Password.</li>
                    <li>Klik tombol <strong>Daftar</strong>.</li>
                </ul>

                <h4 class="mt-4">2. Login</h4>
                <p>Untuk masuk ke sistem:</p>
                <ul>
                    <li>Klik menu <strong>Login</strong>.</li>
                    <li>Masukkan Email dan Password Anda.</li>
                    <li>Klik tombol <strong>Masuk</strong>.</li>
                </ul>

                <h4 class="mt-4">3. Melihat Jadwal Dokter</h4>
                <ul>
                    <li>Klik menu <strong>Jadwal Dokter</strong>.</li>
                    <li>Lihat nama dokter, spesialisasi, dan jadwal praktik.</li>
                </ul>

                <h4 class="mt-4">4. Mengambil Antrian</h4>
                <ul>
                    <li>Pilih menu <strong>Ambil Antrian</strong>.</li>
                    <li>Pilih dokter dan tanggal kunjungan.</li>
                    <li>Klik tombol <strong>Ambil Antrian</strong>.</li>
                    <li>Nomor antrian akan muncul dan disimpan di akun Anda.</li>
                </ul>

                <h4 class="mt-4">5. Mencetak Antrian</h4>
                <ul>
                    <li>Buka menu <strong>Riwayat Antrian</strong> atau <strong>Dashboard</strong>.</li>
                    <li>Klik tombol <strong>Cetak</strong> di samping nomor antrian.</li>
                </ul>

                <h4 class="mt-4">6. Edit Profil</h4>
                <ul>
                    <li>Klik nama Anda di pojok kanan atas, pilih <strong>Edit Profil</strong>.</li>
                    <li>Perbarui informasi Anda dan klik <strong>Simpan</strong>.</li>
                </ul>

                <hr>

                <p class="mt-4">Jika mengalami kesulitan, silakan hubungi petugas atau admin melalui halaman kontak.</p>
            </div>
        </div>
    </div>
</section>
@endsection

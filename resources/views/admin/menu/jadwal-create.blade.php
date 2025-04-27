@extends('admin.layouts.app')

@section('title', 'Jadwal Dokter') 

@section('content') 
<div class="container mt-4">
    <h2>Tambah Jadwal Dokter</h2>
    <form action="{{ route('admin.menu.jadwal-store') }}" method="POST">
        @csrf
    
        <label for="nip">NIP:</label>
        <input type="text" name="nip" class="form-control" required>
    
        <label for="nama_dokter">Nama Dokter:</label>
        <input type="text" name="nama_dokter" class="form-control" required>
    
        <label for="poli">Poli:</label>
        <select name="poli" class="form-control" required>
            <option value="umum">Umum</option>
            <option value="gigi">Gigi</option>
            <option value="tht">THT</option>
            <option value="lansia & disabilitas">Lansia & Disabilitas</option>
            <option value="balita">Balita</option>
            <option value="kia & kb">KIA & KB</option>
            <option value="nifas/pnc">Nifas/PNC</option>
        </select>
    
        <label for="kuota">Kuota Pasien:</label>
        <input type="number" name="kuota" class="form-control" required min="1">
    
        <label for="jam_mulai">Jam Mulai:</label>
        <input type="time" name="jam_mulai" class="form-control" required>
    
        <label for="jam_selesai">Jam Selesai:</label>
        <input type="time" name="jam_selesai" class="form-control" required>
    
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>    
</div>
@endsection

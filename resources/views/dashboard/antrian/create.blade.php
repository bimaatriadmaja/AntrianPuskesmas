@extends('dashboard.layouts.app')

@section('title', 'Home')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2>Buat Antrian Baru</h2>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            {{-- Informasi Nama Pasien dengan input disabled --}}
            <div class="mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <input type="text" class="form-control" id="nama_pasien" value="{{ auth()->user()->name }}" disabled>
            </div>

            <form action="{{ route('antrian.store') }}" method="POST">
                @csrf
                {{-- Tanggal Antrian (otomatis hari ini, hanya informasi) --}}
                <div class="mb-3">
                    <label for="tgl_antrian" class="form-label">Tanggal Antrian</label>
                    <input type="text" class="form-control" id="tgl_antrian" value="{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}" disabled>
                </div>


                {{-- Pilih Jadwal Dokter --}}
                <div class="mb-3">
                    <label for="jadwal_dokter_id" class="form-label">Pilih Dokter & Poli</label>
                    <select name="jadwal_dokter_id" class="form-select" required>
                        <option value="">-- Pilih Dokter & Poli --</option>
                        @foreach($jadwalDokter as $dokter)
                            <option value="{{ $dokter->id }}">
                                {{ $dokter->nama_dokter }} - Poli {{ ucfirst($dokter->poli) }} ({{ $dokter->jam_mulai }} - {{ $dokter->jam_selesai }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Daftar Antrian</button>
            </form>

        </div>
    </div>
</div>
@endsection

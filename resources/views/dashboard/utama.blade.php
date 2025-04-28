@extends('dashboard.layouts.app')

@section('title', 'Home') 

@section('content') 
<div class="container text-center">
    <style>
        .badge-warning {
            background-color: #ffc107; 
            color: #000; 
        }

        .badge-danger {
            background-color: #cf1717;
            color: #fff;
        }

        .badge-success {
            background-color: #28a745;
            color: #fff;
        }

        .badge {
            font-size: 1rem; 
            font-weight: bold; 
        }
    </style>

    <div class="row">
        <div class="d-flex justify-content-center col-md-3">
            <a href="/antrian" class="btn btn-primary w-100 h-80 mb-3" id="ambilAntrian">Ambil Antrian</a>
        </div>
        <div class="text-center mt-2">
            <p> Sebelum mengambil antrian, silakan cek kuota antrian pada hari ini di menu "Jadwal Dokter".</p>
        </div>
        <div class="container">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title text-center">Antrian Saya</div>

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Antrian</th>
                                            <th>Tanggal</th>
                                            <th>Poli</th>
                                            <th>Dokter</th>
                                            <th>Status</th> <!-- Kolom status -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($myAntrians as $antrian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $antrian->user->name }}</td>
                                            <td>{{ $antrian->no_antrian }}</td>
                                            <td>{{ \Carbon\Carbon::parse($antrian->tgl_antrian)->locale('id')->translatedFormat('j F Y') }}</td>
                                            <td>{{ ucfirst($antrian->jadwalDokter->poli ?? '-') }}</td>
                                            <td>{{ $antrian->jadwalDokter->nama_dokter ?? '-' }}</td>                                       
                                            <td>
                                                <span class="badge 
                                                    @if($antrian->status == 'ditunda') badge-warning
                                                    @elseif($antrian->status == 'dipanggil') badge-success
                                                    @elseif($antrian->status == 'dibatalkan') badge-danger
                                                    @endif">
                                                    {{ ucfirst($antrian->status) }}
                                                </span>
                                            </td>                                      
                                            <td>
                                                <a href="{{ route('antrian.pdf', $antrian->id) }}" class="btn btn-primary" target="_blank">Cetak / Lihat PDF</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Semua Antrian -->
        <div class="container">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="card-title text-center">Semua Antrian Hari Ini</div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <form method="GET" action="{{ route('dashboard.utama') }}">
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <input type="text" name="search" value="{{ request()->search }}" class="form-control" placeholder="Cari Nama">
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <select name="poli_filter" class="form-select">
                                                <option value="">Semua Poli</option>
                                                <option value="umum" {{ request()->poli_filter == 'umum' ? 'selected' : '' }}>Umum</option>
                                                <option value="gigi" {{ request()->poli_filter == 'gigi' ? 'selected' : '' }}>Gigi</option>
                                                <option value="tht" {{ request()->poli_filter == 'tht' ? 'selected' : '' }}>THT</option>
                                                <option value="lansia & disabilitas" {{ request()->poli_filter == 'lansia & disabilitas' ? 'selected' : '' }}>Lansia & Disabilitas</option>
                                                <option value="balita" {{ request()->poli_filter == 'balita' ? 'selected' : '' }}>Balita</option>
                                                <option value="kia & kb" {{ request()->poli_filter == 'kia & kb' ? 'selected' : '' }}>KIA & KB</option>
                                                <option value="nifas/pnc" {{ request()->poli_filter == 'nifas/pnc' ? 'selected' : '' }}>Nifas/Pnc</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                            <a href="{{ route('dashboard.utama') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Antrian</th>
                                            <th>Tanggal</th>
                                            <th>Poli</th>
                                            <th>Dokter</th>
                                            <th>Status</th> <!-- Kolom status -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allAntrians as $antrian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $antrian->user->name }}</td>
                                            <td>{{ $antrian->no_antrian }}</td>
                                            <td>{{ \Carbon\Carbon::parse($antrian->tgl_antrian)->locale('id')->translatedFormat('j F Y') }}</td>
                                            <td>{{ ucfirst($antrian->jadwalDokter->poli ?? '-') }}</td>
                                            <td>{{ $antrian->jadwalDokter->nama_dokter ?? '-' }}</td>
                                            <td>
                                                <!-- Menampilkan status antrian -->
                                                <span class="badge 
                                                    @if($antrian->status == 'ditunda') badge-warning
                                                    @elseif($antrian->status == 'dipanggil') badge-success
                                                    @elseif($antrian->status == 'dibatalkan') badge-danger
                                                    @endif">
                                                    {{ ucfirst($antrian->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $allAntrians->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Antrian') 

@section('content')
<div class="container">
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
    <h3>Update Status Antrian</h3>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tampilkan detail antrian -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Detail Antrian</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama Pasien:</strong> {{ $antrian->user->name }}</li>
                <li class="list-group-item"><strong>No. Antrian:</strong> {{ $antrian->no_antrian }}</li>
                <li class="list-group-item"><strong>Poli:</strong> {{ $antrian->jadwalDokter->poli ?? '-' }}</li>
                <li class="list-group-item"><strong>Nama Dokter:</strong> {{ $antrian->jadwalDokter->nama_dokter ?? '-' }}</li>
                <li class="list-group-item"><strong>Tanggal Antrian:</strong> {{ \Carbon\Carbon::parse($antrian->tgl_antrian)->locale('id')->translatedFormat('j F Y') }}</li>
                <li class="list-group-item">
                    <strong>Status Saat Ini:</strong>
                    <span class="badge 
                        @if($antrian->status == 'ditunda') badge-warning
                        @elseif($antrian->status == 'dipanggil') badge-success
                        @elseif($antrian->status == 'dibatalkan') badge-danger
                        @endif">
                        {{ ucfirst($antrian->status) }}
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Form untuk update status -->
    <form action="{{ route('antrian.updateStatus', $antrian->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="status">Ubah Status:</label>
            <select name="status" id="status" class="form-control mt-2">
                <option value="ditunda" {{ $antrian->status == 'ditunda' ? 'selected' : '' }}>Ditunda</option>
                <option value="dipanggil" {{ $antrian->status == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                <option value="dibatalkan" {{ $antrian->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mb-5">Update Status</button>
        <a href="{{ route('admin.menu.antrian-show') }}" class="btn btn-secondary mb-5">Cancel</a>
    </form>
</div>
@endsection

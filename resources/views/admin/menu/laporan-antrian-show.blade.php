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
    <div class="card mt-3">
        <div class="card-body">
            <div class="card-title" style="text-align: center">Semua Antrian</div>
            
            <!-- Pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol untuk menghapus seluruh antrian -->
            {{-- <form action="{{ route('admin.antrian.hapusSemua') }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus semua antrian?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-3">Hapus Semua Antrian</button>
            </form> --}}

            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <form method="GET" action="{{ route('admin.menu.laporan-antrian-show') }}">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <input type="text" name="search" value="{{ request()->search }}" class="form-control" placeholder="Cari Nama">
                                </div>

                                <div class="col-md-4">
                                    <select name="poli_filter" class="form-select">
                                        <option value="">-- Pilih Poli --</option>
                                        @foreach($poli_list as $poli)
                                            <option value="{{ $poli }}" {{ request()->poli_filter == $poli ? 'selected' : '' }}>
                                                {{ ucfirst($poli) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <a href="{{ route('admin.menu.laporan-antrian-show') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_id">
                            <thead>
                                <tr style="text-align: center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>No. Antrian</th>
                                    <th>Poli</th>
                                    <th>Nama Dokter</th>
                                    <th>Tanggal Antrian</th>
                                    <th>Status</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($antrians as $antrian)
                                    <tr style="text-align: center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $antrian->user->name }}</td>
                                        <td>{{ $antrian->no_antrian }}</td>
                                        <td>{{ $antrian->jadwalDokter->poli ?? '-' }}</td>
                                        <td>{{ $antrian->jadwalDokter->nama_dokter ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($antrian->tgl_antrian)->locale('id')->translatedFormat('j F Y') }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($antrian->status == 'ditunda') badge-warning
                                                @elseif($antrian->status == 'dipanggil') badge-success
                                                @elseif($antrian->status == 'dibatalkan') badge-danger
                                                @endif">
                                                {{ ucfirst($antrian->status) }}
                                            </span>
                                        </td>
                                        {{-- <td>
                                            <!-- Tombol Update Status -->
                                            <a href="{{ route('antrian.editStatus', $antrian->id) }}" class="btn btn-primary btn-sm">Update Status</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $antrians->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

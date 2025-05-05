@extends('admin.layouts.app')

@section('title', 'Jadwal Dokter') 

@section('content') 
<div class="container mt-5">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header dan Tombol sejajar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Jadwal Dokter</h2>

        <form action="{{ route('jadwal.resetKuota') }}" method="POST" onsubmit="return confirm('Yakin ingin mereset semua kuota dokter ke 25?')">
            @csrf
            <button type="submit" class="btn btn-danger">Reset Semua Kuota</button>
        </form>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Dokter</th>
                <th>Poli</th>
                <th>Kuota Antrian</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nip }}</td>
                <td>{{ $data->nama_dokter }}</td>
                <td>{{ ucfirst($data->poli) }}</td>
                <td>{{ $data->kuota }}</td>
                <td>{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}</td>
                <td class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('admin.menu.jadwal-edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.menu.jadwal-destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

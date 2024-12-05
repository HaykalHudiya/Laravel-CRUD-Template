@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Data Mahasiswa</h1>
        <a href="{{ route('mhs.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($mahasiswas->isEmpty()) <!-- Memeriksa jika tidak ada data -->
        <h3>Data Tidak di Temukan</h3>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Hobi</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                    <tr>
                        <td>{{ $mahasiswa->id }}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->nim }}</td>
                        <td>{{ $mahasiswa->jurusan }}</td>
                        <td>{{ $mahasiswa->tempat }}</td>
                        <td>{{ $mahasiswa->tanggal_lahir->format('d-M-Y') }}</td>
                        <td>{{ $mahasiswa->hobi }}</td>
                        <td>{{ $mahasiswa->alamat }}</td>
                        <td>
                            @if ($mahasiswa->foto)
                                <img src="{{ asset('uploads/' . $mahasiswa->foto) }}" alt="Foto {{ $mahasiswa->nama }}"
                                    width="150px" height="170px">
                            @else
                                Tidak Ada Foto
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mhs.edit', $mahasiswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('mhs.destroy', $mahasiswa->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

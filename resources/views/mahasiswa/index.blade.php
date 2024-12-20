@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        Daftar Mahasiswa
    </div>
    <div class="card-body">
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-success mb-3">Tambah Mahasiswa</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th> <!-- Menambahkan kolom jurusan -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->jurusan }}</td> <!-- Menampilkan jurusan -->
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirmDelete(event)">
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
</div>
@endsection

@section('scripts')
<script>
    // Fungsi untuk menampilkan konfirmasi sebelum hapus
    function confirmDelete(event) {
        var isConfirmed = confirm("Apakah Anda yakin ingin menghapus mahasiswa ini?");
        if (!isConfirmed) {
            event.preventDefault(); // Mencegah form terkirim jika tidak dikonfirmasi
        }
    }
</script>
@endsection
@extends('layout')

@section('content')
    <h1>Daftar Siswa</h1>

    <!-- Tombol Tambah Siswa -->
    <a href="{{ route('students.create') }}" style="display: inline-block; margin-bottom: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Tambah Siswa</a>

    <!-- Tabel Daftar Siswa -->
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Pendaftaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->registration_date }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('students.edit', $student) }}" style="margin-right: 10px; color: blue;">Edit</a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada siswa yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

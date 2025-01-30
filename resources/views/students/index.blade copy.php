@extends('layout')

@section('content')
    <h1>Daftar Siswa</h1>

    <!-- Tombol Tambah Siswa -->
    <a href="{{ route('students.create') }}" style="display: inline-block; margin-bottom: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Tambah Siswa</a>

    <form method="GET" action="{{ route('students.index') }}" style="margin-bottom: 20px;">
        <label for="month">Bulan:</label>
        <select id="month" name="month" required>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                </option>
            @endfor
        </select>
    
        <label for="year">Tahun:</label>
        <select id="year" name="year" required>
            @for ($i = 2020; $i <= date('Y'); $i++)
                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    
        <button type="submit">Pilih</button>
    </form>    


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

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Checklist 1</th>
                <th>Checklist 2</th>
                <th>Checklist 3</th>
                <th>Checklist 4</th>
                <th>Total Kas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $index => $student)
                @php
                    $checklist = $student->checklists()
                        ->where('month', request('month', date('m')))
                        ->where('year', request('year', date('Y')))
                        ->first();
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        <input type="checkbox" class="checklist" data-student-id="{{ $student->id }}" data-check="1" {{ $checklist && $checklist->check1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" class="checklist" data-student-id="{{ $student->id }}" data-check="2" {{ $checklist && $checklist->check2 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" class="checklist" data-student-id="{{ $student->id }}" data-check="3" {{ $checklist && $checklist->check3 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" class="checklist" data-student-id="{{ $student->id }}" data-check="4" {{ $checklist && $checklist->check4 ? 'checked' : '' }}>
                    </td>
                    <td>{{ $checklist->total_cash ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada siswa yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <script>
        document.querySelectorAll('.checklist').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const studentId = this.dataset.studentId;
                const check = this.dataset.check;
                const month = document.getElementById('month').value;
                const year = document.getElementById('year').value;
    
                fetch("{{ route('students.checklist') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ student_id: studentId, check, month, year })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil diperbarui. Total Kas: ' + data.total_cash);
                    }
                });
            });
        });
    </script>
    
@endsection



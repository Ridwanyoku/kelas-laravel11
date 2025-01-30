@extends('layout')

@section('content')
    <h1>Daftar Siswa</h1>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">Keuangan Kelas</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </nav>
    

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
            @foreach ($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>

        {{-- <form id="resetForm" action="{{ route('reset.totalCash') }}" method="POST">
            @csrf
            <button type="button" class="btn btn-danger" onclick="confirmReset()">Reset Total Kas</button>
        </form>
        
        <script>
            function confirmReset() {
                if (confirm("Apakah Anda yakin ingin mereset total kas semua murid?")) {
                    document.getElementById("resetForm").submit();
                }
            }
        </script> --}}
        
        
        
        {{-- <button type="button" id="add-year">+ Tambah Tahun</button>
        <button type="button" id="delete-year">- Hapus Tahun</button> --}}
        
    
        <button type="submit">Pilih</button>

        
    </form>    

    <div style="margin-top: 20px; font-weight: bold; font-size: 18px;">
        Total Kas Sepanjang Waktu: Rp {{ number_format($totalCashAllTime, 0, ',', '.') }}
    </div>
    
    


    <!-- Tabel Daftar Siswa -->

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
                <th>Aksi</th>
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
                    <td colspan="7" style="text-align: center;">Belum ada siswa yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
    $("#add-year").click(function () {
        let lastYear = parseInt($("#year option:last").val());
        let newYear = lastYear + 1;

        $.ajax({
            url: "{{ route('years.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                year: newYear
            },
            success: function () {
                $("#year").append(`<option value="${newYear}">${newYear}</option>`);
            },
            error: function () {
                alert("Gagal menambah tahun.");
            }
        });
    });

    $("#delete-year").click(function () {
        let selectedYear = $("#year").val();

        if (confirm(`Apakah Anda yakin ingin menghapus tahun ${selectedYear}?`)) {
            $.ajax({
                url: "{{ route('years.destroy') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    year: selectedYear
                },
                success: function () {
                    $("#year option:selected").remove();
                },
                error: function () {
                    alert("Gagal menghapus tahun.");
                }
            });
        }
    });
});

    $(document).ready(function () {
        $('.checklist').change(function () {
            const studentId = $(this).data('student-id');
            const checkNumber = $(this).data('check');
            const isChecked = $(this).is(':checked') ? 1 : 0;

            // Ambil bulan dan tahun dari dropdown
            const month = $('#month').val();
            const year = $('#year').val();

            $.ajax({
                url: '{{ route("checklists.update") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    student_id: studentId,
                    check_number: checkNumber,
                    value: isChecked,
                    month: month,
                    year: year,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>

    
@endsection



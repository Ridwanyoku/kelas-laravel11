@extends('layout')

@section('content')
    {{-- <h1 class="!rounded-button bg-green-600 text-white px-4 py-2 hover:bg-green-700">Daftar Siswa</h1> --}}

    {{-- <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">Keuangan Kelas</a>
       
    </nav> --}}
    



    
    
    
    
    <!-- Tabel Daftar Siswa -->
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-4 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-wallet text-2xl text-custom"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kas Bulan ini</h3>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($totalCashPerMonth, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-wallet text-2xl text-custom"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kas</h3>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($totalCashAllTime, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    {{-- <div style="margin-top: 20px; font-weight: bold; font-size: 18px;">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Total Kas Bulan Ini: Rp {{ number_format($totalCashPerMonth, 0, ',', '.') }}</h3>
            <h3 class="text-lg font-medium text-gray-900">Total Kas Sepanjang Waktu: Rp {{ number_format($totalCashAllTime, 0, ',', '.') }}</h3>
        </div>
    </div> --}}
    <div class="mt-8 bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Riwayat Pembayaran</h2>

                <button class="rounded-button bg-green-600 text-white px-4 py-2 hover:bg-green-700"
                    onclick="exportTableToExcel('pembayaran-table', 'kas_kelas_pembayaran')">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </button>
            </div>
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <div class="flex-1">
                    <input type="text" placeholder="Cari nama siswa..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom" />
                </div>
                {{-- <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-2xl text-green-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Sudah Membayar</h3>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">33 Siswa</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times-circle text-2xl text-red-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Belum Membayar</h3>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">4 Siswa</p>
                        </div>
                    </div>
                </div> --}}
                
                <div class="flex gap-4">
                    {{-- <select class="rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom">
                        <option>Semua Status</option>
                        <option>Lunas</option>
                        <option>Belum Lunas</option>
                    </select> --}}
                    <form class="" method="GET" action="{{ route('students.index') }}">
                        <label for="month">Bulan:</label>
                        <select class="rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom" id="month" name="month" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>
                    
                        <label for="year">Pilih Tahun:</label>
                        <select class="rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom" name="year" id="year" onchange="this.form.submit()">
                            @foreach ($years as $availableYear)
                                <option value="{{ $availableYear }}" {{ $year == $availableYear ? 'selected' : '' }}>
                                    {{ $availableYear }}
                                </option>
                            @endforeach
                        </select>
                
                        {{-- <form id="resetForm" action="{{ route('reset.totalCaysh') }}" method="POST">
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
                        
                    
                        <button class="rounded-button bg-blue-600 text-white px-4 py-2 hover:bg-green-700" type="submit">Pilih</button>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kas bulan ini</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('students.updateCash', $student->id) }}">
                                    @csrf
                                    <input type="number" name="cash_amount" value="{{ $student->checklists->first()->cash_amount ?? 0 }}" required>
                                    <input type="hidden" name="month" value="{{ $month }}">
                                    <input type="hidden" name="year" value="{{ $year }}">
                                    <button class="btn rounded-lg bg-green-600 text-white px-4 py-2 hover:bg-green-700" type="submit">Simpan</button>
                                </form>
                            </td>
                            <td>{{ number_format($student->total_cash_per_year, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                
                {{-- <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Kas</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checklist 1</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checklist 2</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checklist 3</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checklist 4</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
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
                                <td>{{ $checklist->total_cash ?? 0 }}</td>
                                <td>
                                    <input type="checkbox" class="checklist h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" data-student-id="{{ $student->id }}" data-check="1" {{ $checklist && $checklist->check1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class=" checklist h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" data-student-id="{{ $student->id }}" data-check="2" {{ $checklist && $checklist->check2 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checklist h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" data-student-id="{{ $student->id }}" data-check="3" {{ $checklist && $checklist->check3 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checklist h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" data-student-id="{{ $student->id }}" data-check="4" {{ $checklist && $checklist->check4 ? 'checked' : '' }}>
                                </td>
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
                </table> --}}

                {{-- <table class="min-w-full divide-y divide-gray-200 table-auto" id="pembayaran-table">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Siswa
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Minggu 1
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Minggu 2
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Minggu 3
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Minggu 4
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Ahmad Fadillah</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 20.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><input type="checkbox"
                                    class="h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" checked />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><input type="checkbox"
                                    class="h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" checked />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><input type="checkbox"
                                    class="h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><input type="checkbox"
                                    class="h-5 w-5 rounded border-gray-300 text-custom focus:ring-custom" />
                            </td>
                         </tr>
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</main>

    
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



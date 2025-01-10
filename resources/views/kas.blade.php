<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kas Kelas 11 PPLG 1</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet" />
</head>

<body>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Kas Kelas 11 PPLG 1</h1>

        <!-- Pilih Bulan -->
        <div class="mb-5">
            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
            <select id="bulan" name="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="januari">Januari 2025</option>
                <option value="februari">Februari 2025</option>
                <!-- Tambahkan opsi bulan lainnya -->
            </select>
        </div>

        <!-- Tabel Checklist -->
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Check 1</th>
                    <th class="border border-gray-300 px-4 py-2">Check 2</th>
                    <th class="border border-gray-300 px-4 py-2">Check 3</th>
                    <th class="border border-gray-300 px-4 py-2">Check 4</th>
                    <th class="border border-gray-300 px-4 py-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh Data Siswa -->
                @foreach ($siswa as $data)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $data->nama }}</td>
                    @for ($i = 1; $i <= 4; $i++)
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <input type="checkbox" class="checklist" data-id="{{ $data->id }}" data-bulan="{{ $bulan }}" data-check="{{ $i }}">
                    </td>
                    @endfor
                    <td class="border border-gray-300 px-4 py-2">-</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Kas -->
        <div class="mt-5">
            <p class="text-lg font-bold">Total Kas Terkumpul: <span id="totalKas">Rp 0</span></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checklistElements = document.querySelectorAll('.checklist');
            const totalKasElement = document.getElementById('totalKas');

            checklistElements.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });

            function updateTotal() {
                let total = 0;
                checklistElements.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += 5000;
                    }
                });
                totalKasElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            }
        });
    </script>
</body>

</html>

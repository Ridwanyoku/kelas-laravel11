<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengeluaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Riwayat Pengeluaran</h2>

        @if(session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="text-red-600">{{ session('error') }}</p>
        @endif

        <!-- Input Pengeluaran -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Input Pengeluaran Kas</h3>
            <p class="text-lg font-medium text-gray-900 mb-4">Total Kas Sepanjang Waktu: Rp {{ number_format($totalCashAllTime, 0, ',', '.') }}</p>
            <form method="POST" action="{{ route('expenses.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pengeluaran</label>
                    <input type="date" name="date" required
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jumlah Pengeluaran</label>
                    <input type="number" name="amount" required min="1"
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom"
                        placeholder="Masukkan jumlah pengeluaran">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <input type="text" name="description" required
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom"
                        placeholder="Masukkan keterangan pengeluaran">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Tabel Riwayat Pengeluaran -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Pengeluaran</h3>
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($expenses as $key => $expense)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

   <!-- Riwayat Pembayaran Section -->
   <div class="mt-8 bg-white rounded-lg shadow">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-medium text-gray-900">Riwayat Pembayaran</h2>

            <button class="!rounded-button bg-green-600 text-white px-4 py-2 hover:bg-green-700"
                onclick="exportTableToExcel('pembayaran-table', 'kas_kelas_pembayaran')">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </button>
        </div>
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1">
                <input type="text" placeholder="Cari nama siswa..."
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
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
            </div>
            <div class="flex gap-4">
                <select class="rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom">
                    <option>Semua Status</option>
                    <option>Lunas</option>
                    <option>Belum Lunas</option>
                </select>
                <input type="month"
                    class="rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 table-auto" id="pembayaran-table">
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
            </table>
        </div>
    </div>
</div>
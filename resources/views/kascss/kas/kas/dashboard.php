<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kas Kelas 11 PPLG 1</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet" />
    <script
        src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
        data-border-radius="small"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="img/logo.jpg" alt="Logo Sekolah" />
                        <span class="ml-2 text-xl font-semibold text-gray-900 dark:text-white">Kas Kelas 11 PPLG
                            1</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-moon dark:hidden" id="dark-icon"></i>
                        <i class="fas fa-sun hidden dark:block text-white" id="light-icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-4 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-wallet text-2xl text-custom"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kas Terkumpul</h3>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rp 2.500.000</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-money-bill-wave text-2xl text-orange-500"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Pengeluaran</h3>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rp 500.000</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 bg-white rounded-lg shadow">
    <div class="p-6">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-medium text-gray-900">Riwayat Pembayaran</h2>

            <div class="flex gap-1"> <!-- Jarak antar tombol lebih dekat -->
                <!-- Tombol Export Excel -->
                <button class="!rounded-button bg-green-600 text-white px-4 py-2 hover:bg-green-700"
                    onclick="exportTableToExcel('pembayaran-table', 'kas_kelas_pembayaran')">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </button>
                <!-- Tombol Tambah Siswa -->
                <button class="!rounded-button bg-blue-600 text-white px-4 py-2 hover:bg-blue-700"
                    onclick="openAddSiswaPopup()">
                    <i class="fas fa-user-plus mr-2"></i>Tambah Siswa
                </button>
            </div>
        </div>
                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="flex-1">
                        <input type="text" placeholder="Cari nama siswa..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-custom focus:ring-custom" />
                    </div>
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-2xl text-green-500"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">
                                    Sudah Membayar
                                </h3>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-black">
                                    33 Siswa
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-dark-800 rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-times-circle text-2xl text-red-500"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">
                                    Belum Membayar
                                </h3>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-black">
                                    4 Siswa
                                </p>

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

        <?php require_once('footer.php'); ?>
</body>

</html>
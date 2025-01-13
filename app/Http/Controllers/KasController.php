<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\PembayaranKas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', 'januari'); // Default bulan Januari
        $siswa = Siswa::all();
        return view('kas', compact('siswa', 'bulan'));
    }

    public function updateChecklist(Request $request)
    {
        $siswaId = $request->input('siswa_id');
        $bulan = $request->input('bulan');
        $check = $request->input('check');

        // Temukan atau buat data pembayaran
        $pembayaran = PembayaranKas::firstOrCreate(
            ['siswa_id' => $siswaId, 'bulan' => $bulan],
            ['checklist' => 0]
        );

        // Update checklist menggunakan bitmask
        $pembayaran->checklist ^= (1 << ($check - 1));
        $pembayaran->save();

        return response()->json(['success' => true, 'total' => $this->calculateTotal($bulan)]);
    }

    private function calculateTotal($bulan)
    {
        $pembayaran = PembayaranKas::where('bulan', $bulan)->get();
        $total = 0;

        foreach ($pembayaran as $item) {
            $total += substr_count(decbin($item->checklist), '1') * 5000;
        }

        return $total;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentChecklist;

class ChecklistController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'check_number' => 'required|in:1,2,3,4',
            'value' => 'required|boolean',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        // Ambil atau buat checklist untuk siswa di bulan dan tahun tertentu
        $checklist = StudentChecklist::firstOrCreate([
            'student_id' => $request->student_id,
            'month' => $request->month,
            'year' => $request->year,
        ]);

        // Update checklist sesuai dengan nomor yang diubah
        $checkField = 'check' . $request->check_number;
        $checklist->$checkField = $request->value;

        // Hitung ulang total kas berdasarkan checklist
        $checklist->total_cash = 
            ($checklist->check1 ? 5000 : 0) +
            ($checklist->check2 ? 5000 : 0) +
            ($checklist->check3 ? 5000 : 0) +
            ($checklist->check4 ? 5000 : 0);

        $checklist->save();

        return response()->json(['success' => true]);
    }

    public function resetTotalCash()
    {
        // Reset total kas semua siswa ke 0
        StudentChecklist::query()->update(['total_cash' => 0]);

        // Pastikan total kas sepanjang waktu ikut direset
        session()->forget('totalCashAllTime');

        return redirect()->back()->with('success', 'Total kas semua murid telah direset.');
    }


}

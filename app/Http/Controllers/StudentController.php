<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentChecklist;
use App\Models\Year;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $students = Student::with(['checklists' => function ($query) use ($month, $year) {
            $query->where('month', $month)->where('year', $year);
        }])->get();

        // Ambil daftar tahun yang tersedia dari tabel student_checklists
        $years = StudentChecklist::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        // Hitung total kas per siswa sepanjang tahun yang dipilih
        $students->each(function ($student) use ($year) {
            $student->total_cash_per_year = $student->checklists()->where('year', $year)->sum('cash_amount');
        });

        // Hitung total kas per bulan yang dipilih
        $totalCashPerMonth = StudentChecklist::where('month', $month)
            ->where('year', $year)
            ->sum('cash_amount');

        // Hitung total kas sepanjang waktu
        $totalCashAllTime = StudentChecklist::sum('cash_amount');

        return view('students.index', compact('students', 'month', 'year', 'years', 'totalCashPerMonth', 'totalCashAllTime'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Student::create([
            'name' => $request->name,
            'registration_date' => now(), // Set otomatis saat ini
        ]);

        return redirect()->route('students.index')->with('success', 'Peserta berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_date' => 'required|date',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student update succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function updateCash(Request $request, $studentId)
    {
        $request->validate([
            'cash_amount' => 'required|numeric|min:0'
        ]);

        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Simpan atau perbarui kas siswa berdasarkan bulan & tahun
        StudentChecklist::updateOrCreate(
            [
                'student_id' => $studentId,
                'month' => $month,
                'year' => $year,
            ],
            [
                'cash_amount' => $request->input('cash_amount'),
            ]
        );

        return redirect()->route('students.index', ['month' => $month, 'year' => $year])
                     ->with('success', 'Kas berhasil diperbarui!');
    }



}

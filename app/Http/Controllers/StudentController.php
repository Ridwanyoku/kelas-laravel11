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
    
        // Ambil daftar tahun dari database
        $years = Year::orderBy('year', 'asc')->pluck('year');
    
        $students = Student::with(['checklists' => function ($query) use ($month, $year) {
            $query->where('month', $month)->where('year', $year);
        }])->get();
    
        // Hitung total kas sepanjang waktu
        $totalCashAllTime = StudentChecklist::sum('total_cash');
    
        return view('students.index', compact('students', 'month', 'year', 'years', 'totalCashAllTime'));    
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

    public function updateChecklist(Request $request)
    {
        $studentId = $request->input('student_id');
        $check = $request->input('check');
        $month = $request->input('month');
        $year = $request->input('year');

        $checklist = StudentChecklist::firstOrCreate(
            ['student_id' => $studentId, 'month' => $month, 'year' => $year],
            ['total_cash' => 0]
        );

        $field = 'check' . $check;
        $checklist->$field = !$checklist->$field; // Toggle checkbox
        $checklist->total_cash = ($checklist->check1 + $checklist->check2 + $checklist->check3 + $checklist->check4) * 5000;
        $checklist->save();

        return response()->json(['success' => true, 'total_cash' => $checklist->total_cash]);
    }


}

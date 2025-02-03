<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\StudentChecklist;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('date', 'desc')->get();
        $totalCashAllTime = \App\Models\StudentChecklist::sum('total_cash');

        return view('expenses.index', compact('expenses', 'totalCashAllTime'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
        ]);

        // Ambil total kas sepanjang waktu
        $totalCashAllTime = \App\Models\StudentChecklist::sum('total_cash');

        if ($request->amount > $totalCashAllTime) {
            return redirect()->back()->with('error', 'Saldo tidak cukup untuk pengeluaran ini.');
        }

        Expense::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }
}

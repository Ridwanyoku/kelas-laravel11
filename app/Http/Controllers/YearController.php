<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;

class YearController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|unique:years,year',
        ]);

        Year::create(['year' => $request->year]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|exists:years,year',
        ]);

        Year::where('year', $request->year)->delete();

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Username & password yang bisa kamu ubah sesuai keinginan
        $validUsername = 'admin';
        $validPassword = 'password123';

        if ($request->username === $validUsername && $request->password === $validPassword) {
            session(['authenticated' => true]);
            return redirect()->route('students.index');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('authenticated'); // Hapus sesi login
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}

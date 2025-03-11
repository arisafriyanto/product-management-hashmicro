<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Hash};

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $user = DB::select('SELECT * FROM users WHERE email = :email LIMIT 1', ['email' => $attr['email']]);

            if (count($user) > 0) {
                $user = $user[0];

                if (Hash::check($attr['password'], $user->password)) {
                    Auth::loginUsingId($user->id);

                    return redirect()->route('products.index')->with('success', 'Selamat datang, Anda berhasil login.');
                } else {
                    return redirect()->back()->withErrors(['errors' => 'Email atau password salah.']);
                }
            } else {
                return redirect()->back()->withErrors(['errors' => 'Email atau password salah.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

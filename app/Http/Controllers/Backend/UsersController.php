<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{
    public function userView()
    {
        $users = User::latest()->get();
        return view('admin.user.user_view',compact('users'));
    }

   

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Login berhasil
        $user = Auth::user();

        // Ambil isi keranjang dari database (jika ada)
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Simpan ke session (opsional, kalau kamu memang pakai session)
        Session::put('cart', $cartItems);

        return redirect()->intended('/'); // ke halaman home
    } else {
        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }
}


}

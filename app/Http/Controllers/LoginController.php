<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        // dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('tambah-barang.barang');
            } elseif ($user->role === 'user') {
                return redirect()->route('home');
            }
        }
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('message', 'Logged out successfully!');
    }
}

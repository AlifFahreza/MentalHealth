<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->level == 'mahasiswa') {
                return redirect()->intended('mahasiswa');
            }
            return redirect('/');
        }

        return redirect()->route('login')
            ->with('message',"Login Gagal, Cek Email dan Password");
    }

    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }

    public function signUp(){
        return view('sign-up');
    }
    
    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $mahasiswa = new ProfileUser();
        $mahasiswa->name = $validateData['name'];
        $mahasiswa->email = $validateData['email'];
        $mahasiswa->password = bcrypt($validateData['password']);
        $mahasiswa->level = 'mahasiswa';
        $mahasiswa->save();

        return redirect()->route('login')
            ->with('berhasil',"Registrasi Berhasil, Silahkan Login");
    }
}

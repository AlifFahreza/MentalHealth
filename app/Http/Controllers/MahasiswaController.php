<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BlogModel;
use App\Models\VideoModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        $artikel = BlogModel::all();
        return view('mahasiswa.dashboard', ['data' => $artikel], ['mahasiswa' => $mahasiswa]);
    }

    public function landingPage(){
        return view('landing-page');
    }

    public function videoMentalHealth(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        $video = VideoModel::all();
        return view('mahasiswa.videoUser', ['data' => $video], ['mahasiswa' => $mahasiswa]);
    }

        public function contactUs(Request $request){
            $validateData = $request->validate([
                'name' => 'required|min:3|max:50',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required'
            ]);
    
            $mahasiswa = new ContactModel();
            $mahasiswa->name = $validateData['name'];
            $mahasiswa->email = $validateData['email'];
            $mahasiswa->subject = $validateData['subject'];
            $mahasiswa->message = $validateData['message'];
            $mahasiswa->save();
    
            return redirect()->route('landing-page')
                ->with('pesan',"Komentar Anda Berhasil");
        }
    
}

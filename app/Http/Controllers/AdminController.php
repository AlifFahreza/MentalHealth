<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileUser;
use App\Models\ProfilePsikolog;
use App\Models\BlogModel;
use App\Models\VideoModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cohensive\Embed\Facades\Embed;
use Fomvasss\Youtube\Facades\Youtube;

class AdminController extends Controller
{
    public function index(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();

        $countUser = DB::table('profile_user')->count();
        $cPsikolog = ProfilePsikolog::count();
        return view('admin.dashboard', ['mahasiswa' => $mahasiswa], ['countUser' => $countUser], ['cPsikolog' => $cPsikolog]);
    }

    public function showProfile(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.showProfile', ['mahasiswa' => $mahasiswa]);
    }

    public function home(){
        return view('user.dashboard');
    }

    public function pageKelolaUsers(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();

        $mahasiswas = DB::table('profile_user')
        ->select('profile_user.id','profile_user.name','profile_user.email','profile_user.alamat','profile_user.nomor','users.level')
        ->join('users','users.id','=','profile_user.id')
        ->get();
        return view('admin.kelolaUsers',['mahasiswas' => $mahasiswas], ['mahasiswa' => $mahasiswa]);
    }

    public function pageInputPsikolog(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.inputPsikolog', ['mahasiswa' => $mahasiswa]);
    }

    public function pageKelolaPsikolog(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();

        $mahasiswas = ProfilePsikolog::all();
        return view('admin.kelolaPsikolog',['mahasiswas' => $mahasiswas], ['mahasiswa' => $mahasiswa]);
    }

    public function pageKelolaArtikel(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();

        $mahasiswas = BlogModel::all();
        return view('admin.kelolaArtikel',['mahasiswas' => $mahasiswas], ['mahasiswa' => $mahasiswa]);
    }

    public function pageKelolaKonsultasi(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();

        $mahasiswas = VideoModel::all();
        return view('admin.kelolaKonsultasi',['mahasiswas' => $mahasiswas], ['mahasiswa' => $mahasiswa]);
    }

    public function insertUser(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.createUser', ['mahasiswa' => $mahasiswa]);
    }

    public function storeUser(Request $request){
        $validateData = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required',
            'alamat' => 'required',
            'nomor' => 'required',
            'password' => 'required',
        ]);

        $mahasiswa = new ProfileUser();
        $mahasiswa->name = $validateData['name'];
        $mahasiswa->email = $validateData['email'];
        $mahasiswa->alamat = $validateData['alamat'];
        $mahasiswa->nomor = $validateData['nomor'];
        $mahasiswa->password = bcrypt($validateData['password']);
        $mahasiswa->level = 'mahasiswa';
        $mahasiswa->save();

        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        $mahasiswas = ProfileUser::all();

        return redirect()->route('kelola-users')
            ->with('pesan',"Penambahan data {$validateData['name']} berhasil");
    }

    public function showUser(ProfileUser $mahasiswa){
        $mahasiswaku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.showUser', ['data' => $mahasiswa], ['mahasiswa' => $mahasiswaku]);
    }

    public function editUser(ProfileUser $mahasiswa){
        $mahasiswaku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.editUser', ['data' => $mahasiswa], ['mahasiswa' => $mahasiswaku]);
    }

    public function destroyUser(ProfileUser $mahasiswa){
        $mahasiswa->delete();
        return redirect()->route('kelola-users')
                ->with('pesan',"Hapus data $mahasiswa->name berhasil");
    }

    public function updateUser(Request $request, ProfileUser $mahasiswa){
        $validateData = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required',
            'alamat' => 'required',
            'nomor' => 'required',
        ]);

        $mahasiswa->name = $validateData['name'];
        $mahasiswa->email = $validateData['email'];
        $mahasiswa->alamat = $validateData['alamat'];
        $mahasiswa->nomor = $validateData['nomor'];
        $mahasiswa->update();

        return redirect()->route('kelola-users',['mahasiswa'=>$mahasiswa->id])
            ->with('pesan',"Update data {$validateData['name']} berhasil");
    }

    public function storePsikolog(Request $request){
        $validateData = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required',
            'alamat' => 'required',
            'nomor' => 'required',
            'pendidikan' => 'required',
            'pengalaman_kerja' => 'required|numeric',
            'password' => 'required',
            'sertifikasi' => 'required|file|image|max:1000',
        ]);

        $extFile = $request->sertifikasi->getClientOriginalExtension();
        $namaFile = $validateData['name']."-".time().".".$extFile;
        $path = $request->sertifikasi->storeAs('public', $namaFile);

        $mahasiswa = new ProfilePsikolog();
        $mahasiswa->id = Str::random(5);
        $mahasiswa->name = $validateData['name'];
        $mahasiswa->email = $validateData['email'];
        $mahasiswa->alamat = $validateData['alamat'];
        $mahasiswa->nomor = $validateData['nomor'];
        $mahasiswa->pendidikan = $validateData['pendidikan'];
        $mahasiswa->password = bcrypt($validateData['password']);
        $mahasiswa->level = 'psikolog';
        $mahasiswa->pengalaman_kerja = $validateData['pengalaman_kerja']." Tahun";
        $mahasiswa->sertifikasi = $namaFile;
        $mahasiswa->save();

        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        $mahasiswas = ProfileUser::all();

        return redirect()->route('kelola-psikolog')
            ->with('pesan',"Penambahan data Psikolog Atas Nama {$validateData['name']} berhasil");
    }

    public function showPsikolog(ProfilePsikolog $psikolog){
        $psikologku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.showPsikolog', ['data' => $psikolog], ['mahasiswa' => $psikologku]);
    }

    public function destroyPsikolog(ProfilePsikolog $psikolog){
        $psikolog->delete();
        return redirect()->route('kelola-psikolog')
                ->with('pesan',"Hapus data Psikolog Atas Nama $psikolog->name berhasil");
    }

    public function pageInputArtikel(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        $mahasiswas = BlogModel::all();
        return view('admin.insertartikel',['mahasiswas' => $mahasiswas], ['mahasiswa' => $mahasiswa]);
    }

    public function storeArtikel(Request $request){
        $validateData = $request->validate([
            'judul' => 'required|min:5',
            'sinopsis' => 'required|min:5',
            'isi' => 'required',
            'status' => 'required',
            'berkas' => 'required|file|image|max:1000',
        ]);

        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = "atikel-".time().".".$extFile;
        $path = $request->berkas->storeAs('public', $namaFile);
        $idpengirim = User::where('id', Auth::user()->id)->firstOrFail();

        $mahasiswa = new BlogModel();
        $mahasiswa->judul = $validateData['judul'];
        $mahasiswa->sinopsis = $validateData['sinopsis'];
        $mahasiswa->isi = $validateData['isi'];
        $mahasiswa->pengirim = $idpengirim->name;
        $mahasiswa->status = $validateData['status'];
        $mahasiswa->berkas = $namaFile;
        $mahasiswa->save();

        return redirect()->route('kelola-artikel')
                ->with('pesan',"Artikel dengan judul {$validateData['judul']} berhasil ditambahkan");
    }

    public function showArtikel(BlogModel $artikel){
        $mahasiswaku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('mahasiswa.blogSingle', ['data' => $artikel], ['mahasiswa' => $mahasiswaku]);
    }

    public function editArtikel(BlogModel $artikel){
        $mahasiswaku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.editArtikel', ['data' => $artikel], ['mahasiswa' => $mahasiswaku]);
    }

    public function updateArtikel(Request $request, BlogModel $artikel){
        $validateData = $request->validate([
            'judul' => 'required|min:5',
            'sinopsis' => 'required|min:5',
            'isi' => 'required',
            'status' => 'required',
            'berkas' => 'required|file|image|max:1000',
        ]);

        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = "atikel-".time().".".$extFile;
        $path = $request->berkas->storeAs('public', $namaFile);
        $idpengirim = User::where('id', Auth::user()->id)->firstOrFail();

        $mahasiswa = new BlogModel();
        $mahasiswa->judul = $validateData['judul'];
        $mahasiswa->sinopsis = $validateData['sinopsis'];
        $mahasiswa->isi = $validateData['isi'];
        $mahasiswa->pengirim = $idpengirim->name;
        $mahasiswa->status = $validateData['status'];
        $mahasiswa->berkas = $namaFile;
        $mahasiswa->update();

        return redirect()->route('kelola-artikel',['video'=>$video->id])
                ->with('pesan',"Video {$validateData['judul']} berhasil diupdate");
    }

    public function destroyArtikel(BlogModel $artikel){
        $artikel->delete();
        return redirect()->route('kelola-artikel')
                ->with('pesan',"Artikel dengan judul $artikel->judul berhasil dihapus");
    }

    public function insertVideo(){
        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.insertVideo', ['mahasiswa' => $mahasiswa]);
    }

    public function storeVideo(Request $request){
        $validateData = $request->validate([
            'judul' => 'required|min:3',
            'link' => 'required',
            'deskripsi' => 'required',
        ]);

        $mahasiswa = new VideoModel();
        $mahasiswa->judul = $validateData['judul'];
        $mahasiswa->link = $validateData['link'];
        $mahasiswa->deskripsi = $validateData['deskripsi'];
        $mahasiswa->save();

        $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();

        return redirect()->route('kelola-konsultasi')
            ->with('pesan',"Penambahan Video {$validateData['judul']} berhasil");
    }

    public function destroyVideo(VideoModel $video){
        $video->delete();
        return redirect()->route('kelola-konsultasi')
                ->with('pesan',"Video dengan judul $video->judul berhasil dihapus");
    }

    public function editVideo(VideoModel $video){
        $mahasiswaku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.editVideo', ['data' => $video], ['mahasiswa' => $mahasiswaku]);
    }

    public function updateVideo(Request $request, VideoModel $video){
        $validateData = $request->validate([
            'judul' => 'required|min:3',
            'link' => 'required',
            'deskripsi' => 'required',
        ]);

        $mahasiswa = new VideoModel();
        $mahasiswa->judul = $validateData['judul'];
        $mahasiswa->link = $validateData['link'];
        $mahasiswa->deskripsi = $validateData['deskripsi'];
        $mahasiswa->update();

        return redirect()->route('kelola-konsultasi')
                ->with('pesan',"Video {$validateData['judul']} berhasil diupdate");
    }

    public function showVideo(VideoModel $video){
        $mahasiswaku = User::where('id', Auth::user()->id)->firstOrFail();
        return view('admin.showVideo', ['data' => $video], ['mahasiswa' => $mahasiswaku]);
    }

    // public function editPsikolog(ProfilePsikolog $psikolog){
    //     $psikologku = User::where('id', Auth::user()->id)->firstOrFail();
    //     return view('admin.editPsikolog', ['data' => $psikolog], ['mahasiswa' => $psikologku]);
    // }

    // public function updatePsikolog(Request $request, ProfilePsikolog $psikolog){
    //     $validateData = $request->validate([
    //         'name' => 'required|min:3|max:50',
    //         'email' => 'required',
    //         'alamat' => 'required',
    //         'nomor' => 'required',
    //         'pendidikan' => 'required',
    //         'pengalaman_kerja' => 'required',
    //         'password' => 'required',
    //         'sertifikasi' => 'required|file|image|max:1000',
    //     ]);

    //     $extFile = $request->sertifikasi->getClientOriginalExtension();
    //     $namaFile = $validateData['name']."-".time().".".$extFile;
    //     $path = $request->sertifikasi->storeAs('public', $namaFile);

    //     $mahasiswa = new ProfilePsikolog();
    //     $mahasiswa->id = Str::random(5);
    //     $mahasiswa->name = $validateData['name'];
    //     $mahasiswa->email = $validateData['email'];
    //     $mahasiswa->alamat = $validateData['alamat'];
    //     $mahasiswa->nomor = $validateData['nomor'];
    //     $mahasiswa->pendidikan = $validateData['pendidikan'];
    //     $mahasiswa->password = bcrypt($validateData['password']);
    //     $mahasiswa->level = 'psikolog';
    //     $mahasiswa->pengalaman_kerja = $validateData['pengalaman_kerja'];
    //     $mahasiswa->sertifikasi = $namaFile;
    //     $mahasiswa->save();

    //     $mahasiswa = User::where('id', Auth::user()->id)->firstOrFail();
    //     $mahasiswas = ProfilePsikolog::all();

    //     return redirect()->route('kelola-psikolog',['mahasiswa'=>$mahasiswa->id])
    //         ->with('pesan',"Update data Psikolog Atas Nama{$validateData['name']} berhasil");
    // }
}
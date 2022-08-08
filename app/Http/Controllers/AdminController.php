<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar data posyandu
     * 
     * @return void
     */
    public function list_posyandu() {
        $data = DB::table('posyandu')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-posyandu', compact(['data', 'empty']));
    }

     /**
      * Menampilah view admin/tambah-posyandu
      * 
      * @return view admin/tambah-posyandu
      */
    public function tambah_posyandu() {
        return view('admin.tambah-posyandu');
     }

     /**
      * Menyimpan data posyandu ke database
      * 
      * @param Request $req
      * @return redirect()
      */
    public function tambah_posyandu_act(Request $req) {

        $req->validate([
            'nama'=> 'required|max:255',
            'jenis_posyandu'=> [Rule::in(['balita', 'lansia']), 'required'],
            'alamat'=> 'required',

        ],
        [
            'nama.required'=> 'Kolom nama harus diisi.',
            'nama.max'=> 'Jumlah karakter melebihi 255 karakter.',
            'jenis_posyandu.required'=> 'Kolom jenis posyandu harus diisi.',
            'jenis_posyandu.in'=> $req->jenis_posyandu . ' tidak valid.',
            'alamat.required'=> 'Kolom alamat harus diisi.',
        ]);

        DB::transaction(function () use ($req){
            $posyandu = new Posyandu();
            $posyandu->nama = $req->nama;
            $posyandu->jenis_posyandu = $req->jenis_posyandu;
            $posyandu->alamat = $req->alamat;
            $posyandu->save();
        });

        return redirect()->route('admin.list_posyandu')->with('sukses', 'Berhasil menambahkan data posyandu.');
     }

    /**
      * Menampilah view admin/update-posyandu
      * 
      * @param id_posyandu $id
      * @return view admin/update-posyandu
      */
    public function update_posyandu($id) {
        $data = Posyandu::findOrFail($id);

        return view('admin.update-posyandu', compact('data'));
     }

    /**
      * Update data posyandu ke database
      * 
      * @param Request $req
      * @param id_posyandu $id
      * @return redirect()
      */
    public function update_posyandu_act(Request $req, $id) {
        $req->validate([
            'nama'=> 'required|max:255',
            'jenis_posyandu'=> [Rule::in(['balita', 'lansia']), 'required'],
            'alamat'=> 'required',

        ],
        [
            'nama.required'=> 'Kolom nama harus diisi.',
            'nama.max'=> 'Jumlah karakter melebihi 255 karakter.',
            'jenis_posyandu.required'=> 'Kolom jenis posyandu harus diisi.',
            'jenis_posyandu.in'=> $req->jenis_posyandu . ' tidak valid.',
            'alamat.required'=> 'Kolom alamat harus diisi.',
        ]);

        DB::transaction(function () use ($req, $id){
            $posyandu = Posyandu::findOrFail($id);
            $posyandu->nama = $req->nama;
            $posyandu->jenis_posyandu = $req->jenis_posyandu;
            $posyandu->alamat = $req->alamat;
            $posyandu->update();
        });

        return redirect()->route('admin.list_posyandu')->with('sukses', 'Berhasil mengubah data posyandu.');
     }

    /**
      * Menghapus data posyandu
      * 
      * @param id_posyandu $id
      * @return redirect()
      */
    public function delete_posyandu($id) {
        DB::transaction(function () use ($id){
            $posyandu = Posyandu::findOrFail($id);
            $posyandu->is_deleted = 1;
            $posyandu->update();
        });

        return redirect()->route('admin.list_posyandu')->with('sukses', 'Berhasil menghapus data posyandu.');
     }

    /**
     * Menampilkan daftar data balita
     * 
     * @return void
     */
    public function list_balita() {
        $data = DB::table('balita')
            ->select('id_balita', 'nik', 'nama', 'no_kk', 'nama_orangtua', 'jenis_kelamin', 'tanggal_lahir')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-balita', compact(['data', 'empty']));
    }


    /**
      * Menampilah view admin/tambah-balita
      * 
      * @return view admin/tambah-balita
      */
      public function tambah_balita() {
        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.tambah-balita', compact('posyandu'));
     }

    /**
      * Menampilah view admin/tambah-balita
      * 
      * @return view admin/tambah-balita
      */
      public function tambah_balita_act(Request $req) {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'nik_orangtua'=> 'required|digits:16|numeric',
            'nama_orangtua'=> 'required',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tanggal_lahir'=> 'required|date',
            'berat_badan_lahir'=> 'required|numeric',
            'tinggi_badan_lahir'=> 'required|numeric',

        ],
        [
            'nama.required'=> 'Kolom nama harus diisi.',
            'nik.required'=> 'Kolom "NIK" harus diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" harus diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'nik_orangtua.required'=> 'Kolom "NIK orang tua" harus diisi.',
            'nik_orangtua.digits'=> 'Jumlah digit "NIK orang tua" tidak valid.',
            'nik_orangtua.numeric'=> 'Kolom "NIK orang tua" tidak bisa diisikan selain angka.',
            'nama_orangtua.required'=> 'Kolom "nama orang tua" harus diisi.',
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" harus diisi.',
            'tanggal_lahir.date'=> 'Format "tanggal lahir" tidak valid.',
            'berat_badan_lahir.required'=> 'Kolom "berat badan saat lahir" harus diisi.',
            'berat_badan_lahir.numeric'=> 'Kolom "berat badan saat lahir" tidak bisa diisikan selain angka.',
            'tinggi_badan_lahir.required'=> 'Kolom "tinggi badan saat lahir" harus diisi.',
            'tinggi_badan_lahir.numeric'=> 'Kolom "tinggi badan saat lahir" tidak bisa diisikan selain angka.',
        ]);

        DB::transaction(function () use ($req){
            $balita = new Balita();
            $balita->nama = $req->nama;
            $balita->nik = $req->nik;
            $balita->no_kk = $req->no_kk;
            $balita->nik_orangtua = $req->nik_orangtua;
            $balita->nama_orangtua = $req->nama_orangtua;
            $balita->tanggal_lahir = $req->tanggal_lahir;
            $balita->jenis_kelamin = $req->jenis_kelamin;
            $balita->berat_badan_lahir = $req->berat_badan_lahir;
            $balita->tinggi_badan_lahir = $req->tinggi_badan_lahir;
            $balita->id_posyandu = $req->posyandu;
            $balita->save();
        });

        return redirect()->route('admin.list_balita')->with('sukses', 'Berhasil menambahkan data balita.');
     }

}

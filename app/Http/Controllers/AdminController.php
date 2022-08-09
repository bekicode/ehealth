<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Lansia;
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
    public function list_posyandu() 
    {
        $data = DB::table('posyandu')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-posyandu', compact(['data', 'empty']));
    }

     /**
      * Menampilkan view admin/tambah-posyandu
      * 
      * @return view admin/tambah-posyandu
      */
    public function tambah_posyandu() 
    {
        return view('admin.tambah-posyandu');
    }

     /**
      * Menyimpan data posyandu ke database
      * 
      * @param Request $req
      * @return redirect()
      */
    public function tambah_posyandu_act(Request $req) 
    {

        $req->validate([
            'nama'=> 'required|max:255',
            'jenis_posyandu'=> [Rule::in(['balita', 'lansia']), 'required'],
            'alamat'=> 'required',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nama.max'=> 'Jumlah karakter melebihi 255 karakter.',
            'jenis_posyandu.required'=> 'Kolom jenis posyandu wajib diisi.',
            'jenis_posyandu.in'=> $req->jenis_posyandu . ' tidak valid.',
            'alamat.required'=> 'Kolom alamat wajib diisi.',
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
      * Menampilkan view admin/update-posyandu
      * 
      * @param id_posyandu $id
      * @return view admin/update-posyandu
      */
    public function update_posyandu($id) 
    {
        $data = Posyandu::findOrFail($id);

        return view('admin.update-posyandu', compact('data'));
    }

    /**
      * Update data posyandu ke database
      * 
      * @param Request $req
      * @param id_posyandu $id
      * @return redirect to admin.list_posyandu
      */
    public function update_posyandu_act(Request $req, $id) 
    {
        $req->validate([
            'nama'=> 'required|max:255',
            'jenis_posyandu'=> [Rule::in(['balita', 'lansia']), 'required'],
            'alamat'=> 'required',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nama.max'=> 'Jumlah karakter melebihi 255 karakter.',
            'jenis_posyandu.required'=> 'Kolom jenis posyandu wajib diisi.',
            'jenis_posyandu.in'=> $req->jenis_posyandu . ' tidak valid.',
            'alamat.required'=> 'Kolom alamat wajib diisi.',
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
    public function delete_posyandu($id) 
    {
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
    public function list_balita() 
    {
        $data = DB::table('balita')
            ->select('id_balita', 'nik', 'nama', 'no_kk', 'nama_orangtua', 'jenis_kelamin', 'tanggal_lahir')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-balita', compact(['data', 'empty']));
    }


    /**
      * Menampilkan view admin/tambah-balita
      * 
      * @return view admin/tambah-balita
      */
    public function tambah_balita() 
    {
        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.tambah-balita', compact('posyandu'));
    }

    /**
      * Menyimpan data balita ke database
      * 
      * @return redirect to admin.list_balita
      */
    public function tambah_balita_act(Request $req) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\Balita,nik',
            'no_kk'=> 'required|digits:16|numeric',
            'nik_orangtua'=> 'required|digits:16|numeric',
            'nama_orangtua'=> 'required',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',
            'tanggal_lahir'=> 'required|date',
            'berat_badan_lahir'=> 'required|numeric',
            'tinggi_badan_lahir'=> 'required|numeric',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'nik.unique'=> 'Nomor "NIK" sudah digunakan.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'nik_orangtua.required'=> 'Kolom "NIK orang tua" wajib diisi.',
            'nik_orangtua.digits'=> 'Jumlah digit "NIK orang tua" tidak valid.',
            'nik_orangtua.numeric'=> 'Kolom "NIK orang tua" tidak bisa diisikan selain angka.',
            'nama_orangtua.required'=> 'Kolom "nama orang tua" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "tanggal lahir" tidak valid.',
            'berat_badan_lahir.required'=> 'Kolom "berat badan saat lahir" wajib diisi.',
            'berat_badan_lahir.numeric'=> 'Kolom "berat badan saat lahir" tidak bisa diisikan selain angka.',
            'tinggi_badan_lahir.required'=> 'Kolom "tinggi badan saat lahir" wajib diisi.',
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

    /**
      * Menampilkan view admin/update-balita
      * 
      * @param id_balita $id
      * @return view admin/update-balita
      */
    public function update_balita($id) 
    {
        $data = Balita::findOrFail($id);

        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.update-balita', compact('data', 'posyandu'));
    }

    /**
      * Mengubah data balita
      * 
      * @param id_balita $id
      * @return redirect to admin.list_balita
      */
    public function update_balita_act(Request $req, $id) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'nik_orangtua'=> 'required|digits:16|numeric',
            'nama_orangtua'=> 'required',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',
            'tanggal_lahir'=> 'required|date',
            'berat_badan_lahir'=> 'required|numeric',
            'tinggi_badan_lahir'=> 'required|numeric',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'nik_orangtua.required'=> 'Kolom "NIK orang tua" wajib diisi.',
            'nik_orangtua.digits'=> 'Jumlah digit "NIK orang tua" tidak valid.',
            'nik_orangtua.numeric'=> 'Kolom "NIK orang tua" tidak bisa diisikan selain angka.',
            'nama_orangtua.required'=> 'Kolom "nama orang tua" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "tanggal lahir" tidak valid.',
            'berat_badan_lahir.required'=> 'Kolom "berat badan saat lahir" wajib diisi.',
            'berat_badan_lahir.numeric'=> 'Kolom "berat badan saat lahir" tidak bisa diisikan selain angka.',
            'tinggi_badan_lahir.required'=> 'Kolom "tinggi badan saat lahir" wajib diisi.',
            'tinggi_badan_lahir.numeric'=> 'Kolom "tinggi badan saat lahir" tidak bisa diisikan selain angka.',
        ]);
        
        DB::transaction(function () use ($req, $id){
            $balita = Balita::findOrFail($id);
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

        return redirect()->route('admin.list_balita')->with('sukses', 'Berhasil mengubah data balita.');
    }

    /**
      * Menghapus data balita
      * 
      * @param id_balita $id
      * @return redirect()
      */
    public function delete_balita($id) 
    {
        DB::transaction(function () use ($id){
            $balita = Balita::findOrFail($id);
            $balita->is_deleted = 1;
            $balita->update();
        });

        return redirect()->route('admin.list_balita')->with('sukses', 'Berhasil menghapus data balita.');
    }

    /**
     * Menampilkan daftar data ibu hamil
     * 
     * @return void
     */
    public function list_ibu_hamil() 
    {
        $data = DB::table('ibu_hamil')
            ->select('id_ibu_hamil', 'nik', 'nama', 'no_kk', 'HPHT', 'HPL', 'no_telepon')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-ibu-hamil', compact(['data', 'empty']));
    }

    /**
      * Menampilkan view admin/tambah-ibu-hamil
      * 
      * @return view admin/tambah-ibu-hamil
      */
    public function tambah_ibu_hamil() 
    {
        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.tambah-ibu-hamil', compact('posyandu'));
    }

    /**
      * Menyimpan data ibu hamil ke database
      * 
      * @return redirect to admin.list_ibu_hamil
      */
    public function tambah_ibu_hamil_act(Request $req) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\IbuHamil,nik',
            'no_kk'=> 'required|digits:16|numeric',
            'no_telepon'=> 'required|numeric',
            'alamat'=> 'required',
            'nama_ayah'=> 'required',
            'nama_ibu'=> 'required',
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',
            'hpht'=> 'required|date',
            'hpl'=> 'required|date',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'nik.unique'=> 'Nomor "NIK" sudah digunakan.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'alamat.required'=> 'Kolom "alamat" wajib diisi.',
            'nama_ayah.required'=> 'Kolom "nama ayah" wajib diisi.',
            'nama_ibu.required'=> 'Kolom "nama ibu" wajib diisi.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
            'hpht.required'=> 'Kolom "Hari Pertama Haid Terakhir" wajib diisi.',
            'hpht.date'=> 'Format tanggal "Hari Pertama Haid Terakhir" tidak valid.',
            'hpl.required'=> 'Kolom "Hari Perkiraan Lahir" wajib diisi.',
            'hpl.date'=> 'Format tanggal "Hari Perkiraan Lahir" tidak valid.',
        ]);

        DB::transaction(function () use ($req){
            $ibu_hamil = new IbuHamil();
            $ibu_hamil->nama = $req->nama;
            $ibu_hamil->nik = $req->nik;
            $ibu_hamil->no_kk = $req->no_kk;
            $ibu_hamil->no_telepon = $req->no_telepon;
            $ibu_hamil->alamat = $req->alamat;
            $ibu_hamil->nama_ayah = $req->nama_ayah;
            $ibu_hamil->nama_ibu = $req->nama_ibu;
            $ibu_hamil->id_posyandu = $req->posyandu;
            $ibu_hamil->HPHT = $req->hpht;
            $ibu_hamil->HPL = $req->hpl;
            $ibu_hamil->save();
        });

        return redirect()->route('admin.list_ibu_hamil')->with('sukses', 'Berhasil menambahkan data ibu hamil.');
    }

    /**
      * Menampilkan view admin/update-ibu-hamil
      * 
      * @param id_ibu_hamil $id
      * @return view admin/update-ibu-hamil
      */
    public function update_ibu_hamil($id) 
    {
        $data = IbuHamil::findOrFail($id);

        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.update-ibu-hamil', compact('data', 'posyandu'));
    }

    /**
      * Mengubah data ibu hamil ke database
      * 
      * @param id_ibu_hamil $id
      * @return redirect to admin.list_ibu_hamil
      */
    public function update_ibu_hamil_act(Request $req, $id) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'no_telepon'=> 'required|numeric',
            'alamat'=> 'required',
            'nama_ayah'=> 'required',
            'nama_ibu'=> 'required',
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',
            'hpht'=> 'required|date',
            'hpl'=> 'required|date',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'alamat.required'=> 'Kolom "alamat" wajib diisi.',
            'nama_ayah.required'=> 'Kolom "nama ayah" wajib diisi.',
            'nama_ibu.required'=> 'Kolom "nama ibu" wajib diisi.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
            'hpht.required'=> 'Kolom "Hari Pertama Haid Terakhir" wajib diisi.',
            'hpht.date'=> 'Format tanggal "Hari Pertama Haid Terakhir" tidak valid.',
            'hpl.required'=> 'Kolom "Hari Perkiraan Lahir" wajib diisi.',
            'hpl.date'=> 'Format tanggal "Hari Perkiraan Lahir" tidak valid.',
        ]);

        DB::transaction(function () use ($req, $id){
            $ibu_hamil = IbuHamil::findOrFail($id);
            $ibu_hamil->nama = $req->nama;
            $ibu_hamil->nik = $req->nik;
            $ibu_hamil->no_kk = $req->no_kk;
            $ibu_hamil->no_telepon = $req->no_telepon;
            $ibu_hamil->alamat = $req->alamat;
            $ibu_hamil->nama_ayah = $req->nama_ayah;
            $ibu_hamil->nama_ibu = $req->nama_ibu;
            $ibu_hamil->id_posyandu = $req->posyandu;
            $ibu_hamil->HPHT = $req->hpht;
            $ibu_hamil->HPL = $req->hpl;
            $ibu_hamil->update();
        });

        return redirect()->route('admin.list_ibu_hamil')->with('sukses', 'Berhasil mengubah data ibu hamil.');
    }

    /**
      * Menghapus data ibu hamil
      * 
      * @param id_ibu_hamil $id
      * @return redirect()
      */
    public function delete_ibu_hamil($id) 
    {
        DB::transaction(function () use ($id){
            $ibu_hamil = IbuHamil::findOrFail($id);
            $ibu_hamil->is_deleted = 1;
            $ibu_hamil->update();
        });

        return redirect()->route('admin.list_ibu_hamil')->with('sukses', 'Berhasil menghapus data ibu hamil.');
    }

    /**
     * Menampilkan daftar data lansia
     * 
     * @return view admin.list-lansia
     */
    public function list_lansia() 
    {
        $data = DB::table('lansia')
            ->select('id_lansia', 'nik', 'nama', 'no_kk', 'tanggal_lahir', 'jenis_kelamin')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-lansia', compact(['data', 'empty']));
    }

    /**
      * Menampilkan view admin/tambah-lansia
      * 
      * @param id_posyandu $id
      * @return view admin/tambah-lansia
      */
    public function tambah_lansia() 
    {
        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.tambah-lansia', compact('posyandu'));
    }

/**
     * Menyimpan data lansia ke database
    * 
    * @return redirect to admin.list_lansia
    */
    public function tambah_lansia_act(Request $req) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\IbuHamil,nik',
            'no_kk'=> 'required|digits:16|numeric',
            'tanggal_lahir'=> 'required|date',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'nik.unique'=> 'Nomor "NIK" sudah digunakan.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "Hari Perkiraan Lahir" tidak valid.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
        ]);

        DB::transaction(function () use ($req){
            $lansia = new Lansia();
            $lansia->nama = $req->nama;
            $lansia->nik = $req->nik;
            $lansia->no_kk = $req->no_kk;
            $lansia->tanggal_lahir = $req->tanggal_lahir;
            $lansia->jenis_kelamin = $req->jenis_kelamin;
            $lansia->id_posyandu = $req->posyandu;
            $lansia->save();
        });

        return redirect()->route('admin.list_lansia')->with('sukses', 'Berhasil menambahkan data lansia.');
    }
}

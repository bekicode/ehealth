<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Lansia;
use App\Models\PemeriksaanBalita;
use App\Models\PemeriksaanLansia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KaderController extends Controller
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
     * Menampilkan view dashboard kader
     * 
     * @return view
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $dataPemeriksaanBalita = DB::table('pemeriksaan_balita')
                ->select('id_pemeriksaan_balita', 'created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        $dataPemeriksaanLansia = DB::table('pemeriksaan_lansia')
                ->select('created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])
                ->get();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        $dataJumlahLansia = DB::table('lansia')
                ->select(DB::raw('count(id_lansia) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        // dd($dataJumlahBalita);
        return view('kader.dashboard', compact(
            'dataPemeriksaanBalita', 
            'dataPemeriksaanLansia',
            'dataJumlahBalita', 
            'dataJumlahLansia'
        ));
    }

    /**
     * Menampilkan daftar data pemeriksaan balita
     * 
     * @return void
     */
    public function list_pemeriksaan_balita() 
    {
        $user = Auth::user();

        $balita = DB::table('balita')
            ->select('id_balita', 'nama', 'nama_orangtua')
            ->where([
                ['id_posyandu', $user->id_posyandu]
            ])->get();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
                ['pemeriksaan_balita.id_posyandu', $user->id_posyandu],
            ])->orderByDesc('id_pemeriksaan_balita')
            ->get();
        
        $empty = count($data);

        return view('kader.balita.index', compact(['data', 'empty', 'balita']));
    }

    /**
     * Menampilkan view kader/balita/create dengan membawa daa balita
     * @param Request $req
     * 
     * @return view
     */
    public function periksa_balita(Request $req) 
    {
        $id_balita = $req->id_balita;
        $data = Balita::select('id_balita', 'nama', 'nik')
            ->findOrFail($id_balita);

        return view('kader.balita.create', compact('data'));
    }

    /**
     * Menyimpan data hasil pemeriksaan
     * 
     * @param Request $req
     * 
     * @return redirect
     */
    public function periksa_balita_act(Request $req)
    {
        $req->validate([
            'id_balita'=> 'required|exists:App\Models\Balita,id_balita',
            'berat_badan'=> 'required|numeric',
            'tinggi_badan'=> 'required|numeric',
            'lingkar_lengan_atas'=> 'required|numeric',
            'lingkar_kepala'=> 'required|numeric',

        ],
        [
            'berat_badan.required'=> 'Kolom "berat badan" wajib diisi.',
            'berat_badan.numeric'=> 'Kolom "berat badan" tidak bisa diisikan selain angka.',
            'tinggi_badan.required'=> 'Kolom "tinggi badan" wajib diisi.',
            'tinggi_badan.numeric'=> 'Kolom "tinggi badan" tidak bisa diisikan selain angka.',
            'lingkar_lengan_atas.required'=> 'Kolom "Lingkar lengan atas" wajib diisi.',
            'lingkar_lengan_atas.numeric'=> 'Kolom "Lingkar lengan atas" tidak bisa diisikan selain angka.',
            'lingkar_kepala.required'=> 'Kolom "Lingkar kepala" wajib diisi.',
            'lingkar_kepala.numeric'=> 'Kolom "Lingkar kepala" tidak bisa diisikan selain angka.',
        ]);

        $user = Auth::user();

        DB::transaction(function () use ($req, $user){
            $balita = new PemeriksaanBalita();
            $balita->id_balita = $req->id_balita;
            $balita->berat_badan = $req->berat_badan;
            $balita->tinggi_badan = $req->tinggi_badan;
            $balita->lingkar_lengan_atas = $req->lingkar_lengan_atas;
            $balita->lingkar_kepala = $req->lingkar_kepala;
            $balita->id_posyandu = $user->id_posyandu;
            $balita->id_user_petugas = $user->id;
            $balita->save();
        });

        return redirect()->route('kader.list_pemeriksaan_balita')->with('sukses', 'Berhasil menambahkan data pemeriksaan balita.');
    }

    /**
     * Menampilkan view update data pemeriksaan 
     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return view
     */
    public function update_pemeriksaan_balita($id)
    {
        $data = PemeriksaanBalita::findOrFail($id);

        $balita = Balita::select('id_balita', 'nama', 'nik')
            ->findOrFail($data->id_balita);


        return view('kader.balita.update', compact('data', 'balita'));
    }

    /**
     * Mengubah data pemeriksaan balita
     * 
     * @param Request $req
     * @param id_pemeriksaan_balita $id
     * 
     * @return redirect]
     */
    public function update_pemeriksaan_balita_act(Request $req, $id)
    {
        $req->validate([
            'berat_badan'=> 'required|numeric',
            'tinggi_badan'=> 'required|numeric',
            'lingkar_lengan_atas'=> 'required|numeric',
            'lingkar_kepala'=> 'required|numeric',

        ],
        [
            'berat_badan.required'=> 'Kolom "berat badan" wajib diisi.',
            'berat_badan.numeric'=> 'Kolom "berat badan" tidak bisa diisikan selain angka.',
            'tinggi_badan.required'=> 'Kolom "tinggi badan" wajib diisi.',
            'tinggi_badan.numeric'=> 'Kolom "tinggi badan" tidak bisa diisikan selain angka.',
            'lingkar_lengan_atas.required'=> 'Kolom "Lingkar lengan atas" wajib diisi.',
            'lingkar_lengan_atas.numeric'=> 'Kolom "Lingkar lengan atas" tidak bisa diisikan selain angka.',
            'lingkar_kepala.required'=> 'Kolom "Lingkar kepala" wajib diisi.',
            'lingkar_kepala.numeric'=> 'Kolom "Lingkar kepala" tidak bisa diisikan selain angka.',
        ]);

        DB::transaction(function () use ($req, $id){
            $balita = PemeriksaanBalita::findOrFail($id);
            $balita->berat_badan = $req->berat_badan;
            $balita->tinggi_badan = $req->tinggi_badan;
            $balita->lingkar_lengan_atas = $req->lingkar_lengan_atas;
            $balita->lingkar_kepala = $req->lingkar_kepala;
            $balita->id_user_petugas = Auth::user()->id;
            $balita->update();
        });

        return redirect()->route('kader.list_pemeriksaan_balita')->with('sukses', 'Berhasil mengubah data pemeriksaan balita.');
    }

    /**
     * menghapus data pemeriksaan balita     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return redirect
     */
    public function delete_pemeriksaan_balita($id) 
    {
        DB::transaction(function () use ($id){
            $balita = PemeriksaanBalita::findOrFail($id);
            $balita->is_deleted = 1;
            $balita->update();
        });

        return redirect()->route('kader.list_pemeriksaan_balita')->with('sukses', 'Berhasil menghapus data pemeriksaan balita.');
    }

    /**
     * Menampilkan daftar data pemeriksaan lansia
     * 
     * @return view
     */
    public function list_pemeriksaan_lansia() 
    {
        $user = Auth::user();

        $lansia = DB::table('lansia')
            ->select('id_lansia', 'nama', 'nik')
            ->where([
                ['id_posyandu', $user->id_posyandu]
            ])->get();

        $data = DB::table('pemeriksaan_lansia')
            ->join('lansia','pemeriksaan_lansia.id_lansia','lansia.id_lansia')
            ->select('pemeriksaan_lansia.*', 'lansia.nik', 'lansia.nama')
            ->where([
                ['pemeriksaan_lansia.is_deleted', 0],
                ['lansia.is_deleted', 0],
                ['pemeriksaan_lansia.id_posyandu', $user->id_posyandu],
            ])->orderByDesc('id_pemeriksaan_lansia')
            ->get();
        
        $empty = count($data);

        return view('kader.lansia.index', compact(['data', 'empty', 'lansia']));
    }

    /**
     * Menampilkan view create pemeriksaan lansia
     * 
     * @param Request $req
     * 
     * @return view
     */
    public function periksa_lansia(Request $req)
    {
        $id_lansia = $req->id_lansia;
        $data = Lansia::select('id_lansia', 'nama', 'nik')
            ->findOrFail($id_lansia);

        return view('kader.lansia.create', compact('data'));
    }

    /**
     * Menyimpan data pemeriksaan lansia
     * 
     * @param Request $req
     * 
     * @return redirect
     */
    public function periksa_lansia_act(Request $req)
    {
        $req->validate([
            'id_lansia'=> 'required||exists:App\Models\Lansia,id_lansia',
            'berat_badan'=> 'numeric',
            'tinggi_badan'=> 'numeric',
            'lingkar_kepala'=> 'numeric',

        ],
        [
            'berat_badan.numeric'=> 'Kolom "berat badan" tidak bisa diisikan selain angka.',
            'tinggi_badan.numeric'=> 'Kolom "tinggi badan" tidak bisa diisikan selain angka.',
            'lingkar_kepala.numeric'=> 'Kolom "Lingkar kepala" tidak bisa diisikan selain angka.',
        ]);

        $user = Auth::user();
        
        DB::transaction(function () use ($req, $user){
            $lansia = new PemeriksaanLansia();
            $lansia->id_lansia = $req->id_lansia;
            $lansia->id_posyandu = $user->id_posyandu;
            $lansia->id_user_petugas = $user->id;
            $lansia->berat_badan = $req->berat_badan;
            $lansia->tinggi_badan = $req->tinggi_badan;
            $lansia->lingkar_perut = $req->lingkar_perut;
            $lansia->gula_darah = $req->gula_darah;
            $lansia->imt = $req->imt;
            $lansia->tensi = $req->tensi;
            $lansia->lingkar_perut = $req->lingkar_perut;
            $lansia->kolesterol = $req->kolesterol;
            $lansia->asam_urat = $req->asam_urat;
            $lansia->save();
        });

        return redirect()->route('kader.list_pemeriksaan_lansia')->with('sukses', 'Berhasil menyimpan data pemeriksaan lansia.');
    }

    /**
     * Menampilkan view update data pemeriksaan balita
     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return view
     */
    public function update_pemeriksaan_lansia($id)
    {
        $data = PemeriksaanLansia::findOrFail($id);

        $lansia = Lansia::select('id_lansia', 'nama', 'nik')
            ->findOrFail($data->id_lansia);


        return view('kader.lansia.update', compact('data', 'lansia'));
    }

    /**
     * Mengubah data pemeriksaan lansia
     * 
     * @param Request $req
     * @param id_pemeriksaan_lansia $id
     * 
     * @return [type]
     */
    public function update_pemeriksaan_lansia_act(Request $req, $id)
    {
        $req->validate([
            'id_lansia'=> 'required||exists:App\Models\Lansia,id_lansia',
            'berat_badan'=> 'numeric',
            'tinggi_badan'=> 'numeric',
            'lingkar_kepala'=> 'numeric',

        ],
        [
            'berat_badan.numeric'=> 'Kolom "berat badan" tidak bisa diisikan selain angka.',
            'tinggi_badan.numeric'=> 'Kolom "tinggi badan" tidak bisa diisikan selain angka.',
            'lingkar_kepala.numeric'=> 'Kolom "Lingkar kepala" tidak bisa diisikan selain angka.',
        ]);
        
        DB::transaction(function () use ($req, $id){
            $lansia = PemeriksaanLansia::findOrFail($id);
            $lansia->id_user_petugas = Auth::user()->id;
            $lansia->berat_badan = $req->berat_badan;
            $lansia->tinggi_badan = $req->tinggi_badan;
            $lansia->lingkar_perut = $req->lingkar_perut;
            $lansia->gula_darah = $req->gula_darah;
            $lansia->imt = $req->imt;
            $lansia->tensi = $req->tensi;
            $lansia->lingkar_perut = $req->lingkar_perut;
            $lansia->kolesterol = $req->kolesterol;
            $lansia->asam_urat = $req->asam_urat;
            $lansia->update();
        });

        return redirect()->route('kader.list_pemeriksaan_lansia')->with('sukses', 'Berhasil mengubah data pemeriksaan lansia.');
    }

    /**
     * menghapus data pemeriksaan lansia
     * 
     * @param id_pemeriksaan_lansia $id
     * @return redirect
     */
    public function delete_pemeriksaan_lansia($id) 
    {
        DB::transaction(function () use ($id){
            $lansia = PemeriksaanLansia::findOrFail($id);
            $lansia->is_deleted = 1;
            $lansia->update();
        });

        return redirect()->route('kader.list_pemeriksaan_lansia')->with('sukses', 'Berhasil menghapus data pemeriksaan lansia.');
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
            ->where([
                ['is_deleted', 0],
                ['id_posyandu', Auth::user()->id_posyandu],
            ])->get();
        
        $empty = count($data);

        return view('kader.list-balita', compact(['data', 'empty']));
    }


    /**
      * Menampilkan view kader/tambah-balita
      * 
      * @return view kader/tambah-balita
      */
    public function tambah_balita() 
    {
        return view('kader.tambah-balita');
    }

    /**
      * Menyimpan data balita ke database
      * 
      * @return redirect to kader.list_balita
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
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'nik_orangtua.required'=> 'Kolom "NIK orang tua" wajib diisi.',
            'nik_orangtua.digits'=> 'Jumlah digit "NIK orang tua" tidak valid.',
            'nik_orangtua.numeric'=> 'Kolom "NIK orang tua" tidak bisa diisikan selain angka.',
            'nama_orangtua.required'=> 'Kolom "nama orang tua" wajib diisi.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
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
            $balita->id_posyandu = Auth::user()->id_posyandu;
            $balita->save();
        });

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil menambahkan data balita.');
    }

    /**
      * Menampilkan view kader/update-balita
      * 
      * @param id_balita $id
      * @return view kader/update-balita
      */
    public function update_balita($id) 
    {
        $data = Balita::where([
            ['is_deleted', 0],
            ['id_posyandu', Auth::user()->id_posyandu],
        ])->findOrFail($id);

        return view('kader.update-balita', compact('data'));
    }

    /**
      * Mengubah data balita
      * 
      * @param id_balita $id
      * @return redirect to kader.list_balita
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
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
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
            $balita->id_posyandu = Auth::user()->id_posyandu;
            $balita->update();
        });

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil mengubah data balita.');
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

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil menghapus data balita.');
    }

    /**
     * Menampilkan daftar data lansia
     * 
     * @return view kader.list-lansia
     */
    public function list_lansia() 
    {
        $data = DB::table('lansia')
            ->select('id_lansia', 'nik', 'nama', 'no_kk', 'tanggal_lahir', 'jenis_kelamin')
            ->where([
                ['is_deleted', 0],
                ['id_posyandu', Auth::user()->id_posyandu],
            ])->get();
        
        $empty = count($data);

        return view('kader.list-lansia', compact(['data', 'empty']));
    }

    /**
      * Menampilkan view kader/tambah-lansia
      * 
      * @param id_posyandu $id
      * @return view kader/tambah-lansia
      */
    public function tambah_lansia() 
    {
        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('kader.tambah-lansia', compact('posyandu'));
    }

    /**
     * Menyimpan data lansia ke database
     * 
     * @return redirect to kader.list_lansia
     */
    public function tambah_lansia_act(Request $req) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\Lansia,nik',
            'no_kk'=> 'required|digits:16|numeric',
            'tanggal_lahir'=> 'required|date',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],

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
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "Hari Perkiraan Lahir" tidak valid.',
        ]);

        DB::transaction(function () use ($req){
            $lansia = new Lansia();
            $lansia->nama = $req->nama;
            $lansia->nik = $req->nik;
            $lansia->no_kk = $req->no_kk;
            $lansia->tanggal_lahir = $req->tanggal_lahir;
            $lansia->jenis_kelamin = $req->jenis_kelamin;
            $lansia->id_posyandu = Auth::user()->id_posyandu;
            $lansia->save();
        });

        return redirect()->route('kader.list_lansia')->with('sukses', 'Berhasil menambahkan data lansia.');
    }

    /**
      * Menampilkan view kader/update-lansia
      * 
      * @param id_lansia $id
      * @return view kader/update-lansia
      */
    public function update_lansia($id) 
    {
        $data = Lansia::where([
            ['is_deleted', 0],
            ['id_posyandu', Auth::user()->id_posyandu],
        ])->findOrFail($id);

        return view('kader.update-lansia', compact('data'));
    }

    /**
     * Mengubah data lansia ke database
     * 
     * @param id_lansia $id
     * @return redirect to kader.list_lansia
     */
    public function update_lansia_act(Request $req, $id) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'tanggal_lahir'=> 'required|date',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "Hari Perkiraan Lahir" tidak valid.',
        ]);

        DB::transaction(function () use ($req, $id){
            $lansia = Lansia::findOrFail($id);
            $lansia->nama = $req->nama;
            $lansia->nik = $req->nik;
            $lansia->no_kk = $req->no_kk;
            $lansia->tanggal_lahir = $req->tanggal_lahir;
            $lansia->jenis_kelamin = $req->jenis_kelamin;
            $lansia->id_posyandu = Auth::user()->id_posyandu;
            $lansia->update();
        });

        return redirect()->route('kader.list_lansia')->with('sukses', 'Berhasil mengubah data lansia.');
    }

    /**
      * Menghapus data lansia
      * 
      * @param id_lansia $id
      * @return redirect()
      */
    public function delete_lansia($id) 
    {
        DB::transaction(function () use ($id){
            $lansia = Lansia::findOrFail($id);
            $lansia->is_deleted = 1;
            $lansia->update();
        });

        return redirect()->route('kader.list_lansia')->with('sukses', 'Berhasil menghapus data lansia.');
    }

    
    /**
     * Menampilkan daftar data akun
     * 
     * @return view kader.list-akun
     */
    public function list_akun() 
    {
        $data = DB::table('users')
            ->select('id', 'name', 'no_telp', 'nik', 'role', 'alamat')
            ->where([
                ['is_delete', 0],
                ['id_posyandu', Auth::user()->id_posyandu],
            ])->get();
        
        $empty = count($data);

        return view('kader.list-akun', compact(['data', 'empty']));
    }

    /**
     * Menampilkan view tambah akun
     * 
     * @return view
     */
    public function tambah_akun() {
        return view('kader.tambah-akun');
    }

    /**
     * Menyimpan data oengguna
     * 
     * @param Request $req
     * 
     * @return Redirect
     */
    public function tambah_akun_act(Request $req)
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\User,nik',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_kk'=> 'required|digits:16|numeric',
            'no_telp'=> 'numeric',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'role'=> ['required', Rule::in(['1', '2'])],

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
            'no_telp.numeric'=> 'Jumlah digit "No telepon" tidak valid.',
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password.min'=> 'Kolom "Password" harus minimal 8 karakter.',
            'password.confirmed'=> 'Kolom "Password" dan kolom "Konfirmasi Password" tidak sama.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
        ]);

        DB::transaction(function () use ($req){
            $user = new User();
            $user->name = $req->nama;
            // $user->email = 'admin' . rand(1,999) . '@email.test';
            $user->nik = $req->nik;
            $user->no_kk = $req->no_kk;
            $user->password = Hash::make($req->password);
            $user->no_telp = $req->no_telepon;
            $user->alamat = $req->alamat;
            $user->jenis_kelamin = $req->jenis_kelamin;
            $user->role = $req->role;
            $user->id_posyandu = Auth::user()->id_posyandu;
            $user->save();
        });

        return redirect()->route('kader.list_akun')->with('sukses', 'Berhasil menambahkan data akun '. $req->nama . '.');
    }

    
    /**
     * Menampilkan view update data akun
     * 
     * @param user_id $id
     * 
     * @return view
     */
    public function update_akun($id)
    {
        $data = User::where([
                    ['is_delete', 0],
                    ['id', $id],
                    ['id_posyandu', Auth::user()->id_posyandu],
                ])->firstOrFail();

        return view('kader.update-akun', compact('data'));
    }

    /**
     * mengubah data akun
     * 
     * @param Request $req
     * @param user_id $id
     * 
     * @return [type]
     */
    public function update_akun_act(Request $req, $id)
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'no_telp'=> 'numeric',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'role'=> ['required', Rule::in(['1', '2'])],

        ],
        [
            'nama.required'=> 'Kolom "Nama" wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'no_telp.numeric'=> 'Jumlah digit "No telepon" tidak valid.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
            'role.in'=> $req->role . ' tidak valid.',
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password.confirmed'=> 'Kolom "Password" dan kolom "Konfirmasi Password" tidak sama.',
        ]);

        DB::transaction(function () use ($req, $id){
            $user = User::findOrFail($id);
            $user->name = $req->nama;
            $user->nik = $req->nik;
            $user->no_kk = $req->no_kk;
            $user->no_telp = $req->no_telepon;
            $user->alamat = $req->alamat;
            $user->jenis_kelamin = $req->jenis_kelamin;
            $user->role = $req->role;
            $user->id_posyandu = Auth::user()->id_posyandu;
            $user->update();
        });

        return redirect()->route('kader.list_akun')->with('sukses', 'Berhasil mengubah data akun '. $req->nama . '.');
    }

    /**
     * Mengubah password akun pengguna
     * 
     * @param Request $req
     * @param user_id $id
     * 
     * @return redirect
     */
    public function update_password_act(Request $req, $id)
    {
        $req->validate([
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password.confirmed'=> 'Kolom "Password" dan kolom "Konfirmasi Password" tidak sama.',
            'password.min'=> 'Kolom "Password" harus minimal 8 karakter.',
        ]);

        DB::transaction(function () use ($req, $id){
            $user = User::findOrFail($id);
            $user->password = Hash::make($req->password);
            $user->save();
        });

        return redirect()->route('kader.list_akun')->with('sukses', 'Berhasil mengubah password akun.');
    }

}

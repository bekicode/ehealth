<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Lansia;
use App\Models\PemeriksaanBalita;
use App\Models\PemeriksaanLansia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function list_balita() 
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

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil menambahkan data pemeriksaan balita.');
    }

    /**
     * Menampilkan view update data pemeriksaan 
     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return view
     */
    public function update_balita($id)
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
    public function update_balita_act(Request $req, $id)
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

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil mengubah data pemeriksaan balita.');
    }

    /**
     * menghapus data pemeriksaan balita     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return redirect
     */
    public function delete_balita($id) 
    {
        DB::transaction(function () use ($id){
            $balita = PemeriksaanBalita::findOrFail($id);
            $balita->is_deleted = 1;
            $balita->update();
        });

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil menghapus data pemeriksaan balita.');
    }

    /**
     * Menampilkan daftar data pemeriksaan lansia
     * 
     * @return view
     */
    public function list_lansia() 
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

        return redirect()->route('kader.list_lansia')->with('sukses', 'Berhasil menyimpan data pemeriksaan lansia.');
    }

    /**
     * Menampilkan view update data pemeriksaan balita
     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return view
     */
    public function update_lansia($id)
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
    public function update_lansia_act(Request $req, $id)
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

        return redirect()->route('kader.list_lansia')->with('sukses', 'Berhasil mengubah data pemeriksaan lansia.');
    }

    /**
     * menghapus data pemeriksaan lansia
     * 
     * @param id_pemeriksaan_lansia $id
     * @return redirect
     */
    public function delete_lansia($id) 
    {
        DB::transaction(function () use ($id){
            $lansia = PemeriksaanLansia::findOrFail($id);
            $lansia->is_deleted = 1;
            $lansia->update();
        });

        return redirect()->route('kader.list_lansia')->with('sukses', 'Berhasil menghapus data pemeriksaan lansia.');
    }
}

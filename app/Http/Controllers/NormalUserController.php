<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NormalUserController extends Controller
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
     * Menampilkan view dashboard user
     * 
     * @return view
     */
    public function dashboard()
    {
        $user = Auth::user();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 1],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['no_kk', $user->no_kk],
                ])->get();

        $dataJumlahLansia = DB::table('lansia')
                ->select(DB::raw('count(id_lansia) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['no_kk', $user->no_kk],
                ])->get();

        return view('normal_user.dashboard', compact(
            'dataJumlahBalita', 
            'dataJumlahLansia',
        ));
    }

    /**
     * menampilkan balita di keluarga berdasarkan no kk
     * 
     * @return view
     */
    public function list_balita() 
    {
        $user = Auth::user();

        $data = DB::table('balita')
            ->select('id_balita', 'nik', 'no_kk', 'nama', 'berat_badan_lahir', 'tinggi_badan_lahir', 'jenis_kelamin', 'is_deleted')
            ->where([
                ['is_deleted', 0],
                ['no_kk', $user->no_kk],
            ])->orderByDesc('id_balita')
            ->get();
        // dd($data);
        $empty = count($data);

        return view('normal_user.balita.index', compact(['data', 'empty']));
    }

    /**
     * menampilkan riwayat pemeriksaan balita berdasarkan no kk
     * 
     * @return view
     */
    public function riwayat_balita() 
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
                ['balita.no_kk', $user->no_kk],
            ])->orderByDesc('id_pemeriksaan_balita')
            ->get();
        // dd($data);
        $empty = count($data);

        return view('normal_user.balita.riwayat_pemeriksaan', compact(['data', 'empty']));
    }

    /**
     * menampilkan lansia di keluarga berdasarkan no kk
     * 
     * @return view
     */
    public function list_lansia() 
    {
        $user = Auth::user();

        $data = DB::table('lansia')
            ->select('id_lansia', 'nik', 'no_kk', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'is_deleted', DB::raw('timestampdiff(year, tanggal_lahir, curdate()) as umur'))
            ->where([
                ['is_deleted', 0],
                ['no_kk', $user->no_kk],
            ])->orderByDesc('id_lansia')
            ->get();
        // dd($data);
        $empty = count($data);

        return view('normal_user.lansia.index', compact(['data', 'empty']));
    }

    /**
     * menampilkan riwayat pemeriksaan lansia berdasarkan no kk
     * 
     * @return view
     */
    public function riwayat_lansia() 
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_lansia')
            ->join('lansia','pemeriksaan_lansia.id_lansia','lansia.id_lansia')
            ->select('pemeriksaan_lansia.*', 'lansia.nik', 'lansia.nama')
            ->where([
                ['pemeriksaan_lansia.is_deleted', 0],
                ['lansia.is_deleted', 0],
                ['lansia.no_kk', $user->no_kk],
            ])->orderByDesc('id_pemeriksaan_lansia')
            ->get();
        
        $empty = count($data);

        return view('normal_user.lansia.riwayat_pemeriksaan', compact(['data', 'empty']));
    }
}

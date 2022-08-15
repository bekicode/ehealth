<?php

namespace App\Http\Controllers;

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
     * Menampilkan daftar data pemeriksaan balita
     * 
     * @return void
     */
    public function list_balita() 
    {
        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
                ['pemeriksaan_balita.id_posyandu', Auth::user()->id_posyandu],
            ])
            ->get();
        
        $empty = count($data);

        return view('kader.list-balita', compact(['data', 'empty']));
    }
}

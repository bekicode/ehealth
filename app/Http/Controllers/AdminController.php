<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule as ValidationRule;

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
            'jenis_posyandu'=> [ValidationRule::in(['balita', 'lansia']), 'required'],
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
}

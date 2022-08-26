<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
                    ['is_deleted', 0],
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
     * @var id_balita $id
     * 
     * @return view
     */
    public function riwayat_balita($id) 
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['pemeriksaan_balita.id_balita', $id],
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
     * @var id_lansia $id
     * 
     * @return view
     */
    public function riwayat_lansia($id) 
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_lansia')
            ->join('lansia','pemeriksaan_lansia.id_lansia','lansia.id_lansia')
            ->select('pemeriksaan_lansia.*', 'lansia.nik', 'lansia.nama')
            ->where([
                ['pemeriksaan_lansia.is_deleted', 0],
                ['pemeriksaan_lansia.id_lansia', $id],
                ['lansia.is_deleted', 0],
                ['lansia.no_kk', $user->no_kk],
            ])->orderByDesc('id_pemeriksaan_lansia')
            ->get();
        
        $empty = count($data);

        return view('normal_user.lansia.riwayat_pemeriksaan', compact(['data', 'empty']));
    }

      
    /**
     * Menampilkan view update data akun
     * 
     * @return view
     */
    public function update_akun()
    {
        $data = User::where([
                    ['is_delete', 0],
                    ['id', Auth::user()->id],
                ])->firstOrFail();

        return view('normal_user.update-akun', compact('data'))->with('sukses', 'Berhasil menambahkan data akun.');
    }

    /**
     * mengubah data akun
     * 
     * @param Request $req
     * @param user_id $id
     * 
     * @return [type]
     */
    public function update_akun_act(Request $req)
    {
        $req->validate([
            'nama'=> 'required',
            // 'nik'=> 'required|digits:16|numeric',
            // 'no_kk'=> 'required|digits:16|numeric',
            'no_telp'=> 'numeric',
            'jenis_kelamin'=> [Rule::in(['Laki-laki', 'Perempuan'])],

        ],
        [
            'nama.required'=> 'Kolom "Nama" wajib diisi.',
            // 'nik.required'=> 'Kolom "NIK" wajib diisi.',
            // 'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            // 'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            // 'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            // 'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            // 'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'no_telp.numeric'=> 'Jumlah digit "No telepon" tidak valid.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
        ]);

        DB::transaction(function () use ($req){
            $user = User::findOrFail(Auth::user()->id);
            $user->name = $req->nama;
            $user->no_telp = $req->no_telepon;
            $user->alamat = $req->alamat;
            $user->jenis_kelamin = $req->jenis_kelamin;
            $user->update();
        });

        return redirect()->route('user.update_akun')->with('sukses', 'Berhasil mengubah data akun '. $req->nama . '.');
    }

    /**
     * Mengubah password akun pengguna
     * 
     * @param Request $req
     * 
     * @return redirect
     */
    public function update_password_act(Request $req)
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

        DB::transaction(function () use ($req){
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($req->password);
            $user->update();
        });

        return redirect()->route('user.update_akun')->with('sukses', 'Berhasil mengganti password baru.');
    }
}

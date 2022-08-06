<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}

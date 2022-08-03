<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KadesController extends Controller
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
     * @return view dashboard
     */
    public function dashboard() {
        return view('kades.dashboard');
    }
}

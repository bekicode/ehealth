<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    //

    /**
     * Landing Page
     * 
     * @return view
     */
    public function index()
    {
        $artikel = DB::Table('artikel')
                ->where('is_deleted',false)
                ->orderby('updated_at','desc')
                ->limit('3')
                ->get();
        
        return view('welcome',compact('artikel'));
    }

    /**
     * Daftar artikel
     * 
     * @return view
     */
    public function article()
    {
        $artikel = DB::Table('artikel')
                ->where('is_deleted',false)
                ->orderby('updated_at','desc')
                // ->limit('3')
                ->paginate(12);

        return view('article',compact('artikel'));
    }

    /**
     * @param mixed $slug
     * 
     * @return view|abort
     */
    public function article_detail($slug)
    {
        $artikel = DB::Table('artikel')
                ->join('users','artikel.id_user','users.id')
                ->select('artikel.*','users.name as username')
                ->where('slug', $slug)
                ->where('is_deleted',false)
                ->first();

        if($artikel)
        {
            $allarticle = DB::Table('artikel')
                ->where('slug','!=',$slug)
                ->where('is_deleted',false)
                ->orderby('updated_at','desc')
                ->limit('8')
                ->get();

            return view('article-detail',compact('artikel','allarticle'));
        }
        return abort(404);
    }
    
}

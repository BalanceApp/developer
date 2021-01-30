<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserCtrl extends Controller
{

    public function csvOut(Request $req){
        if( $req->session()->get('role')!='staff'){
            return redirect('/');
        }
        $playerlist = DB::select('select userid, name from players');
        return view('CSVpage', compact('playerlist'));
    }

}

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
        $userid = $req->session()->get('userid');
        $team = DB::select('SELECT team FROM staffs WHERE userid=?',[$userid])[0]->team;
        if($team != "omi"){
            $playerlist = DB::select('SELECT userid, name, team FROM players WHERE team=?',[$team]);
        }
        else{
            $playerlist = DB::select('SELECT userid, name, team FROM players');
        }
        return view('CSVpage', compact('playerlist'));
    }

}

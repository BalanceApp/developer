<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PlayerController extends Controller
{
    public function index(Request $req, Type $var = null){
        if( $req->session()->get('role')!='staff'){
            return redirect('/');
        }
        $playerlist = DB::select('select userid, name from players');
        return view('playerlist', compact('playerlist'));
    }

    public function login(Request $req){
        $userdata = $req->all();
        $data = DB::select('select * from players where userid = ? and password = md5(?)', [$userdata['userid'], $userdata['password']]);
        if(count($data)>0){
            $req->session()->put('userid', $userdata['userid']);
            $req->session()->put('userpwd', $userdata['password']);	
            $req->session()->put('role', "player");
            return view('sub_item_page');
        }
        else{
            $data_erro = "パスワードが正しくありません";
            return view('login_player',compact('data_erro'));
        }
    }

    public function store(Request $req){
        $userdata = $req->all();
        $data = DB::select('select * from players where userid = ?', [$userdata['userid']]);

        if (count($data) > 0) {
            $data_erro = "すでにそのような識別子のユーザーが存在します";
    		return view('login_player', compact('data_erro'));
        }
        else{
            $now = date("y-m-d");
            DB::insert('INSERT INTO allergies(userid,shrimp, crab, wheat, soba, milk, egg,squid, orange, beef, salmon, mackerel, soybeans, chicken,banana,peache) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$userdata['userid'], isset($userdata['shrimp']), isset($userdata['crab']), isset($userdata['wheat']), isset($userdata['soba']), isset($userdata['milk']), isset($userdata['egg']), isset($userdata['squid']), isset($userdata['orange']), isset($userdata['beef']), isset($userdata['salmon']), isset($userdata['mackerel']), isset($userdata['soybeans']), isset($userdata['chicken']), isset($userdata['banana']), isset($userdata['peache'])]);
            DB::insert('INSERT INTO players(userid, password, name, birthday, sex, sport, registered_date) VALUES(?,md5(?),?,?,?,?,?)', [$userdata['userid'],$userdata['password'], $userdata['name'],$userdata['birthday'], $userdata['sex']=="male" ? 1:0, $userdata['sport'],$now]);
            
            $req->session()->put('userid', $userdata['userid']);
            $req->session()->put('userpwd', $userdata['password']);
            $req->session()->put('role', "player");
            return view('sub_item_page');
            
    	}
    }
}

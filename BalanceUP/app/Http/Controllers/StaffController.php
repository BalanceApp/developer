<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StaffController extends Controller
{
    public function login(Request $req){
        $userdata = $req->all();
        $data = DB::select('select * from staffs where userid = ? and password = md5(?)', [$userdata['userid'], $userdata['password']]);
        if(count($data)>0){
            $req->session()->put('userid', $userdata['userid']);
            $req->session()->put('userpwd', $userdata['password']);	
            $req->session()->put('role', "staff");
            return view('staff_page');
        }

        else{
            $data_erro = "パスワードが正しくありません";
            return view('login_staff',compact('data_erro'));
        }
    }

    public function store(Request $req){
        $userdata = $req->all();
        $data = DB::select('select * from staffs where userid = ?', [$userdata['userid']]);

        if (count($data) > 0) {
            $data_erro = "すでにそのような識別子のユーザーが存在します";
    		return view('register_staff', compact('data_erro'));
        }
        else{
            $now = date("y-m-d");
            DB::insert('INSERT INTO staffs(userid, password, name, birthday, sex, registered_date) VALUES(?,md5(?),?,?,?,?)', [$userdata['userid'],$userdata['password'], $userdata['name'],$userdata['birthday'], $userdata['sex']=="male" ? 1:0, $now]);
            
            $req->session()->put('userid', $userdata['userid']);
            $req->session()->put('userpwd', $userdata['password']);
            $req->session()->put('role', "staff");
            return view('staff_page');
            
    	}
    }
}

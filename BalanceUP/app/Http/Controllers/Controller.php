<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createTable(){
        DB::statement('CREATE TABLE IF NOT EXISTS player(id INT primary key NOT NULL AUTO_INCREMENT, userid varchar(255), password varchar(255), name varchar(255), birthday date, sex int, sport varchar(255), registedDate date)');

        DB::statement('CREATE TABLE IF NOT EXISTS staff(id INT primary key NOT NULL AUTO_INCREMENT, userid varchar(255), password varchar(255), name varchar(255), birthday date, sex int, registedDate date)');

        DB::statement('CREATE TABLE IF NOT EXISTS allergy(id int primary key not null auto_increment, userid varchar(255), shrimp int, crab int, wheat int, soba int, milk int, egg int, squid int, orange int, beef int, salmon int, mackerel int, soybeans int, chicken int, banana int, peache int)');

        DB::statement('CREATE TABLE IF NOT EXISTS everyday(id int primary key NOT NULL AUTO_INCREMENT, userid varchar(255), height int, weight float, fat float, muscle float, regulardata int, frequency int, time varchar(12), date date)');

        DB::statement('CREATE TABLE IF NOT EXISTS diet(id int primary key NOT NULL AUTO_INCREMENT, userid varchar(255), stapleFood float, mainDish float, sideDish float, meat float, seafood float, eggs float, beans float, LCvegetables float, GYvegetables float, mushrooms float, seaweeds float, potatoes float, milk float, fruit float,
         sweets float, saltSweets float, juice float, friedFood float, fastFood float, misoSoup float, MenSoup float, supply float, energy float, calcium float, vitamin float, others float, unknown float, otherslist varchar(255), description varchar(255), regDate date)');

        DB::statement('CREATE TABLE IF NOT EXISTS changedDatas(id int primary key NOT NULL AUTO_INCREMENT, userid varchar(255), f1 float, f2 float, f3 float, f4 float, f5 float, f6 float, f7 float, f8 float, f9 float, f10 float, f11 float, f12 float, f13 float, f14 float, f15 float, f16 float, f17 float, f18 float, f19 float, f20 float, f21 float, f22 float, f23 float, f24 float, f25 float, f26 float, f27 float, f28 float, f29 float, f30 float, f31 float, f32 float, f33 float, energy float, calcium float, vitamin float, others float, unknown float, otherslist float, description varchar(255), regDate date)');

        DB::statement('CREATE TABLE IF NOT EXISTS nextmeal(id int primary key NOT NULL AUTO_INCREMENT, userid varchar(255), goodfood1 varchar(255), goodfood2 varchar(255), goodfood3 varchar(255), nextfood1 varchar(255), nextfood2 varchar(255), nextfood3 varchar(255), whe varchar(255), wher varchar(255), how varchar(255), regDate date)');
        return view('index');
    }
}

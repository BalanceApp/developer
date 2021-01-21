<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Condition extends Controller
{
    //

    public function regularInput(Request $req){
        $regularData = $req->all();

        DB::insert('INSERT INTO everyday(userid, height, weight, fat, muscle, regulardata, frequency, time, date) VALUES(?,?,?,?,?,1,?,?,?)', [$req->session()->get('userid'), $regularData['height'], $regularData['weight'], $regularData['fat'], $regularData['muscle'], $regularData['frequency'], $regularData['time'], date("y-m-d")]);
        return view('regularMeal');
    }

    public function everydayInput(Request $req){
        $everydayData = $req->all();
        DB::insert('INSERT INTO everyday(userid, height, weight, fat, muscle,regulardata, date) VALUES(?,?,?,?,?,0,?)', [$req->session()->get('userid'), $everydayData['height'], $everydayData['weight'], $everydayData['fat'], $everydayData['muscle'], date("y-m-d")]);
        return view('finishInputing1');
    }

    public function insertDiet(Request $req)
    {
        $dietData = $req->all();

        DB::delete('delete from diet where regDate = ? and userid = ?',[date("y-m-d"),$req->session()->get('userid')]);

        $result = DB::insert('INSERT INTO diet(userid, stapleFood, mainDish, sideDish,
        meat, seafood, eggs, beans, LCvegetables, GYvegetables, mushrooms, seaweeds,
        potatoes, milk, fruit, sweets, saltSweets, juice, friedFood, fastFood, misoSoup,
         MenSoup, supply,energy,calcium,vitamin,others,unknown, otherslist, description, regDate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$req->session()->get('userid'), $dietData['stapleFood'], $dietData['mainDish'],
        $dietData['sideDish'],$dietData['meat'], $dietData['seafood'], $dietData['eggs'],
         $dietData['beans'], $dietData['LCvegetables'], $dietData['GYvegetables'], $dietData['mushrooms'],
         $dietData['seaweeds'], $dietData['potatoes'], $dietData['milk'],$dietData['fruit'], $dietData['sweets'],
         $dietData['saltSweets'], $dietData['juice'], $dietData['friedFood'], $dietData['fastFood'],
         $dietData['misoSoup'], $dietData['MenSoup'], $dietData['supply'], $dietData['energy'],
         $dietData['calcium'],$dietData['vitamin'],$dietData['others'],$dietData['unknown'], $dietData['otherslist'],
         $dietData['description'], date("y-m-d")]);

        /* mainfood */
        // morning
        $dietData["f1"] = $dietData['f1']+1;
        // lunch
        $dietData["f2"] = $dietData['f2']+1;
        // dinner
        $dietData['f3'] = $dietData["f3"]+1;

        /* main chai */
        // morning
        $dietData["f4"] = $dietData['f4']+1;
        // lunch
        $dietData["f5"] = $dietData['f5']+1;
        // dinner
        $dietData['f6'] = $dietData["f6"]+1;

        /* meat */
        $dietData["f7"] = $dietData['f7']+1;
        /* fish */
        $dietData["f8"] = $dietData['f8']+1;
        /* egg */
        $dietData["f9"] = $dietData['f9']+1;
        /* bean */
        $dietData["f10"] = $dietData['f10']+1;

        /* side chai */
        // morning
        $dietData["f11"] = $dietData['f11']+1;
        // lunch
        $dietData["f12"] = $dietData['f12']+1;
        // dinner
        $dietData['f13'] = $dietData["f13"]+1;

        /* lc_vergetable */
        $dietData['f14'] = $dietData["f14"]+1;

        /* dc_vergetable */
        $dietData['f15'] = $dietData["f15"]+1;

        /* mushroom */
        $dietData['f16'] = $dietData["f16"]+1;

        /* seafood */
        $dietData['f17'] = $dietData["f17"]+1;

        /* potato */
        $dietData['f18'] = $dietData["f18"]+1;

        /* milk */
        // amount
        $dietData['f19'] = $dietData["f19"]+1;
        // frequency
        $dietData['f20'] = $dietData["f20"]+1;

        /* fruit */
        // amount
        $dietData['f21'] = $dietData["f21"]+1;
        // frequency
        $dietData['f22'] = $dietData["f22"]+1;

        /* sweet candy */
        // amount
        $dietData['f23'] = $dietData["f23"]+1;
        // frequency
        $dietData['f24'] = $dietData["f24"]+1;

        /* salty candy */
        // amount
        $dietData['f25'] = $dietData["f25"]+1;
        // frequency
        $dietData['f26'] = $dietData["f26"]+1;

        /* juice */
        // amount
        $dietData['f27'] = $dietData["f27"]+1;
        // frequency
        $dietData['f28'] = $dietData["f28"]+1;

        /* fried food */
        $dietData['f29'] = $dietData["f29"]+1;

        /* fast food */
        $dietData['f30'] = $dietData["f30"]+1;

        /* soup */
        $dietData['f31'] = $dietData["f31"]+1;

        /* m soup */
        $dietData['f32'] = $dietData["f32"]+1;

        /* suplement */
        $dietData['f33'] = $dietData["f33"]+1;

        /* energy */
        if ($dietData['energy'] == 0.5) {
            $dietData['energy'] = 1;
        }
        else {
            $dietData['energy'] = 0;
        }

        if ($dietData['calcium'] == 0.5) {
            $dietData['calcium'] = 1;
        }
        else {
            $dietData['calcium'] = 0;
        }

        if ($dietData['vitamin'] == 0.5) {
            $dietData['vitamin'] = 1;
        }
        else {
            $dietData['vitamin'] = 0;
        }

        if ($dietData['others'] == 0.5) {
            $dietData['others'] = 1;
        }
        else {
            $dietData['others'] = 0;
        }

        if ($dietData['unknown'] == 0.5) {
            $dietData['unknown'] = 1;
        }
        else {
            $dietData['unknown'] = 0;
        }

        if ($dietData['otherslist'] == 0.5) {
            $dietData['otherslist'] = 1;
        }
        else {
            $dietData['otherslist'] = 0;
        }

        DB::delete('delete from changedDatas where regDate = ? and userid = ?',[date("y-m-d"),$req->session()->get('userid')]);

        $result = DB::insert('INSERT INTO changedDatas(userid, f1, f2, f3, f4, f5, f6, f7, f8, f9, f10, f11, f12, f13, f14, f15, f16, f17, f18, f19, f20,
         f21, f22,f23,f24,f25,f26,f27, f28, f29, f30, f31, f32, f33, energy, calcium, vitamin, others, unknown, otherslist, description, regDate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?, ?,?,?,?,?,?,?,?,?,?)',
        [$req->session()->get('userid'), $dietData['f1'], $dietData['f2'],
        $dietData['f3'],$dietData['f4'], $dietData['f5'], $dietData['f6'],
         $dietData['f7'], $dietData['f8'], $dietData['f9'], $dietData['f10'],
         $dietData['f11'], $dietData['f12'], $dietData['f13'],$dietData['f14'], $dietData['f15'],
         $dietData['f16'], $dietData['f17'], $dietData['f18'], $dietData['f19'],
         $dietData['f20'], $dietData['f21'], $dietData['f22'], $dietData['f23'],
         $dietData['f24'],$dietData['f25'],$dietData['f26'],$dietData['f27'], $dietData['f28'],$dietData['f29'], $dietData['f30'], $dietData['f31'], $dietData['f32'],
         $dietData['f33'],$dietData['energy'],$dietData['calcium'],$dietData['vitamin'],$dietData['others'],$dietData['unknown'], $dietData['otherslist'],$dietData['description'], date("y-m-d")]);

        echo $result;
    }

    public function getDiet(Request $req)
    {
        $userid = $req->userid;
        $returndata=array();
        $returndata['data'] = DB::select('SELECT stapleFood, mainDish, sideDish,
        meat, seafood, eggs, beans, LCvegetables, GYvegetables, mushrooms, seaweeds,
        potatoes, milk, fruit, sweets, saltSweets, juice, friedFood, fastFood, misoSoup,
         MenSoup, supply FROM diet WHERE userid = ? AND
        regDate = (SELECT MAX(regDate) FROM diet WHERE userid = ?)',
        [$userid,$userid]);

        $returndata['five_two'] = DB::select('SELECT frequency, time, height, weight, fat, muscle, date FROM everyday WHERE userid = ? AND id = (SELECT MAX(id) FROM everyday WHERE userid =?)',[$userid,$userid]);
        $returndata['userName'] = DB::select('SELECT name, sport from player WHERE userid=?', [$userid]);

         $user_point = 0;
         $count = DB::select("select count(*) as count from player");

         $grade = 1;

         if(count($returndata['data'])==1)
         {
            foreach($returndata['data'][0] as $value)
            {
                $user_point += (int)$value;
            }
            $result = DB::select('SELECT userid from player where userid!=?',[$userid]);
            foreach($result as $users)
            {
                $othersdata = DB::select('SELECT stapleFood, mainDish, sideDish,
                meat, seafood, eggs, beans, LCvegetables, GYvegetables, mushrooms, seaweeds,
                potatoes, milk, fruit, sweets, saltSweets, juice, friedFood, fastFood, misoSoup,
                MenSoup, supply FROM diet WHERE  regDate = (SELECT MAX(regDate) FROM diet WHERE userid = ?)', [$users->userid]);
                $otherspoint = 0;
                if(count($othersdata)>0){
                    foreach($othersdata[0] as $value)
                    {
                        $otherspoint += $value;
                    }
                    if($user_point<$otherspoint)
                    {
                        $grade++;
                    }
                }

            }
           $returndata['grade'] = $grade;
        }

        else {
            $returndata['grade'] = $grade;
        }

        $returndata['count'] = $count[0]->count;
        echo json_encode($returndata);
    }

    function getGraphData(Request $req)
    {

        $startdate = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string("7 days")),"Y-m-d");
        $userid = $req->userid;
        $everydayData['hdata']=array();
        $everydayData['wdata']=array();
        $everydayData['fdata']=array();
        $everydayData['mdata']=array();
        $everydayData['hdata'] = DB::select("SELECT  DISTINCT DATE as x, height as y FROM everyday WHERE userid=? AND date>?", [$userid,$startdate]);
        $everydayData['wdata'] = DB::select("SELECT  DISTINCT DATE as x, weight as y FROM everyday WHERE userid=? AND date>?", [$userid,$startdate]);
        $everydayData['fdata'] = DB::select("SELECT  DISTINCT DATE as x, fat as y FROM everyday WHERE userid=? AND date>?", [$userid,$startdate]);
        $everydayData['mdata'] = DB::select("SELECT  DISTINCT DATE as x, muscle as y FROM everyday WHERE userid=? AND date>?", [$userid,$startdate]);

        $week = array();
        $week['hdata'] = array();
        $week['wdata'] = array();
        $week['fdata'] = array();
        $week['mdata'] = array();

        for($i=0;$i<4;$i++)
        {
            $endtime = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string(($i * 7)." days")),"Y-m-d");
            $startdate = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((($i + 1) * 7)." days")),"Y-m-d");
            $result = DB::select("SELECT DATE AS x, height AS y FROM everyday WHERE height = (SELECT MAX(height) FROM everyday WHERE userid=? AND DATE>? AND DATE<=?) AND DATE>? AND DATE<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['hdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, weight AS y FROM everyday WHERE weight = (SELECT MAX(weight) FROM everyday WHERE userid=? AND DATE>? AND DATE<=?) AND DATE>? AND DATE<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['wdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, fat AS y FROM everyday WHERE fat = (SELECT MAX(fat) FROM everyday WHERE userid=? AND DATE>? AND DATE<=?) AND DATE>? AND DATE<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['fdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, muscle AS y FROM everyday WHERE muscle = (SELECT MAX(muscle) FROM everyday WHERE userid=? AND DATE>? AND DATE<=?) AND DATE>? AND DATE<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['mdata'], $result[0]);
        }

        $yy = (int)date("Y");
        $mm = (int)date("m");

        $month = array();
        $month['hdata'] = array();
        $month['wdata'] = array();
        $month['fdata'] = array();
        $month['mdata'] = array();
        for($i=0;$i<4;$i++)
        {
            $monthstring = $yy."-".$mm."-%";
            $result = DB::select("SELECT DATE AS x, height AS y FROM everyday WHERE height = (SELECT MAX(height) FROM everyday WHERE userid=? and date like ?) and  date like ? limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['hdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, weight AS y FROM everyday WHERE weight = (SELECT MAX(weight) FROM everyday WHERE userid=? and date like ?) and date like ? limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['wdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, fat AS y FROM everyday WHERE fat = (SELECT MAX(fat) FROM everyday WHERE userid=? and date like ?) and date like ?  limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['fdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, muscle AS y FROM everyday WHERE muscle = (SELECT MAX(muscle) FROM everyday WHERE userid=? and date like ?)and date like ?  limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['mdata'], $result[0]);
            $mm -=1;
            if($mm<=0)
            {
                $mm+=12;
                $yy--;
            }
        }
        $year = array();
        $year['hdata'] = array();
        $year['wdata'] = array();
        $year['fdata'] = array();
        $year['mdata'] = array();
        for($i=0;$i<4;$i++)
        {
            $yy = (int)date("Y") - 3 + $i;
            $result = DB::select("SELECT DATE AS x, height AS y FROM everyday WHERE height = (SELECT MAX(height) FROM everyday WHERE userid=? AND date like ?) AND date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['hdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, weight AS y FROM everyday WHERE weight = (SELECT MAX(weight) FROM everyday WHERE userid=? AND date like ?) AND date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['wdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, fat AS y FROM everyday WHERE fat = (SELECT MAX(fat) FROM everyday WHERE userid=? AND date like ?) AND date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['fdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, muscle AS y FROM everyday WHERE muscle = (SELECT MAX(muscle) FROM everyday WHERE userid=? AND date like ?) AND date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['mdata'], $result[0]);
        }

        echo json_encode(array("everydaydata" =>$everydayData, "week"=>$week, "month"=>$month, "year"=>$year));
    }

    function nextMeal(Request $req){
        $data = $req->all();
        DB::insert('INSERT INTO nextmeal(userid, goodfood1, goodfood2, goodfood3, nextfood1, nextfood2, nextfood3, whe, wher, how, regDate) VALUES(?,?,?,?,?,?,?,?,?,?,?)', [$req->session()->get('userid'), $data['goodfood1'], $data['goodfood2'], $data['goodfood3'], $data['nextfood1'], $data['nextfood2'], $data['nextfood3'], $data['when'], $data['where'], $data['how'],date("y-m-d")]);
        return view("subItemPage");
    }

    function setGraph(Request $req){
        $userid="";
        $player="";
        if($req->session()->get('role')=='staff'){
            $userid = $req->playid;
            return view('graphPage',compact('userid'));
        }
        else
        {
            $userid = $req->session()->get('userid');
            $player = $userid;
            return view('graphPage',compact('userid','player'));
        }
    }

    function setResult(Request $req){
        $userid="";
        $player="";
        if($req->session()->get('role')=='staff'){
            $userid = $req->playid;
            return view('result',compact('userid'));
        }
        else{
            $userid = $req->session()->get('userid');
            $player = $userid;
            return view('result',compact('userid','player'));
        }

    }

    function csvSave(Request $req){
        $data = $req->all();
        $delimiter = ",";
        $dietData = array();
        $changeData = array();
        $files = array();
        $changeNumber = array();
        $eval_data = array();

        for($i=0; $i<count($data['userlist']); $i++){


            $result = DB::select("select userid, stapleFood, mainDish, sideDish,
            meat, seafood, eggs, beans, LCvegetables, GYvegetables, mushrooms, seaweeds,
            potatoes, milk, fruit, sweets, saltSweets, juice, friedFood, fastFood, misoSoup,
            MenSoup, supply, regDate from diet where userid=? and regDate BETWEEN ? AND  ?",[$data['userlist'][$i],$data['startyear'], $data['endyear']]);
            $dietData = array_merge($dietData,$result);

            $result = DB::select("select userid, height, weight, fat,muscle, date from everyday where userid=? and date BETWEEN ? AND  ?",[$data['userlist'][$i], $data['startyear'], $data['endyear']]);
            $changeData= array_merge($changeData,$result);

            $result = DB::select("select * from changeddatas where userid=? and regDate BETWEEN ? AND  ?",[$data['userlist'][$i], $data['startyear'], $data['endyear']]);
            $changeNumber= array_merge($changeNumber,$result);

            $result = DB::select("select * from evaluatedatas where userid=? and regDate BETWEEN ? AND  ?",[$data['userlist'][$i], $data['startyear'], $data['endyear']]);
            $eval_data= array_merge($eval_data,$result);

        }
        if($data['dietData']==1){
            $filename = 'diet'.date('Ymd').'_'.date('his').'';
            $fp = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('userid', 'stapleFood', 'mainDish', 'sideDish',
            'meat', 'seafood', 'eggs', 'beans', 'LCvegetables', 'GYvegetables', 'mushrooms', 'seaweeds',
            'potatoes', 'milk', 'fruit', 'sweets', 'saltSweets', 'juice', 'friedFood', 'fastFood', 'misoSoup',
            'MenSoup', 'supply', 'regDate');
            $headers = array(
                'Content-Type'        => 'text/csv',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Disposition' => 'attachment; filename="' . $filename . '";',
                'Expires'             => '0',
                'Pragma'              => 'public',
            );
            fputcsv($fp, $columnNames);
            $i=0;
            foreach ($dietData as $row) {
                $lineData = array($row->userid, $row->stapleFood, $row->mainDish, $row->sideDish,
                $row->meat, $row->seafood, $row->eggs, $row->beans, $row->LCvegetables, $row->GYvegetables, $row->mushrooms, $row->seaweeds,
                $row->potatoes, $row->milk, $row->fruit, $row->sweets, $row->saltSweets, $row->juice, $row->friedFood, $row->fastFood, $row->misoSoup,
                $row->MenSoup, $row->supply, $row->regDate);
                fputcsv($fp, $lineData);
                $i++;
            }
            fclose($fp);
            $file = $filename.'.csv';
            array_push($files,$file);
        }
        if($data['changeData']==1){
            $filename = 'change'.date('Ymd').'_'.date('his').'';
            $fp1 = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('userid', 'height', 'weight', 'fat',        'muscle', 'date');
            $headers = array(
                'Content-Type'        => 'text/csv',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Disposition' => 'attachment; filename="' . $filename . '";',
                'Expires'             => '0',
                'Pragma'              => 'public',
            );
            fputcsv($fp1, $columnNames);
            foreach ($changeData as $row) {
                $lineData = array($row->userid, $row->height, $row->weight, $row->fat,
                $row->muscle, $row->date);
                fputcsv($fp1, $lineData);
                $i++;
            }
            fclose($fp1);
            $file = $filename.'.csv';
            array_push($files,$file);
        }

        if ($data['changeDatacheck'] == 1) {

            $filename = 'Uncorrected_data'.date('Y-m-d').'_'.date('his').'';
            $fp2 = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('ID', '主食-朝', '主食-昼', '主食-夜', '主菜-朝', '主菜-昼', '主菜-夜', '肉', '魚介類', '卵', '豆・豆製品', '副菜-朝', '副菜-昼', '副菜-夜', '色のうすい野', '色のこい野菜', 'きのこ', '海藻', 'いも','牛乳・乳製品 - 量', '牛乳・乳製品 - 頻度', '果物-量', '果物 - 頻度' , '甘いお菓子-量', '甘いお菓子 - 頻度', 'しょっぱいお菓子-量', 'しょっぱいお菓子 - 頻度', 'ジュース-量', 'ジュース - 頻度', '揚げ物', 'ファーストフード', '汁物', 'スープ', 'サプリ', 'エネルギー', 'ミネラル', 'ビタミン', 'タンパク質・アミノ酸', 'その他', 'わからない');
            setlocale(LC_ALL, 'SJIS');
            $headers = array(
                'Content-Type'        => 'text/csv;charset=Shift_JIS',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Disposition' => 'attachment; filename="' . $filename . '";',
                'Expires'             => '0',
                'Pragma'              => 'public',
            );
            fputcsv($fp2, $columnNames);
            foreach ($changeNumber as $row) {
                $lineData = array($row->userid, $row->f1, $row->f2, $row->f3, $row->f4,$row->f5, $row->f6, $row->f7, $row->f8, $row->f9, $row->f10, $row->f11, $row->f12, $row->f13, $row->f14, $row->f15, $row->f16, $row->f17, $row->f18, $row->f19, $row->f20, $row->f21, $row->f22, $row->f23, $row->f24, $row->f25, $row->f26, $row->f27, $row->f28, $row->f29, $row->f30, $row->f31, $row->f32, $row->f33, $row->energy, $row->calcium, $row->vitamin, $row->others, $row->unknown, $row->otherslist);
                fputcsv($fp2, $lineData);
                $i++;
            }

            fclose($fp2);
            $file = $filename.'.csv';
            array_push($files,$file);
        }

        if ($data['evaluatedDatacheck'] == 1) {
            
            $filename = 'Score_by_nutrition_evaluation'.date('Y-m-d').'_'.date('his').'';
            $fp1 = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('ID', '主食', '主菜', '副菜','牛乳・乳製品', '果物', 'エネルギー源', 'タンパク質源', '脂質源', 'ビタミン源', 'ミネラル源','食物繊維源');
            $headers = array(
                'Content-Type'        => 'text/csv',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Disposition' => 'attachment; filename="' . $filename . '";',
                'Expires'             => '0',
                'Pragma'              => 'public',
            );
            fputcsv($fp1, $columnNames);
            foreach ($eval_data as $row) {
                $lineData = array($row->userid, $row->stapleFood, $row->mainDish, $row->sideDish,
                $row->milk, $row->fruit, $row->energy , $row->protein, $row->fat, $row->vitamin, $row->mineral, $row->fiber);
                fputcsv($fp1, $lineData);
                $i++;
            }
            fclose($fp1);
            $file = $filename.'.csv';
            array_push($files,$file);
        }
        echo json_encode($files);
    }

    public function saveEvaluateValues(Request $req)
    {
        $data = $req->all();
        DB::delete('delete from evaluateDatas where regDate = ? and userid = ?',[date("y-m-d"),$req->session()->get('userid')]);

        $result = DB::insert('INSERT INTO evaluateDatas(userid, stapleFood, mainDish, sideDish, milk, fruit,energy,protein,fat,vitamin,mineral, fiber, regDate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$req->session()->get('userid'), $data['main_food'], $data['main_dish'],$data['side_dish'],$data['milk'], $data['fruit'], $data['energy'],$data['protein'],$data['fat'],$data['vitamin'],$data['mineral'], $data['fiber'], date("y-m-d")]);
        echo('OK!');
    }
}

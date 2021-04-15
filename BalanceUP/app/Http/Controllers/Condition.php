<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Condition extends Controller
{
    //
    public function inputDailyBodyRecord(Request $req){
            $everydayData = $req->all();
            DB::insert('INSERT INTO daily_body_records(userid, height, weight, fat, muscle,is_regular, registered_date) VALUES(?,?,?,?,?,0,?)', [$req->session()->get('userid'), $everydayData['height'], $everydayData['weight'], $everydayData['fat'], $everydayData['muscle'], date("y-m-d")]);
            return view('finish_inputing_1');
        }

    public function inputRegularBodyRecord(Request $req){
        $regularData = $req->all();

        DB::insert('INSERT INTO daily_body_records(userid, height, weight, fat, muscle, is_regular, practice_frequency, practice_time, registered_date) VALUES(?,?,?,?,?,1,?,?,?)', [$req->session()->get('userid'), $regularData['height'], $regularData['weight'], $regularData['fat'], $regularData['muscle'], $regularData['frequency'], $regularData['time'], date("y-m-d")]);
        $userid = $req->session()->get('userid');
        return view('regular_meal_record', compact('userid'));
    }

   
    public function inputNutritionScore(Request $req)
    {
        $dietData = $req->all();

        DB::insert('INSERT INTO nutrition_scores(userid, main_meal, main_dish, side_dish, milk, fruit, energy, protein, fat, vitamin, mineral, fiber, salt, registered_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$req->session()->get('userid'), $dietData['mainMeal'], $dietData['mainDish'],$dietData['sideDish'],$dietData['milk'],$dietData['fruit'],$dietData['energy'],$dietData['protein'],$dietData['fat'],$dietData['vitamin'],$dietData['mineral'],$dietData['fiber'],$dietData['salt'],date("y-m-d")]);
        
        $foodInputs = [];
        array_push($foodInputs,$req->session()->get('userid'));
        foreach($dietData['foodInputs'] as $f){
            array_push($foodInputs,$f);
        }
        array_push($foodInputs,date("y-m-d"));

        $result = DB::insert('INSERT INTO food_inputs(userid,main_meal_breakfast,main_meal_lunch,main_meal_dinner,main_dish_breakfast,main_dish_lunch,main_dish_dinner,meat,seafood,egg,bean,side_dish_breakfast,
                                            side_dish_lunch,side_dish_dinner,LCvegetable,GYvegetable,mushroom,seaweed,potato,milk_quantity,milk_frequency,fruit_quantity,fruit_frequency,sweet_quantity,sweet_frequency,salty_sweet_quantity,salty_sweet_frequency,
                                            juice_quantity,juice_frequency,fried_food,fast_food,miso_soup,noodle_soup,supply,supply_energy,supply_mineral,supply_vitamin,supply_protein,supply_other,unknown,other_name,registered_date)
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',$foodInputs);
        return $result;
    }

    public function getNutritionScore(Request $req)
    {
        $myuserid = $req->userid;
        $returndata=array();

        $returndata['nutritionScore'] = DB::select('SELECT main_meal,main_dish,side_dish,milk,fruit,energy,protein,fat,vitamin,mineral,fiber,salt 
        FROM nutrition_scores WHERE userid = ? ORDER BY id DESC LIMIT 3',[$myuserid]);

        $returndata['foodInput'] = DB::select('SELECT userid,meat,seafood,egg,bean,LCvegetable,GYvegetable,mushroom,seaweed,potato,sweet_frequency,fried_food,fast_food
        FROM food_inputs WHERE userid = ? AND id = (SELECT MAX(id) FROM food_inputs WHERE userid =?)',[$myuserid,$myuserid]);

        $returndata['five_two'] = DB::select('SELECT practice_frequency, practice_time, height, weight, fat, muscle, registered_date FROM daily_body_records WHERE userid = ? AND id = (SELECT MAX(id) FROM daily_body_records WHERE userid =?)',[$myuserid,$myuserid]);

        $returndata['userName'] = DB::select('SELECT name, sport, team from players WHERE userid=?', [$myuserid]);

        
        $userCount = DB::select('SELECT count(*) as count from players'); #全員が何人いるか
        $userids = DB::select('SELECT userid from players');
        $userScores = [];
        foreach($userids as $userid){
            $score = 0;
            $userNutritionScore = DB::select('SELECT main_meal,main_dish,side_dish,milk,fruit
                                     FROM nutrition_scores 
                                     WHERE userid = ? AND id = (SELECT MAX(id) FROM nutrition_scores WHERE userid =?)',[$userid->userid,$userid->userid]);
            if(count($userNutritionScore) != 0){
                $userNutritionScore = $userNutritionScore[0];
                foreach($userNutritionScore as $item){
                    $score += $item;
                }
                $userScores[] = ["name" => $userid->userid, "score" => $score];  
            } 
        }
        array_multisort(array_column($userScores, 'score'), SORT_DESC, $userScores);

        $grade = 1;
        $cnt = 1;
        $bef_point = 0;
        foreach($userScores as $key => $value){
            if($bef_point != $value['score']){
                $grade = $cnt;
            }
            if($myuserid == $value['name']){
                break;
            }
            $bef_point = $value['score'];
            $cnt++;
        }

        $returndata['grade'] = $grade;
        $returndata['count'] = $userCount[0]->count;
        
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
        $everydayData['hdata'] = DB::select("SELECT  DISTINCT registered_date as x, height as y FROM daily_body_records WHERE userid=? AND registered_date>?", [$userid,$startdate]);
        $everydayData['wdata'] = DB::select("SELECT  DISTINCT registered_date as x, weight as y FROM daily_body_records WHERE userid=? AND registered_date>?", [$userid,$startdate]);
        $everydayData['fdata'] = DB::select("SELECT  DISTINCT registered_date as x, fat as y FROM daily_body_records WHERE userid=? AND registered_date>?", [$userid,$startdate]);
        $everydayData['mdata'] = DB::select("SELECT  DISTINCT registered_date as x, muscle as y FROM daily_body_records WHERE userid=? AND registered_date>?", [$userid,$startdate]);

        $week = array();
        $week['hdata'] = array();
        $week['wdata'] = array();
        $week['fdata'] = array();
        $week['mdata'] = array();

        for($i=0;$i<4;$i++)
        {
            $endtime = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string(($i * 7)." days")),"Y-m-d");
            $startdate = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((($i + 1) * 7)." days")),"Y-m-d");
            $result = DB::select("SELECT registered_date AS x, height AS y FROM daily_body_records WHERE height = (SELECT MAX(height) FROM daily_body_records WHERE userid=? AND registered_date>? AND registered_date<=?) AND registered_date>? AND registered_date<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['hdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, weight AS y FROM daily_body_records WHERE weight = (SELECT MAX(weight) FROM daily_body_records WHERE userid=? AND registered_date>? AND registered_date<=?) AND registered_date>? AND registered_date<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['wdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, fat AS y FROM daily_body_records WHERE fat = (SELECT MAX(fat) FROM daily_body_records WHERE userid=? AND registered_date>? AND registered_date<=?) AND registered_date>? AND registered_date<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['fdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, muscle AS y FROM daily_body_records WHERE muscle = (SELECT MAX(muscle) FROM daily_body_records WHERE userid=? AND registered_date>? AND registered_date<=?) AND registered_date>? AND registered_date<=?", [$userid, $startdate,$endtime,$startdate,$endtime]);
            if($result) array_push($week['mdata'], $result[0]);
        }

        $yy = date("Y");
        $mm = date("m");

        $month = array();
        $month['hdata'] = array();
        $month['wdata'] = array();
        $month['fdata'] = array();
        $month['mdata'] = array();
        for($i=0;$i<4;$i++)
        {
            $monthstring = $yy."-".$mm."-%";
            $result = DB::select("SELECT registered_date AS x, height AS y FROM daily_body_records WHERE height = (SELECT MAX(height) FROM daily_body_records WHERE userid=? and registered_date like ?) and  registered_date like ? limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['hdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, weight AS y FROM daily_body_records WHERE weight = (SELECT MAX(weight) FROM daily_body_records WHERE userid=? and registered_date like ?) and registered_date like ? limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['wdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, fat AS y FROM daily_body_records WHERE fat = (SELECT MAX(fat) FROM daily_body_records WHERE userid=? and registered_date like ?) and registered_date like ?  limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['fdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, muscle AS y FROM daily_body_records WHERE muscle = (SELECT MAX(muscle) FROM daily_body_records WHERE userid=? and registered_date like ?)and registered_date like ?  limit 1", [$userid, $monthstring,$monthstring]);
            if($result) array_push($month['mdata'], $result[0]);
            $mm -=1;
            if($mm<=0)
            {
                $mm+=12;
                $yy--;
            }
        }
        clock($month);
        $year = array();
        $year['hdata'] = array();
        $year['wdata'] = array();
        $year['fdata'] = array();
        $year['mdata'] = array();
        for($i=0;$i<4;$i++)
        {
            $yy = (int)date("Y") - 3 + $i;
            $result = DB::select("SELECT registered_date AS x, height AS y FROM daily_body_records WHERE height = (SELECT MAX(height) FROM daily_body_records WHERE userid=? AND registered_date like ?) AND registered_date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['hdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, weight AS y FROM daily_body_records WHERE weight = (SELECT MAX(weight) FROM daily_body_records WHERE userid=? AND registered_date like ?) AND registered_date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['wdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, fat AS y FROM daily_body_records WHERE fat = (SELECT MAX(fat) FROM daily_body_records WHERE userid=? AND registered_date like ?) AND registered_date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['fdata'], $result[0]);
            $result = DB::select("SELECT registered_date AS x, muscle AS y FROM daily_body_records WHERE muscle = (SELECT MAX(muscle) FROM daily_body_records WHERE userid=? AND registered_date like ?) AND registered_date like ? limit 1", [$userid, $yy."-%",$yy."-%"]);
            if($result) array_push($year['mdata'], $result[0]);
        }

        echo json_encode(array("everydaydata" =>$everydayData, "week"=>$week, "month"=>$month, "year"=>$year));
    }

    function nextMeal(Request $req){
        $data = $req->all();
        DB::insert('INSERT INTO nextmeal(userid, goodfood1, goodfood2, goodfood3, nextfood1, nextfood2, nextfood3, whe, wher, how, regDate) VALUES(?,?,?,?,?,?,?,?,?,?,?)', [$req->session()->get('userid'), $data['goodfood1'], $data['goodfood2'], $data['goodfood3'], $data['nextfood1'], $data['nextfood2'], $data['nextfood3'], $data['when'], $data['where'], $data['how'],date("y-m-d")]);
        return view("subItemPage");
    }

    function setBodyGraph(Request $req){
        $userid="";
        $player="";
        if($req->session()->get('role')=='staff'){
            $userid = $req->playid;
            return view('body_graph',compact('userid'));
        }
        else
        {
            $userid = $req->session()->get('userid');
            $player = $userid;
            return view('body_graph',compact('userid','player'));
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
        $files = [];

        if($data['changeBodyCheck'] == 1){
            $filename = '体の変化'.date('Ymd').'_'.date('his').'';
            $fp = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('ID','性別(男:1,女:2)','入力日付','身長','体重','体脂肪率','筋肉量');
            mb_convert_variables('SJIS', 'UTF-8', $columnNames);
            fputcsv($fp, $columnNames);

            for($i=0;$i<count($data['userlist']);$i++){
                $userinfo = DB::select('SELECT * FROM players WHERE userid=?',[$data['userlist'][$i]]);
                $userinfo = (array)$userinfo[0];
                $dailyBodyRecords = DB::select('SELECT * FROM daily_body_records WHERE userid=? AND registered_date BETWEEN ? AND ?',[$data['userlist'][$i],$data['startyear'], $data['endyear']]);
                for($j=0;$j<count($dailyBodyRecords);$j++){
                    $dailyBodyRecord = (array)$dailyBodyRecords[$j];
                    $lineData = array($userinfo["userid"],$userinfo["sex"]+1,$dailyBodyRecord["registered_date"],$dailyBodyRecord["height"],$dailyBodyRecord["weight"],$dailyBodyRecord["fat"],$dailyBodyRecord["muscle"]);
                    mb_convert_variables('SJIS', 'UTF-8', $lineData);
                    fputcsv($fp, $lineData);
                }
            }

            fclose($fp);
            $file = $filename.'.csv';
            array_push($files,$file);
        }

        if($data['foodInputCheck'] == 1){
            $filename = '入力未修正データ'.date('Ymd').'_'.date('his').'';
            $fp = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('ID','性別(男:1,女:2)','入力日付','主食 朝','主食 昼','主食 夜','主菜 朝','主菜 昼','主菜 夜','肉','魚介類','卵','豆製品',
                                '副菜 朝','副菜 昼','副菜 夜','色のうすい野菜','色のこい野菜','きのこ','海藻','いも','牛乳・乳製品 量','牛乳・乳製品 頻度',
                                '果物 量','果物 頻度','甘いお菓子 量','甘いお菓子 頻度','しょっぱいお菓子 量','しょっぱいお菓子 頻度','ジュース 量',
                                'ジュース 頻度','揚げ物','ファーストフード','汁物','スープ','サプリ','エネルギー','ミネラル','ビタミン','タンパク質・アミノ酸',
                                'その他','わからない','サプリ名');
            mb_convert_variables('SJIS', 'UTF-8', $columnNames);
            fputcsv($fp, $columnNames);

            for($i=0;$i<count($data['userlist']);$i++){
                $userinfo = DB::select('SELECT * FROM players WHERE userid=?',[$data['userlist'][$i]]);
                $userinfo = (array)$userinfo[0];
                $foodInputs = DB::select('SELECT * FROM food_inputs WHERE userid=? AND registered_date BETWEEN ? AND ?',[$data['userlist'][$i],$data['startyear'], $data['endyear']]);
                for($j=0;$j<count($foodInputs);$j++){
                    $foodInput = (array)$foodInputs[$j];
                    $lineData = array($userinfo["userid"],$userinfo["sex"]+1,$foodInput["registered_date"]);
                    $foodInputKeys = array_keys($foodInput);
                    for($k=2; $k<=34;$k++){
                        array_push($lineData,(int)$foodInput[$foodInputKeys[$k]]);
                    }
                    for($k=35; $k<=41;$k++){
                        array_push($lineData,$foodInput[$foodInputKeys[$k]]);
                    }
                    mb_convert_variables('SJIS', 'UTF-8', $lineData);
                    fputcsv($fp, $lineData);
                }
            }

            fclose($fp);
            $file = $filename.'.csv';
            array_push($files,$file);
        }

        if($data['nutritionScoreCheck'] == 1){
            $filename = '栄養評価式による得点'.date('Ymd').'_'.date('his').'';
            $fp = fopen('./CSV/'.$filename.'.csv','w');
            $columnNames = array('ID','性別(男:1,女:2)','入力日付','主食','主菜','副菜','牛乳・乳製品','果物','エネルギー源','タンパク質源','脂質源','ビタミン源','ミネラル源','食物繊維源');
            mb_convert_variables('SJIS', 'UTF-8', $columnNames);
            fputcsv($fp, $columnNames);

            for($i=0;$i<count($data['userlist']);$i++){
                $userinfo = DB::select('SELECT * FROM players WHERE userid=?',[$data['userlist'][$i]]);
                $userinfo = (array)$userinfo[0];
                $nutritionScores = DB::select('SELECT * FROM nutrition_scores WHERE userid=? AND registered_date BETWEEN ? AND ?',[$data['userlist'][$i],$data['startyear'], $data['endyear']]);
                for($j=0;$j<count($nutritionScores);$j++){
                    $nutritionScore = (array)$nutritionScores[$j];
                    $lineData = array($userinfo["userid"],$userinfo["sex"]+1,$nutritionScore["registered_date"],$nutritionScore["main_meal"],$nutritionScore["main_dish"],$nutritionScore["side_dish"],$nutritionScore["milk"],$nutritionScore["fruit"],$nutritionScore["energy"],$nutritionScore["protein"],$nutritionScore["fat"],$nutritionScore["vitamin"],$nutritionScore["mineral"],$nutritionScore["fiber"]);
                    mb_convert_variables('SJIS', 'UTF-8', $lineData);
                    fputcsv($fp, $lineData);
                }
            }

            fclose($fp);
            $file = $filename.'.csv';
            array_push($files,$file);
        }
        
        return json_encode($files);
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

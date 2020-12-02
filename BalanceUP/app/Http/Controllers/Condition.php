<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Condition extends Controller
{
    //

    public function regularInput(Request $req){
        $regularData = $req->all();
        DB::insert('INSERT INTO regular(userid, height, weight, fat, muscle, frequency, time, regDate) VALUES(?,?,?,?,?,?,?,?)', [$req->session()->get('userid'), $regularData['height'], $regularData['weight'], $regularData['fat'], $regularData['muscle'], $regularData['frequency'], $regularData['time'], date("y-m-d")]);
        $endtime = date("y-m-d");
        
        for($i = 1; $i<=7; $i++){
            $startdate = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((7-$i)." days")),"Y-m-d");
            DB::delete('delete from everyday where date=?',[$startdate]);
            DB::insert('INSERT INTO everyday(userid, height, weight, fat, muscle, date) VALUES(?,?,?,?,?,?)', [$req->session()->get('userid'), $regularData['height'], $regularData['weight'], $regularData['fat'], $regularData['muscle'], $startdate]);
        }
        DB::insert('INSERT INTO regular(userid, height, weight, fat, muscle, frequency, time, regDate) VALUES(?,?,?,?,?,?,?,?)', [$req->session()->get('userid'), $regularData['height'], $regularData['weight'], $regularData['fat'], $regularData['muscle'], $regularData['frequency'], $regularData['time'], date("y-m-d")]);
        return view('regularMeal'); 
    }

    public function everydayInput(Request $req){
        $everydayData = $req->all();
        DB::insert('INSERT INTO everyday(userid, height, weight, fat, muscle, date) VALUES(?,?,?,?,?,?)', [$req->session()->get('userid'), $everydayData['height'], $everydayData['weight'], $everydayData['fat'], $everydayData['muscle'], date("y-m-d")]);
        return view('finishInputing1');
    }

    public function insertDiet(Request $req)
    {
        $dietData = $req->all();
        DB::delete('delete from diet where regDate = ? and userid = ?',[date("y-m-d"),$req->session()->get('userid')]);
        $result = DB::insert('INSERT INTO diet(userid, stapleFood, mainDish, sideDish,
        meat, seafood, eggs, beans, LCvegetables, GYvegetables, mushrooms, seaweeds, 
        potatoes, milk, fruit, sweets, saltSweets, juice, friedFood, fastFood, misoSoup,
         MenSoup, supply, regDate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$req->session()->get('userid'), $dietData['stapleFood'], $dietData['mainDish'], 
        $dietData['sideDish'],$dietData['meat'], $dietData['seafood'], $dietData['eggs'],
         $dietData['beans'], $dietData['LCvegetables'], $dietData['GYvegetables'], $dietData['mushrooms'], 
         $dietData['seaweeds'], $dietData['potatoes'], $dietData['milk'],$dietData['fruit'], $dietData['sweets'], 
         $dietData['saltSweets'], $dietData['juice'], $dietData['friedFood'], $dietData['fastFood'], 
         $dietData['misoSoup'], $dietData['MenSoup'], $dietData['supply'], date("y-m-d")]);
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
        
         $user_point = 0;
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

        echo json_encode($returndata);
    }

    function getGraphData(Request $req)
    {
        $today=strtotime("today");
        $startdate = strtotime("-1 week", $today);
        $startdate = date("yy-m-d",$startdate);
        $userid = $req->userid;
        $everydayHData = DB::select("SELECT height,date FROM everyday  WHERE userid=?  AND DATE IN (SELECT DATE FROM everyday WHERE date>?) ORDER BY DATE", [$userid, $startdate]);
        $everydayWData = DB::select("SELECT weight, date FROM everyday WHERE userid=?  AND DATE IN (SELECT DATE FROM everyday WHERE date>?) order by date", [$userid, $startdate]);
        $everydayFData = DB::select("SELECT fat, date FROM everyday WHERE userid=?  AND DATE IN (SELECT DATE FROM everyday WHERE date>?) order by date", [$userid, $startdate]);
        $everydayMData = DB::select("SELECT muscle, date FROM everyday WHERE userid=?  AND DATE IN (SELECT DATE FROM everyday WHERE date>?) order by date", [$userid, $startdate]);
        $everydayData['hdata']=array();
        $everydayData['wdata']=array();
        $everydayData['fdata']=array();
        $everydayData['mdata']=array();
        if(count($everydayHData) == 0)
        $everydayData['hdata'] = 'null';
        else if(count($everydayHData) == 1)
        {
            $y = $everydayHData[0]['height'];
            for($i=0; $i<7; $i++)
            {
                array_push($everydayData['hdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string((7-$i)." days")), "Y-m-d"), "y" => $y]);
            }
        }
        else
        {
            $count = count($everydayHData);
            if($everydayHData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string("6 days")),"Y-m-d"))
            {
                $i = 0;
                $y = $everydayHData[0]->height;
                while($everydayHData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string(((6-$i)." days"))),"Y-m-d"))
                {
                    array_push($everydayData['hdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((6-$i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
            for($i=0;$i<$count; $i++)
            {
                array_push($everydayData['hdata'],(object)["x" => $everydayHData[$i]->date, "y" => $everydayHData[$i]->height]);
            }
            $str= date("Y-m-d");
            if($everydayHData[$count-1]->date != $str)
            {
                $i = 0;
                $y = $everydayHData[$count-1]->height;
               
                while(date("y-m-d") != date_format(date_add(date_create($everydayHData[$count-1]->date),date_interval_create_from_date_string(($i)." days")),"Y-m-d"));
                {
                    array_push($everydayData['hdata'], (object)["x" => date_format(date_add(strtotime($everydayHData[$count-1]->date), date_interval_create_from_date_string(($i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
        }

        if(count($everydayWData) == 0)
        $everydayData['wdata'] = 'null';
        else if(count($everydayWData) == 1)
        {
            $y = $everydayWData[0]->weight;
            for($i=0; $i<7; $i++)
            {
                array_push($everydayData['wdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string((6-$i)." days")), "Y-m-d"), "y" => $y]);
            }
        }
        else
        {
            $count = count($everydayWData);
            if($everydayWData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string("6 days")),"Y-m-d"))
            {
                $i = 0;
                $y = $everydayWData[0]->weight;
                while($everydayWData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string(((6-$i)." days"))),"Y-m-d"))
                {
                    array_push($everydayData['wdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((6-$i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
            for($i=0;$i<$count; $i++)
            {
                array_push($everydayData['wdata'],(object)["x" => $everydayWData[$i]->date, "y" => $everydayWData[$i]->weight]);
            }
            $str= date("Y-m-d");
            if($everydayWData[$count-1]->date != $str)
            {
                $i = 0;
                $y = $everydayWData[$count-1]->weight;
               
                while(date("y-m-d") != date_format(date_add(date_create($everydayWData[$count-1]->date),date_interval_create_from_date_string(($i)." days")),"Y-m-d"));
                {
                    array_push($everydayData['wdata'], (object)["x" => date_format(date_add(strtotime($everydayWData[$count-1]->date), date_interval_create_from_date_string(($i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
        }

        if(count($everydayFData) == 0)
        $everydayData['fdata'] = 'null';
        else if(count($everydayFData) == 1)
        {
            $y = $everydayFData[0]->fat;
            for($i=0; $i<7; $i++)
            {
                array_push($everydayData['fdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string((6-$i)." days")), "Y-m-d"), "y" => $y]);
            }
        }
        else
        {
            $count = count($everydayFData);
            if($everydayFData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string("6 days")),"Y-m-d"))
            {
                $i = 0;
                $y = $everydayFData[0]->fat;
                while($everydayFData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string(((6-$i)." days"))),"Y-m-d"))
                {
                    array_push($everydayData['fdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((6-$i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
            for($i=0;$i<$count; $i++)
            {
                array_push($everydayData['fdata'],(object)["x" => $everydayFData[$i]->date, "y" => $everydayFData[$i]->fat]);
            }
            $str= date("Y-m-d");
            if($everydayFData[$count-1]->date != $str)
            {
                $i = 0;
                $y = $everydayFData[$count-1]->fat;
               
                while(date("y-m-d") != date_format(date_add(date_create($everydayFData[$count-1]->date),date_interval_create_from_date_string(($i)." days")),"Y-m-d"));
                {
                    array_push($everydayData['fdata'], (object)["x" => date_format(date_add(strtotime($everydayFData[$count-1]->date), date_interval_create_from_date_string(($i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
        }

        if(count($everydayMData) == 0)
        $everydayData['mdata'] = 'null';
        else if(count($everydayMData) == 1)
        {
            $y = $everydayMData[0]->muscle;
            for($i=0; $i<7; $i++)
            {
                array_push($everydayData['mdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string((6-$i)." days")), "Y-m-d"), "y" => $y]);
            }
        }
        else
        {
            $count = count($everydayMData);
            if($everydayMData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string("6 days")),"Y-m-d"))
            {
                $i = 0;
                $y = $everydayMData[0]->muscle;
                while($everydayMData[0]->date != date_format(date_sub(date_create(date("y-m-d")),date_interval_create_from_date_string(((6-$i)." days"))),"Y-m-d"))
                {
                    array_push($everydayData['mdata'], (object)["x" => date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((6-$i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
            for($i=0;$i<$count; $i++)
            {
                array_push($everydayData['mdata'],(object)["x" => $everydayMData[$i]->date, "y" => $everydayMData[$i]->muscle]);
            }
            $str= date("Y-m-d");
            if($everydayMData[$count-1]->date != $str)
            {
                $i = 0;
                $y = $everydayMData[$count-1]->muscle;
               
                while(date("y-m-d") != date_format(date_add(date_create($everydayMData[$count-1]->date),date_interval_create_from_date_string(($i)." days")),"Y-m-d"));
                {
                    array_push($everydayData['mdata'], (object)["x" => date_format(date_add(strtotime($everydayMData[$count-1]->date), date_interval_create_from_date_string(($i)." days")),"Y-m-d"), "y" => $y]);
                    $i++;
                }
            }
        }

        $week = array();
        $week['hdata'] = array();
        $week['wdata'] = array();
        $week['fdata'] = array();
        $week['mdata'] = array();

        for($i=0;$i<4;$i++)
        {
            $endtime = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string(($i * 7)." days")),"Y-m-d");
            $startdate = date_format(date_sub(date_create(date("y-m-d")), date_interval_create_from_date_string((($i + 1) * 7)." days")),"Y-m-d");
            $result = DB::select("SELECT DATE AS x, height AS y FROM everyday WHERE height = (SELECT MAX(height) FROM everyday WHERE userid=? AND DATE>? AND DATE<?)", [$userid, $startdate,$endtime]);
            if($result) array_push($week['hdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, weight AS y FROM everyday WHERE weight = (SELECT MAX(weight) FROM everyday WHERE userid=? AND DATE>? AND DATE<?)", [$userid, $startdate,$endtime]);
            if($result) array_push($week['wdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, fat AS y FROM everyday WHERE fat = (SELECT MAX(fat) FROM everyday WHERE userid=? AND DATE>? AND DATE<?)", [$userid, $startdate,$endtime]);
            if($result) array_push($week['fdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, muscle AS y FROM everyday WHERE muscle = (SELECT MAX(muscle) FROM everyday WHERE userid=? AND DATE>? AND DATE<?)", [$userid, $startdate,$endtime]);
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
            $result = DB::select("SELECT DATE AS x, height AS y FROM everyday WHERE height = (SELECT MAX(height) FROM everyday WHERE userid=? and date like ?) limit 1", [$userid, $yy."-".$mm."-%"]);
            if($result) array_push($month['hdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, weight AS y FROM everyday WHERE weight = (SELECT MAX(weight) FROM everyday WHERE userid=? and date like ?) limit 1", [$userid, $yy."-".$mm."-%"]);
            if($result) array_push($month['wdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, fat AS y FROM everyday WHERE fat = (SELECT MAX(fat) FROM everyday WHERE userid=? and date like ? limit 1)", [$userid, $yy."-".$mm."-%"]);
            if($result) array_push($month['fdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, muscle AS y FROM everyday WHERE muscle = (SELECT MAX(muscle) FROM everyday WHERE userid=? and date like ? limit 1)", [$userid, $yy."-".$mm."-%"]);
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
            $result = DB::select("SELECT DATE AS x, height AS y FROM everyday WHERE height = (SELECT MAX(height) FROM everyday WHERE userid=? AND date like ?)", [$userid, $yy."-%"]);
            if($result) array_push($year['hdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, weight AS y FROM everyday WHERE weight = (SELECT MAX(weight) FROM everyday WHERE userid=? AND date like ?)", [$userid, $yy."-%"]);
            if($result) array_push($year['wdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, fat AS y FROM everyday WHERE fat = (SELECT MAX(fat) FROM everyday WHERE userid=? AND date like ?)", [$userid, $yy."-%"]);
            if($result) array_push($year['fdata'], $result[0]);
            $result = DB::select("SELECT DATE AS x, muscle AS y FROM everyday WHERE muscle = (SELECT MAX(muscle) FROM everyday WHERE userid=? AND date like ?)", [$userid, $yy."-%"]);
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
        $dietData = array();
        $changeData = array();
        $startyear=2019;
        $endyear =(int)date("Y");
        $delimiter = ",";
        if($data['startyear']!=null) $startyear=(int)$data['startyear'];
        if($data['endyear']!=null) $endyear=(int)$data['endyear'];
        for($i=0; $i<count($data['userlist']); $i++){
            
            for($year=$startyear; $year<=$endyear;$year++)
            {
                $result = DB::select("select userid, stapleFood, mainDish, sideDish,
                meat, seafood, eggs, beans, LCvegetables, GYvegetables, mushrooms, seaweeds, 
                potatoes, milk, fruit, sweets, saltSweets, juice, friedFood, fastFood, misoSoup,
                MenSoup, supply, regDate from diet where userid=? and regDate like ?",[$data['userlist'][$i],$year."-%"]);
                $dietData = array_merge($dietData,$result);
            }
        
        
            for($year=$startyear; $year<=$endyear;$year++)
            {
                $result = DB::select("select userid, height, weight, fat,muscle, date from everyday where userid=? and date like ?",[$data['userlist'][$i],$year."-%"]);
                $changeData= array_merge($changeData,$result);
            }
            
        }
        if($data['dietData']==1){
            $filename = 'diet'.date('Ymd').'_'.date('his').'';		 
            $fp = fopen($filename.'.csv','w');
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
        }
        if($data['changeData']==1){
            $filename = 'change'.date('Ymd').'_'.date('his').'';		 
            $fp1 = fopen($filename.'.csv','w');
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
        }
        echo json_encode(true);
    }
}

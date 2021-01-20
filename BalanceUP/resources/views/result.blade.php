@extends('app')
@section('title', '先頭ページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
   var values;
   var protein;
   var five_two_player;
   var playerName;
   $(document).ready(function () {
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      var useridinput = document.getElementById("userid")
      var userid = useridinput.value;
      $.get("{{url('/getDiet')}}", { userid: userid }, function sucess(result) {

         values = JSON.parse(result)['data'][0];
         five_two_player = JSON.parse(result)['five_two'][0];
         playerName = JSON.parse(result)['userName'][0];

         $("#p_name").html(playerName['name']);
         $("#p_group").html(playerName['sport']);
         $("#p_height").html(five_two_player['height']);
         $("#p_weight").html(five_two_player['weight']);
         $("#p_fat").html(five_two_player['fat']);
         $("#p_muscle").html(five_two_player['muscle']);
         $("#p_date").html(five_two_player['date']);

         var order = JSON.parse(result)['grade'];
         var s_num = JSON.parse(result)['count'];

         order = parseInt(order);
         s_num = parseInt(s_num);
         var posit = 100 / s_num * (order-1);
         if (posit == 0) {
             posit = 2;
         }
         if (posit == 100) {
             posit = 98;
         }
         $("#grad").css("right", posit + "%");
         var c = document.getElementById("grad");
         // c.innerHTML = "|";
         intakeSourcegram();
         drawDietgram();
         writeComment();

      });



   });
   $(window).resize(function () {
      drawDietgram();
      intakeSourcegram()
   });

   function drawDietgram() {
      var w = $('#board').width() * 0.5;
      var h = $('#board').width() * 0.5;
      var text = ['', '', '', '', ''];
      var texten = ['stapleFood', 'mainDish', 'sideDish', 'milk', 'fruit'];
      var c = document.getElementById("dietgram");
      c.width = w;
      c.height = h;

      var r = h * 1 / 2;
      var ctx = c.getContext("2d");
      var x0 = w / 2;
      var y0 = h / 2 - r;
      var pi = 3.1415926535;

      ctx.beginPath();
      ctx.moveTo(x0, y0);
      ctx.font = "15px Arial";
      ctx.fillText(text[0], x0, y0 - 20);
      for (i = 1; i < 5; i++) {
         xh = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * (r + 20);
         yh = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * (r + 20);

         x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r;
         y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r;
         ctx.fillText(text[i], xh, yh);
         ctx.lineTo(x, y);
      }
      ctx.fillStyle = "BlanchedAlmond";
      ctx.fill();
      ctx.closePath();

      x0 = w / 2;
      y0 = h / 2 - (r - r / 3);
      ctx.beginPath();
      ctx.moveTo(x0, y0);
      for (i = 1; i < 5; i++) {
         x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * (r - r / 3);
         y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * (r - r / 3);
         ctx.lineTo(x, y);
      }

      ctx.fillStyle = "PaleTurquoise";
      ctx.fill();
      ctx.closePath();

      x0 = w / 2;
      y0 = h / 2 - r / 3;
      ctx.beginPath();
      ctx.moveTo(x0, y0);
      for (i = 1; i < 5; i++) {
         x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r / 3;
         y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r / 3;
         ctx.lineTo(x, y);
      }

      ctx.fillStyle = "LightSkyBlue";
      ctx.fill();
      ctx.closePath();

      x0 = w / 2;
      y0 = h / 2 - r * values['stapleFood'] / 4.5;
      ctx.beginPath();
      ctx.moveTo(x0, y0);

      for (i = 1; i < 5; i++) {
         x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * values[texten[i]] / 4.5;
         y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * values[texten[i]] / 4.5;
         ctx.lineTo(x, y);
      }

      ctx.closePath();
      ctx.stroke();

      if (values['stapleFood'] >= 3 && values['mainDish'] >= 3 && values['sideDish'] >= 3 && values['milk'] >= 3 && values['fruit'] >= 3) {
         $("#ok").show();
      }

   }


   function intakeSourcegram() {

      var w = $('#board').width();
      var h = w / 2;

      var textjp = ['エネルギー', ' タンパク質', '  脂質', 'ビタミン', 'ミネラル', '食物繊維'];
      var texten = ['energy', 'protein', 'lipid', 'vitamin', 'mineral', 'fiber'];


      var meat = [0, 1, 3.5, 7];
      var seafood = [0, 1, 3.5, 7];
      var eggs = [0, 1, 3.5, 7];
      var beans = [0, 1, 3.5, 7];
      var LCvegetables = [0, 1, 2, 3];
      var GYvegetables = [0, 1, 1, 3];
      var mushrooms = [0, 1.5, 3, 3];
      var seaweeds = [0, 1.5, 3, 3];
      var potatoes = [0, 1.5, 3, 3];
      var friedFood = [3, 3, 4.5, 6];
      var sweets = [0, 1.5, 3, 3];
      var meatforLipid = [3, 3, 3, 6];

      var swt = "";
      if (sweets[values['sweets']*2/3] == 0) {
          swt = 0;
      }

      if (sweets[values['sweets']*2/3] > 0 & sweets[values['sweets']*2/3] < 2) {
          swt = 1;
      }

      if (sweets[values['sweets']*2/3] > 2 & sweets[values['sweets']*2/3] < 2.5) {
          swt = 2;
      }

      if (sweets[values['sweets']*2/3] > 2.5) {
          swt = 3;
      }
      var calcData = new Array();
      calcData[0] = values['stapleFood'];
      calcData[1] = values['mainDish'] * (meat[values['meat'] * 2] + seafood[values['seafood'] * 2] + eggs[values['eggs'] * 2] + beans[values['beans'] * 2]) / 21;
      calcData[2] = (meatforLipid[values['meat'] * 2] + friedFood[values['friedFood'] * 2] + swt) / 3;
      calcData[3] = (LCvegetables[values['LCvegetables'] * 2] + GYvegetables[values['GYvegetables'] * 2] + mushrooms[values['mushrooms'] * 2] + seaweeds[values['seaweeds'] * 2] + potatoes[values['potatoes'] * 2] + values['fruit']) / 6;
      calcData[4] = (LCvegetables[values['LCvegetables'] * 2] + GYvegetables[values['GYvegetables'] * 2] + mushrooms[values['mushrooms'] * 2] + seaweeds[values['seaweeds'] * 2] + potatoes[values['potatoes'] * 2] + values['milk']) / 6;
      calcData[5] = (LCvegetables[values['LCvegetables'] * 2] + GYvegetables[values['GYvegetables'] * 2] + mushrooms[values['mushrooms'] * 2] + seaweeds[values['seaweeds'] * 2] + potatoes[values['potatoes'] * 2]) / 5;

      if (calcData[0] < 0 | isNaN(calcData[0])) {
          calcData[0] = Math.random();
      }
      if (isNaN(calcData[1])) {
          calcData[1] = Math.random();
      }
      if (isNaN(calcData[2])) {
          calcData[2] = Math.random();
      }
      if (isNaN(calcData[3])) {
          calcData[3] = Math.random();
      }
      if (isNaN(calcData[4])) {
          calcData[4] = Math.random();
      }
      if (isNaN(calcData[5])) {
          calcData[5] = Math.random();
      }
      protein = calcData[2];
      var c = document.getElementById("intakegram");
      c.width = w;
      c.height = h;
      var r = 200;
      var ctx = c.getContext("2d");
      var img = document.getElementById("i_diaImg");
    //   ctx.drawImage(img,20,-20);
      var pat=ctx.createPattern(img,'repeat');
      var x0 = w / 2;
      var y0 = h / 2;

      var drectw = w;
      var drecth = drectw / 2;
      ctx.fillStyle = pat;
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2, drectw, drecth / 12);
      ctx.fillStyle = "BlanchedAlmond";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth / 12, drectw, drecth / 6);
      ctx.fillStyle = "PaleTurquoise";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth / 4, drectw, drecth / 8);
      ctx.fillStyle = "LightSkyBlue";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth*3 / 8, drectw, drecth / 6);

        ctx.beginPath();
        ctx.moveTo(x0 - drectw / 2 + (drectw / 7),y0 - drecth / 2);
        ctx.lineTo(x0 - drectw / 2 + (drectw / 7),h);
        ctx.stroke();

        ctx.beginPath();
        ctx.moveTo(x0 - drectw / 2,y0 + drecth / 4);
        ctx.lineTo(w,y0 + drecth / 4);
        ctx.stroke();

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("とりすぎ!", (x0 - drectw / 2 + (drectw / 7))/6, y0 - drecth / 2+ drecth / 24);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("しっかり", (x0 - drectw / 2 + (drectw / 7))/6, y0 - drecth / 2 + drecth / 12+drecth / 12);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("とれています", (x0 - drectw / 2 + (0.6*drectw / 7))/6, y0 - drecth / 2 + drecth / 12+drecth*1.5 / 12);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("すこし", (x0 - drectw / 2 + (drectw / 7))/6, y0 - drecth / 2 + drecth / 4+drecth / 16);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("たりていません", (x0 - drectw / 2 + (0.2*drectw / 7))/6, y0 - drecth / 2 + drecth / 4+drecth*1.8 / 16);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("たりていません", (x0 - drectw / 2 + (0.2*drectw / 7))/6, y0 - drecth / 2 + drecth*3 / 8+drecth / 12);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("ちゅうい!", (x0 - drectw / 2 + (drectw / 7))/6, y0 - drecth / 2 + drecth*3 / 8+drecth*1.6 / 12);

        ctx.fillStyle = "black";
        ctx.font = drecth / 35 + "px Arial";
        ctx.fillText("えいようそ", (x0 - drectw / 2 + (drectw / 7))/6, y0 + 0.8*drecth / 6);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("栄養素", (x0 - drectw / 2 + (1.3*drectw / 7))/6, y0 + 1.3*drecth / 6);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("この栄養素を", (x0 - drectw / 2 + (0.8*drectw / 7))/6, y0 + drecth / 4+drecth / 10);

        ctx.fillStyle = "black";
        ctx.font = drecth / 30 + "px Arial";
        ctx.fillText("ふくむおもな食品", (x0 - drectw / 2 + (0.2*drectw / 7))/6, y0 + drecth / 4+drecth*1.5 / 10);

      for (i = 1; i < 7; i++) {
         ctx.fillStyle = "black";
         ctx.font = drecth / 25 + "px Arial";
         ctx.fillText(textjp[i - 1], x0 - drectw / 2 + i * (drectw / 7), y0 + drecth / 6);
         ctx.fillStyle = "red";
         ctx.beginPath();
         ctx.arc(x0 - drectw / 2 + i * (drectw / 6.5), y0 - (drecth / 2 / 6) * calcData[i - 1], drecth / 30 > 5 ? 5 : drecth / 30, 0, 2 * Math.PI);
         ctx.fill();
         ctx.closePath();
      }
   }

   function writeComment() {
       var never_food = new Array();
       var never_food35 = new Array();
       var never_food36 = new Array();

       var mainfood = values['stapleFood'];
       var mainchai = values['mainDish'];
       var sideDish = values['sideDish'];
       var milk = values['milk'];
       var fruit = values['fruit'];
    //    protein
    // never eatting
       var fastfood = values['fastFood'];
       var friedfood = values['friedFood'];
    //    4.5
       var sweetCake = values['sweets'];
    //    34
       var lcv = values['LCvegetables'];
       var gcv = values['GYvegetables'];
       var meat = values['meat'];
       var seafood = values['seafood'];
       var egg = values['eggs'];
       var bean = values['beans'];
       var seaweed = values['seaweeds'];
       var mushroom = values['mushrooms'];
       var potato = values['potatoes'];

       var commentTag = $("#comment");
       var statement = "";
       var attach = "";
       var f_sport = five_two_player['frequency'];
       var t_sport = five_two_player['time'];
// for 34 pattern
       if (lcv == 0) {
          never_food.push('淡色野菜');
          never_food36.push('淡色野菜');
       }
       if (gcv == 0) {
        never_food.push('緑黄色野菜');
        never_food36.push('緑黄色野菜');
       }
       if (meat == 0) {
        never_food.push('肉');
        never_food35.push('肉');
       }
       if (seafood == 0) {
        never_food.push('魚介類');
        never_food35.push('魚介類');
       }
       if (egg == 0) {
        never_food.push('卵');
        never_food35.push('卵');
       }
       if (bean == 0) {
        never_food.push('豆類');
        never_food35.push('豆類');
       }
       if (seaweed == 0) {
        never_food.push('海そう類');
        never_food36.push('海そう類');
       }
       if (mushroom == 0) {
        never_food.push('きのこ類');
        never_food36.push('きのこ類');
       }
       if (potato == 0) {
        never_food.push('いも類');
        never_food36.push('いも類');
       }

       var extraState = "";
       if (never_food.length > 0) {
           extraState +="今回、";
           for (let index = 0; index < never_food.length; index++) {
               extraState += never_food[index]+" ";
           }
           extraState += "などがあまりとれていなかったので、もっとしっかり食べるようにしましょう！";
       }

       var food_grp="";
       var food_grp35 = "";
       var food_grp36 = "";
       var highValue = new Array();

       if (never_food.length > 0) {
            for(var i = 0; i < never_food.length; i++) {
                food_grp += never_food[i]+"・";
            }
        }

        if (never_food35.length > 0) {
            for(var i = 0; i < never_food35.length; i++) {
                food_grp35 += never_food35[i]+"・";
            }
        }

        if (never_food36.length > 0) {
            for(var i = 0; i < never_food36.length; i++) {
                food_grp36 += never_food36[i]+"・";
            }
        }
// end for 34 pattern
       if (mainfood ==0 | mainchai == 0 | sideDish == 0 | milk ==0 | fruit == 0) {
          statement = "【料理区分】については、記入できていないところがあったので、結果が正しく表示できていません。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood >= 3 & mainchai >= 3 & sideDish >= 3 & milk >= 3 & fruit >= 3) {
          statement = "５つの食品のグループが全部しっかりとれています！すばらしい！！この調子で栄養バランスのとれた食事を続けましょう！" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & sideDish < 3 & milk < 3 & fruit < 3) {
          statement = "どの食品のグループもたりていません。毎日元気にすごすために、朝・昼・夜の3食をしっかり食べるようにしましょう！家で出るごはんや給食は、残さず食べるようにしましょう。残さず食べると、ごはんを作ってくれている人はとてもうれしいですよ。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood >= 3) {
            highValue.push("主食");
       }

       if (mainchai >= 3) {
            highValue.push("主菜");
       }
       if (sideDish >= 3) {
           highValue.push("副菜");
       }
       if (milk >= 3) {
           highValue.push("牛乳•乳製品");
       }
       if (fruit >= 3) {
           highValue.push("果物");
       }

       var sub_text ="";

       if (highValue.length >= 3) {

           for (let index = 0; index < highValue.length; index++) {
               sub_text+= highValue[index];
           }
          attach = "【"+sub_text+"】はしっかりとれています！！ ";
       }

       if (mainchai < 3 & sideDish < 3 & milk < 3 & fruit < 3 & mainfood > 3) {
          statement = attach + "主食以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループをどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。" + extraState;
          commentTag.html(statement);
       }
       // condition 7
       if (mainfood < 3 & sideDish < 3 & milk < 3 & fruit < 3 & mainchai > 3) {
          statement = attach+"主菜以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループをどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & milk < 3 & fruit < 3 & sideDish > 3) {
          statement = attach+"副菜以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループがどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & sideDish < 3 & fruit < 3 & milk > 3) {
          statement = attach+"牛乳・乳製品以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループがどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & sideDish < 3 & milk < 3 & fruit > 3) {
          statement = attach+"果物以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループがどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & sideDish < 3 & t_sport != null & f_sport !=null & milk > 3 & fruit > 3) {
          statement = attach+"これからもっと背をのばして、体を大きくするためには、主食・主菜・副菜がたりていません。スポーツ・運動をしている人は、この3つをしっかりとっていないと、ケガをしやすくなったり、練習ですぐにバテたりします。カレーライスやサンドイッチなどは、この3つが一緒にとれるので、おうちの人に作ってもらうようにお願いしてみましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & sideDish < 3 & milk < 3 & t_sport != null & f_sport !=null & mainchai > 3& fruit > 3) {
          statement = attach+"主食、副菜、牛乳・乳製品がたりていないようです。これらの食品がたりていないと、部活動やクラブチームでの練習や試合ですぐにバテたり、ケガをしやすくなったりします。朝・昼・夜の3食を残さずしっかり食べるようにしましょう！牛乳が飲めない人や苦手な人は、骨まで食べられる魚や緑のこい葉やさい（ほうれんそうなど）をできるだけ多く食べるようにしましょう。" + extraState;
       }


       if (mainfood < 3 & milk < 3 & fruit < 3 & t_sport != null & f_sport !=null & mainchai > 3& sideDish > 3) {
          statement = attach+"主食、牛乳・乳製品、果物がたりていないようです。これらの食品がたりていないと、部活動やクラブチームでの練習や試合ですぐにバテたり、すばやい判断ができなくなったりします。朝・昼・夜の3食を残さずしっかり食べるようにしましょう！かんづめのフルーツをヨーグルトに入れて、フルーツヨーグルトにするとおいしいですよ。おやつや朝ごはんのときに作ってみましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & milk < 3 & t_sport != null & f_sport !=null & sideDish > 3 & fruit > 3) {
          statement = attach+"主食、主菜、牛乳・乳製品がたりていないようです。これらの食品が足りていないと、部活動・クラブチームでの練習や試合で、すぐにバテたり、すばやい判断ができなくなったりします。朝・昼・夜のごはんを残さずしっかり食べるようにしましょう！牛乳が苦手な人は、ココアやジャムなどをまぜて飲むようにしましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & mainchai < 3 & fruit < 3 & t_sport != null & f_sport !=null & sideDish > 3 & milk > 3) {
          statement = attach+"主食、主菜、果物がたりていないようです。これらの食品を、しっかり食べていないと、部活動やクラブチームの練習・試合で、すぐにバテたり、ケガをしやすくなったりします。ジュースを飲むときは、100パーセントのフルーツジュースを飲むようにしましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & sideDish < 3 & fruit < 3 & t_sport != null & f_sport !=null & milk > 3 & mainchai > 3) {
          statement = attach+"主食、副菜、果物がたりていないようです。これらをしっかり食べていないと、部活動やクラブチームの練習・試合で、すぐにバテたり、ケガをしやすくなったりします。わかめごはん、野菜サンド、きのこスパゲッティなどは、主食と副菜がいっしょにとれます。おうちの人に作ってもらうようにお願いしてみましょう。" + extraState;
          commentTag.html(statement);
       }

       if (mainchai < 3 & sideDish < 3 & milk < 3 & t_sport != null & f_sport !=null & mainfood > 3 & fruit & 3) {

          statement = attach+"主菜、副菜、牛乳・乳製品がたりていないようです。部活動やクラブチームの練習・試合で常にいいプレーができるように、いろいろな種類の食品をバランスよく食べるようにしましょう！クリームシチューやサンドイッチなどは、この3つが一緒にとれます。おうちの人に作ってもらうようにお願いしてみましょう。" + extraState;

          if (food_grp !="") {
            statement1 = "今回、【"+food_grp+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (mainchai < 3 & sideDish < 3 & fruit < 3 & t_sport != null & f_sport !=null & mainfood > 3 & milk > 3) {
          statement = attach+"主菜、副菜、果物がたりていないようです。これらをしっかり食べていないと、部活動やクラブチームの練習でつかれやすくなったり、ケガをしやすくなったりします。常にいいプレーができるように、いろいろな種類の食品をバランスよく食べるようにしましょう！"+extraState;

          if (food_grp !="") {
            statement1 = "今回、【"+food_grp+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (mainchai < 3 & milk < 3 & fruit < 3 & t_sport != null & f_sport !=null & mainfood > 3 & sideDish > 3) {
          statement = attach+"主菜、牛乳・乳製品、果物がたりていないようです。部活動やクラブチームの練習・試合で常にいいプレーができるように、いろいろな種類の食品をバランスよく食べるようにしましょう！かんづめのフルーツをヨーグルトに入れて、フルーツヨーグルトにするとおいしいですよ。おやつや朝ごはんのときに作ってみましょう。"+extraState;

          if (food_grp35 !="") {
            statement1 = "今回、【"+food_grp35+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (sideDish < 3 & milk < 3 & fruit < 3 & mainfood > 3 & mainchai > 3) {
          statement = attach+"副菜、牛乳・乳製品、果物がたりていないようです。これらの食品には、体の調子をととのえてくれる「ビタミン」・「ミネラル」・「食物せんい」が多くふくまれています。体がつかれているときや、かぜをひきそうなときは、とくにしっかりとるようにしましょう！"+extraState;

          if (food_grp36 !="") {
            statement1 = "今回、【"+food_grp36+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (mainfood < 3 & mainchai < 3 & t_sport != null & f_sport !=null & sideDish > 3 & milk > 3 & fruit > 3) {
          statement = attach+"これからもっと背をのばして、体を大きくするためには、主食や主菜をもう少ししっかり食べるようにしましょう。とくに、ごはん、パン、めん類などの主食は、しっかり食べていないと、部活動・クラブチームでの練習や試合ですぐにバテたり、すばやい判断ができなくなったりします。鮭おにぎりやハムサンド、納豆ごはんなどは、主食と主菜を一緒にとることができるので、お腹がすいたときにおすすめです。"+extraState;
          commentTag.html(statement);
       }

       if (mainchai < 3 & sideDish < 3 & mainfood > 3 & milk > 3 & fruit > 3) {
          statement = attach+"主菜と副菜がたりていないようです。ごはんだけでなく、おかずもしっかり食べるようにしましょう。カレーや肉じゃがなどは、主菜と副菜が両方入っています。おうちの人に作ってもらうようにお願いしてみましょう。"+extraState;

          if (food_grp !="") {
            statement1 = "今回、【"+food_grp+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }

       }

       if (sideDish < 3 & milk < 3 & mainchai > 3 & mainfood > 3 & fruit > 3) {
          statement = attach+"副菜と牛乳・乳製品がたりていないようです。これらには、体の調子をととのえる栄養素が多く入っています。しっかりとれていないと、体調をくずしやすくなったり、ケガがなおりにくくなったりするので、気をつけましょう！クリームシチューやきのこのグラタンなどは、副菜と牛乳・乳製品を一緒にとることができます。お家の人に作ってもらうようにお願いしてみましょう。"+extraState;

          if (food_grp36 !="") {
            statement1 = "今回、【"+food_grp36+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (milk < 3 & fruit < 3 & sideDish > 3 & mainchai > 3 & mainfood > 3) {
          statement = attach+"牛乳・乳製品と果物がたりていないようです。これらの食品には、体をつくったり、体の調子をととのえるのに必要な栄養素が多くふくまれています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりするので、気をつけましょう！かんづめのフルーツをヨーグルトに入れて、フルーツヨーグルトにするとおいしいですよ。おやつや朝ごはんのときに作ってみましょう。"+extraState;
          commentTag.html(statement);
       }

       if (sideDish < 3 & fruit < 3 & mainchai > 3 & mainfood > 3 & milk > 3)  {
          statement = attach+"副菜と果物がたりていないようです。副菜と果物には、体の調子をととのえてくれる「ビタミン」や「食物せんい」が多く入っています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりします。"+extraState;

          if (food_grp36 !="") {
            statement1 = "今回、【"+food_grp36+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (mainchai < 3 & milk < 3 & sideDish > 3 & fruit > 3 & mainfood > 3) {
          statement = attach+"主菜と牛乳・乳製品がたりていないようです。主菜と牛乳・乳製品には、筋肉や骨などをつくるもとが多く入っていて、体をじょうぶにしてくれます。しっかりとれていないとめまいがしたり、ケガがなおりにくくなったりします。クリームシチューやシーフードグラタンなどは、この2つを一緒にとることができるので、お家の人に作ってもらうようお願いしてみましょう。"+extraState;

          if (food_grp35 !="") {
            statement1 = "今回、【"+food_grp35+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (mainfood < 3 & mainchai < 3 & sideDish > 3 & milk > 3 & fruit > 3) {
          statement = attach+"これからもっと背をのばして、体を大きくするためには、主食や主菜をもう少ししっかり食べるようにしましょう。とくに、ごはん、パン、めん類などの主食は、しっかり食べていないと、部活動・クラブチームでの練習や試合ですぐにバテたり、すばやい判断ができなくなったりします。鮭おにぎりやハムサンド、納豆ごはんなどは、主食と主菜を一緒にとることができるので、お腹がすいたときにおすすめです。"+extraState;

          if (food_grp35 !="") {
            statement1 = "今回、【"+food_grp35+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (mainfood < 3 & sideDish < 3 & f_sport != null & t_sport !=null  & mainchai > 3 & milk > 3 & fruit > 3) {
          statement = attach+"主食や副菜がたりていないようです。とくに、主食がたりていないと、部活動やクラブチームでの練習・試合で、すぐにバテたり、すばやい判断ができなくなったりします。わかめごはん、野菜サンド、きのこスパゲッティなどは、主食と副菜が一緒にとれます。お家の人に作ってもらうようにお願いしてみましょう。"+extraState;
          commentTag.html(statement);
       }

       if (mainfood < 3 & f_sport != null & t_sport !=null & mainchai > 3 & sideDish > 3 & milk > 3 & fruit > 3) {
          statement = attach+"主食が足りていないようです。ごはん・パン・めん類などは、頭をはたらかせたり、体を動かしたりするためのエネルギーになります。主食がたりていないと、部活動やクラブチームでの練習・試合で、すぐにバテたり、すばやい判断ができなくなったりします。食欲がないときは、食べやすいうどんやそうめんなどのめん類にしてもらうようにお家の人にお願いしてみましょう。"+extraState;
          commentTag.html(statement);
       }

       if (mainchai < 3 & f_sport != null & t_sport !=null & mainfood > 3 & sideDish > 3 & milk > 3 & fruit > 3) {
          statement = attach+"主菜は、筋肉や骨・皮ふ・かみの毛など体の多くの部分をつくる材料になるので、体を大きくするために必要な食品です。しっかりとれていないと、ひん血になったり、ケガがなおりにくくなったりします。家や学校で出る食事は残さず食べるようにしましょう。"+extraState;
          if (food_grp35 !="") {
            statement1 = "今回、【"+food_grp35+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (sideDish < 3 & mainfood > 3 & mainchai > 3 & milk > 3 & fruit > 3) {
          statement = attach+"副菜は、体の調子をととのえてくれる「ビタミン」や「ミネラル」、「食物せんい」が多くふくまれています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりするので、気をつけましょう！"+extraState;

          if (food_grp36 !="") {
            statement1 = "今回、【"+food_grp36+"】があまりとれていなかったので、もっとしっかり食べるようにしましょう！"+statement;
            commentTag.html(statement1);
          }
          else {
            commentTag.html(statement);
          }
       }

       if (milk < 3 & mainfood > 3 & mainchai > 3 & sideDish > 3 & fruit > 3) {
          statement = attach+"牛乳・乳製品には、骨や筋肉の材料となる「タンパク質」や骨を強くする「カルシウム」が多くふくまれています。もっと背をのばして、体を大きくするために必要な食品なので、もう少ししっかり食べるようにしましょう！牛乳が飲めない人や苦手な人は、骨まで食べられる魚や緑のこい葉やさい（ほうれんそうなど）をできるだけ多く食べるようにしましょう。"+extraState;
          commentTag.html(statement);
       }

       if (fruit < 3 & f_sport != null & t_sport !=null & mainfood > 3 & mainchai > 3 & sideDish > 3 & milk > 3) {
          statement = attach+"果物は、体の調子をととのえてくれるビタミンが多くふくまれています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりします。部活動やクラブチームの練習で体がつかれているときは、特にしっかりとるようにしましょう！ジュースを飲むときは、100パーセントのフルーツジュースを飲むようにしましょう。"+extraState;
          commentTag.html(statement);
       }

       if (protein >= 4.0 & fastfood >=1 & friedfood >= 1 & sweetCake & highValue.length > 3) {
          statement = "【ファーストフード・あげもの・あまいおかし】はとりすぎないように気をつけましょう！"+extraState;
          commentTag.html(statement);
       }


   }
</script>

<input id="userid" type="hidden" value="@isset($userid){{$userid}}@endisset">
<img src="{{ asset('images/r-bg.png') }}" alt="" style="display: none;" id="i_diaImg">

<!--begin::Container-->
<div class="container">
   <!--begin::Dashboard-->
   <!--begin::Row-->
   <div class="row">
      <div class="col-xl-12">
         <!--begin::Tiles Widget 1-->
         <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
               <div class="card-title">
               </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->

            <div>
               <div id="board" class="col-lg-12 col-md-12 content-item content-item-1 background border-radius20">
                  <div>
                     <center>
                        <p id="board" class="page-content-title">食生活バランスチェック結果</p>
                     </center>
                  </div>
                  <div style="margin-top: 10px;">
                     <table border="1" width="100%" style="text-align:center;">
                        <tbody>
                           <tr height="24px">
                              <td widtd="14%">所属</td>
                              <td widtd="14%">氏名</td>
                              <td widtd="14%">身長(cm)</td>
                              <td widtd="14%">体重(kg)</td>
                              <td widtd="14%">体脂肪率(%)</td>
                              <td widtd="14%">筋肉量(kg)</td>
                              <td widtd="*">チェック記入</td>
                           </tr>
                        </tbody>
                        <tbody>
                           <tr>
                              <td id="p_group"></td>
                              <td id="p_name"></td>
                              <td id="p_height"></td>
                              <td id="p_weight"></td>
                              <td id="p_fat"></td>
                              <td id="p_muscle"></td>
                              <td id="p_date"></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div style="margin-top: 10px;margin-bottom: 100px;">
                     <p class="s-title">①5つの食品のグループをどのくらい食べているのかな?</p>
                  </div>
                    <div>
                        <img class="notic-table-img" src="{{ asset('images/img-1.png') }}" alt="notic-table">
                        <div class="main-chai">
                            <img src="{{ asset('images/img-2.png') }}" alt="mainchai">
                        </div>
                        <div class="side-chai">
                            <center>
                            <img class="side-one-chai" src="{{ asset('images/img-3.png') }}" alt="">
                            <canvas id="dietgram"></canvas>
                            <img class="side-one-chai" src="{{ asset('images/img-4.png') }}" alt="">
                            </center>
                        </div>
                    </div>
                     <div>
                        <img class="bottom-chai-left" src="{{ asset('images/img-6.png') }}" alt="">
                        <img class="bottom-chai-right" src="{{ asset('images/img-5.png') }}" alt="">
                     </div>
                     <img src="{{asset('images/stamp.png')}}" alt="ok" id="ok">
                  </div>
                  <div style="margin: 35px 10%;">
                     <p class="s-title">② 食事から栄養素をどのくらいとれているかな?</p>
                  </div>
                  <div style="position: relative; margin-bottom: 30px;">
                     <center>
                         <canvas id="intakegram">
                     </center>
                     <img class="item-1" src="{{ asset('images/items.png') }}" alt="">
                     <!-- <img class="item-2" src="{{ asset('images/img-8.png') }}" alt=""> -->
                  </div>
                  <div style="margin: 10px 10%; ">
                     <div style="margin-top: 10px; background-color: #c9f8f9; padding:15px;" id="comment">
                     </div>
                     <div class="order-list-div">
                        <p class="order-title">チーム順位</p>&nbsp;&nbsp;
                        <div class="order-main">
                           <img src="{{ asset('images/bad.png') }}" alt="bad" class="bad-img">
                           <p id="grad"></p>
                           <img src="{{ asset('images/good.png') }}" alt="" class="good-img">
                        </div>
                     </div>
                  </div>
                  <div>
                     <div style="text-align: right;padding-right: 100px;margin-top: 30px;">
                        <div>
                           @isset($player)
                           <a href="{{url('/viewGraph')}}"><span class="btn btn-primary btn-lg"
                                 style="border-radius: 5px; min-width: 100px">次へ</span></a>
                           @else
                           <a href="{{url('/playerlist')}}"><span class="btn btn-primary btn-lg"
                                 style="border-radius: 5px; min-width: 100px">戻る</span></a>

                           @endisset

                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!--end::Body-->
         </div>
         <!--end::Tiles Widget 1-->
      </div>
   </div>
   <!--end::Row-->
   <!--end::Dashboard-->
</div>
<!--end::Container-->

@stop

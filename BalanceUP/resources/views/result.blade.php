@extends('app')
@section('title', '結果ページ')
@section('content')

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
   var nutritionScores;
   var foodInput;
   var five_two_player;
   var playerName;

   $(document).ready(function () {
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      let useridinput = document.getElementById("userid")
      let userid = useridinput.value;

      $.get("{{url('/get-nutrition-score')}}", { userid: userid }, function sucess(result) {

         nutritionScores = JSON.parse(result)['nutritionScore'];
         foodInput = JSON.parse(result)['foodInput'][0];
         five_two_player = JSON.parse(result)['five_two'][0];
         playerName = JSON.parse(result)['userName'][0];
         let order = JSON.parse(result)['grade'];
         let s_num = JSON.parse(result)['count'];

         order = parseInt(order);
         s_num = parseInt(s_num);

         let posit = (order - 1)/(s_num - 1) * 100
         if (posit == 0) {
            posit = 2;
         }
         if (posit == 100) {
            posit = 98;
         }
         $("#grad").css("right", posit + "%");

         if(order != 0 && s_num != 0){
            $("#grade").html(order);
            $("#count").html(s_num);
         }
         else if(order == 0 && s_num == 0){
            $("#grade-top").html("チームに所属していないので順位を出すことができません");
         }
         else if(order == 0 && s_num != 0){
            $("#grade-top").html("結果がないので順位を出すことができません");
            
         }

         drawAttribute();
         drawDietgram();
         intakeSourcegram();
         writeComment();
      });
   });

   $(window).resize(function () {
      drawDietgram();
      intakeSourcegram()
   });

   function drawAttribute() {
      $("#p_name").html(playerName['name']);
      $("#p_group").html(playerName['sport']);
      $("#p_team").html(playerName['team']);
      $("#p_height").html(five_two_player['height']);
      $("#p_weight").html(five_two_player['weight']);
      $("#p_fat").html(five_two_player['fat']);
      $("#p_muscle").html(five_two_player['muscle']);
      $("#p_date").html(five_two_player['registered_date']);
   }

   function drawDietgram() {
      let w = $('#board').width() * 0.5;
      let h = $('#board').width() * 0.5;
      let text = ['', '', '', '', ''];
      let texten = ['main_meal', 'main_dish', 'side_dish', 'milk', 'fruit'];
      let c = document.getElementById("dietgram");
      c.width = w;
      c.height = h;

      let r = h * 1 / 2;
      let ctx = c.getContext("2d");
      let x0 = w / 2;
      let y0 = h / 2 - r;
      let pi = 3.1415926535;

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

      ctx.fillStyle = "#D0E9D5";
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

      if(nutritionScores.length == 1){
         x0 = w / 2;
         y0 = h / 2 - r * nutritionScores[0]['main_meal'] / 4.5;
         ctx.beginPath();
         ctx.setLineDash([1, 0]);
         ctx.lineWidth = 5.0;
         ctx.strokeStyle = "#EB45A2";
         ctx.moveTo(x0, y0);

         for (i = 1; i < 5; i++) {
            x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * nutritionScores[0][texten[i]] / 4.5;
            y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * nutritionScores[0][texten[i]] / 4.5;
            ctx.lineTo(x, y);
         }

         ctx.closePath();
         ctx.stroke();
      }
      else if(nutritionScores.length == 2){
         x0 = w / 2;
         y0 = h / 2 - r * nutritionScores[1]['main_meal'] / 4.5;
         ctx.beginPath();
         ctx.setLineDash([30, 30]);
         ctx.lineWidth = 5.0;
         ctx.strokeStyle = "#595757";
         ctx.moveTo(x0, y0);

         for (i = 1; i < 5; i++) {
            x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * nutritionScores[1][texten[i]] / 4.5;
            y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * nutritionScores[1][texten[i]] / 4.5;
            ctx.lineTo(x, y);
         }

         ctx.closePath();
         ctx.stroke();

         x0 = w / 2;
         y0 = h / 2 - r * nutritionScores[0]['main_meal'] / 4.5;
         ctx.beginPath();
         ctx.setLineDash([1, 0]);
         ctx.lineWidth = 5.0;
         ctx.strokeStyle = "#EB45A2";
         ctx.moveTo(x0, y0);

         for (i = 1; i < 5; i++) {
            x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * nutritionScores[0][texten[i]] / 4.5;
            y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * nutritionScores[0][texten[i]] / 4.5;
            ctx.lineTo(x, y);
         }

         ctx.closePath();
         ctx.stroke();

      }

      else if(nutritionScores.length == 3){
         x0 = w / 2;
         y0 = h / 2 - r * nutritionScores[2]['main_meal'] / 4.5;
         ctx.beginPath();
         ctx.setLineDash([5, 5]);
         ctx.lineWidth = 5.0;
         ctx.strokeStyle = "#B0B4B7";
         ctx.moveTo(x0, y0);

         for (i = 1; i < 5; i++) {
            x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * nutritionScores[2][texten[i]] / 4.5;
            y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * nutritionScores[2][texten[i]] / 4.5;
            ctx.lineTo(x, y);
         }

         ctx.closePath();
         ctx.stroke();

         x0 = w / 2;
         y0 = h / 2 - r * nutritionScores[1]['main_meal'] / 4.5;
         ctx.beginPath();
         ctx.setLineDash([30, 30]);
         ctx.lineWidth = 5.0;
         ctx.strokeStyle = "#595757";
         ctx.moveTo(x0, y0);

         for (i = 1; i < 5; i++) {
            x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * nutritionScores[1][texten[i]] / 4.5;
            y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * nutritionScores[1][texten[i]] / 4.5;
            ctx.lineTo(x, y);
         }

         ctx.closePath();
         ctx.stroke();

         x0 = w / 2;
         y0 = h / 2 - r * nutritionScores[0]['main_meal'] / 4.5;
         ctx.beginPath();
         ctx.setLineDash([1,0]);
         ctx.lineWidth = 5.0;
         ctx.strokeStyle = "#EB45A2";
         ctx.moveTo(x0, y0);

         for (i = 1; i < 5; i++) {
            x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2) * r * nutritionScores[0][texten[i]] / 4.5;
            y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * nutritionScores[0][texten[i]] / 4.5;
            ctx.lineTo(x, y);
         }

         ctx.closePath();
         ctx.stroke();
      }
      
      if (nutritionScores[0]['main_meal'] >= 3 && nutritionScores[0]['main_dish'] >= 3 && nutritionScores[0]['side_dish'] >= 3 && nutritionScores[0]['milk'] >= 3 && nutritionScores[0]['fruit'] >= 3) {
         $("#ok").show();
      }

   }


   function intakeSourcegram() {
      let w = $('#board').width();
      let h = w / 2;

      let textjp = ['エネルギー', ' タンパク質', '  脂質', 'ビタミン', 'ミネラル', '食物繊維'];
      let texten = ['energy', 'protein', 'fat', 'vitamin', 'mineral', 'fiber'];
      let calcData = Array(6);
      for (i = 0; i < 6; i++) {
         calcData[i] = nutritionScores[0][texten[i]]
      }
      let items = new Image();
      let c = document.getElementById("intakegram");
      c.width = w;
      c.height = h;
      let r = 200;
      let ctx = c.getContext("2d");
      let img = document.getElementById("i_diaImg");
      //   ctx.drawImage(img,20,-20);
      let pat = ctx.createPattern(img, 'repeat');
      let x0 = w / 2;
      let y0 = h / 2;

      let drectw = w;
      let drecth = drectw / 2;
      ctx.fillStyle = pat;
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2, drectw, drecth / 12);
      ctx.fillStyle = "BlanchedAlmond";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth / 12, drectw, drecth / 6);
      ctx.fillStyle = "PaleTurquoise";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth / 4, drectw, drecth / 8);
      ctx.fillStyle = "LightSkyBlue";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth * 3 / 8, drectw, drecth / 6);

      ctx.beginPath();
      ctx.moveTo(x0 - drectw / 2 + (drectw / 7), y0 - drecth / 2);
      ctx.lineTo(x0 - drectw / 2 + (drectw / 7), h);
      ctx.stroke();

      ctx.beginPath();
      ctx.moveTo(x0 - drectw / 2, y0 + drecth / 4);
      ctx.lineTo(w, y0 + drecth / 4);
      ctx.stroke();

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("とりすぎ!", (x0 - drectw / 2 + (drectw / 7)) / 6, y0 - drecth / 2 + drecth / 24);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("しっかり", (x0 - drectw / 2 + (drectw / 7)) / 6, y0 - drecth / 2 + drecth / 12 + drecth / 12);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("とれています", (x0 - drectw / 2 + (0.6 * drectw / 7)) / 6, y0 - drecth / 2 + drecth / 12 + drecth * 1.5 / 12);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("すこし", (x0 - drectw / 2 + (drectw / 7)) / 6, y0 - drecth / 2 + drecth / 4 + drecth / 16);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("たりていません", (x0 - drectw / 2 + (0.2 * drectw / 7)) / 6, y0 - drecth / 2 + drecth / 4 + drecth * 1.8 / 16);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("たりていません", (x0 - drectw / 2 + (0.2 * drectw / 7)) / 6, y0 - drecth / 2 + drecth * 3 / 8 + drecth / 12);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("ちゅうい!", (x0 - drectw / 2 + (drectw / 7)) / 6, y0 - drecth / 2 + drecth * 3 / 8 + drecth * 1.6 / 12);

      ctx.fillStyle = "black";
      ctx.font = drecth / 35 + "px Arial";
      ctx.fillText("えいようそ", (x0 - drectw / 2 + (drectw / 7)) / 6, y0 + 0.8 * drecth / 6);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("栄養素", (x0 - drectw / 2 + (1.3 * drectw / 7)) / 6, y0 + 1.3 * drecth / 6);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("この栄養素を", (x0 - drectw / 2 + (0.8 * drectw / 7)) / 6, y0 + drecth / 4 + drecth / 10);

      ctx.fillStyle = "black";
      ctx.font = drecth / 30 + "px Arial";
      ctx.fillText("ふくむおもな食品", (x0 - drectw / 2 + (0.2 * drectw / 7)) / 6, y0 + drecth / 4 + drecth * 1.5 / 10);

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

      items.src = "{{asset('images/items.png')}}";
      items.onload = () => {
         ctx.drawImage(items,0.16 * w,0.76 * h, 0.77 * w , 0.77 / 8 * w);
      };
   }

   function writeComment() {
      let neverFood34 = new Array();
      let neverFood35 = new Array();
      let neverFood36 = new Array();

      let mainMeal = nutritionScores[0]['main_meal'];
      let mainDish = nutritionScores[0]['main_dish'];
      let sideDish = nutritionScores[0]['side_dish'];
      let milk = nutritionScores[0]['milk'];
      let fruit = nutritionScores[0]['fruit'];
      let protein = nutritionScores[0]['protein'];

      let meat = foodInput['meat'];
      let seafood = foodInput['seafood'];
      let egg = foodInput['egg'];
      let bean = foodInput['bean'];

      let LCvegetable = foodInput['LCvagetable'];
      let GYvegetable = foodInput['GYvegetable'];
      let mushroom = foodInput['mashroom'];
      let seaweed = foodInput['seaweed'];
      let potato = foodInput['potato'];

      let fastFood = foodInput['fast_food'];
      let friedFood = foodInput['fried_food'];
      let sweetFrequency = foodInput['sweet_frequency'];

      let commentTag = $("#comment");
      let statement = "";
      let attach = "";

      let f_sport = five_two_player['practice_frequency'];
      let t_sport = five_two_player['practice_time'];

      if (meat == 1) {
         neverFood34.push('肉');
         neverFood35.push('肉');
      }
      if (seafood == 1) {
         neverFood34.push('魚介類');
         neverFood35.push('魚介類');
      }
      if (egg == 1) {
         neverFood34.push('卵');
         neverFood35.push('卵');
      }
      if (bean == 1) {
         neverFood34.push('豆類');
         neverFood35.push('豆類');
      }
      if (LCvegetable == 1) {
         neverFood34.push('淡色野菜');
         neverFood36.push('淡色野菜');
      }
      if (GYvegetable == 1) {
         neverFood34.push('緑黄色野菜');
         neverFood36.push('緑黄色野菜');
      }
      if (mushroom == 1) {
         neverFood34.push('きのこ類');
         neverFood36.push('きのこ類');
      }
      if (seaweed == 1) {
         neverFood34.push('海そう類');
         neverFood36.push('海そう類');
      }
      if (potato == 1) {
         neverFood34.push('いも類');
         neverFood36.push('いも類');
      }
      var foodGrp34 = "";
      var foodGrp35 = "";
      var foodGrp36 = "";

      if (neverFood34.length > 0) {
         for (var i = 0; i < neverFood34.length; i++) {
            foodGrp34 += neverFood34[i] + "、";
         }
      }
      if (neverFood35.length > 0) {
         for (var i = 0; i < neverFood35.length; i++) {
            foodGrp35 += neverFood35[i] + "、";
         }
      }
      if (neverFood36.length > 0) {
         for (var i = 0; i < neverFood36.length; i++) {
            foodGrp36 += neverFood36[i] + "、";
         }
      }

      let highValue = []
      if (mainMeal >= 3) {
         highValue.push("主食");
      }
      if (mainDish >= 3) {
         highValue.push("主菜");
      }
      if (sideDish >= 3) {
         highValue.push("副菜");
      }
      if (milk >= 3) {
         highValue.push("牛乳・乳製品");
      }
      if (fruit >= 3) {
         highValue.push("果物");
      }
      if (highValue.length > 0) {
         let sub_text = "";
         for (let index = 0; index < highValue.length; index++) {
            if (index != 0) {
               sub_text += "、"
            }
            sub_text += highValue[index];
         }
         attach = sub_text + "はしっかりとれています！！ ";
      }

      // end for 34 pattern
      if (mainMeal == -1 | mainDish == -1 | sideDish == -1 | milk == -1 | fruit == -1) {
         statement = "【料理区分】については、記入できていないところがあったので、結果が正しく表示できていません。";
         commentTag.html(statement);
      }

      if (mainMeal >= 3 & mainDish >= 3 & sideDish >= 3 & milk >= 3 & fruit >= 3) {
         statement = "５つの食品のグループが全部しっかりとれています！すばらしい！！この調子で栄養バランスのとれた食事を続けましょう！";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & sideDish < 3 & milk < 3 & fruit < 3) {
         statement = "どの食品のグループもたりていません。毎日元気にすごすために、朝・昼・夜の3食をしっかり食べるようにしましょう！家で出るごはんや給食は、残さず食べるようにしましょう。残さず食べると、ごはんを作ってくれている人はとてもうれしいですよ。";
         commentTag.html(statement);
      }


      if (mainDish < 3 & sideDish < 3 & milk < 3 & fruit < 3 & mainMeal >= 3) {
         statement = attach + "主食以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループをどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。";
         commentTag.html(statement);
      }
      // condition 7
      if (mainMeal < 3 & sideDish < 3 & milk < 3 & fruit < 3 & mainDish >= 3) {
         statement = attach + "主菜以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループをどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & milk < 3 & fruit < 3 & sideDish >= 3) {
         statement = attach + "副菜以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループがどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & sideDish < 3 & fruit < 3 & milk >= 3) {
         statement = attach + "牛乳・乳製品以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループがどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & sideDish < 3 & milk < 3 & fruit >= 3) {
         statement = attach + "果物以外は、たりていないようです。毎日元気にすごすために、5つの食品のグループがどれもしっかり食べるようにしましょう！家や学校で出る食事は、残さず食べるようにしましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & sideDish < 3 & t_sport != null & f_sport != null & milk >= 3 & fruit >= 3) {
         statement = attach + "これからもっと背をのばして、体を大きくするためには、主食・主菜・副菜がたりていません。スポーツ・運動をしている人は、この3つをしっかりとっていないと、ケガをしやすくなったり、練習ですぐにバテたりします。カレーライスやサンドイッチなどは、この3つが一緒にとれるので、おうちの人に作ってもらうようにお願いしてみましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & sideDish < 3 & milk < 3 & t_sport != null & f_sport != null & mainDish >= 3 & fruit >= 3) {
         statement = attach + "主食、副菜、牛乳・乳製品がたりていないようです。これらの食品がたりていないと、部活動やクラブチームでの練習や試合ですぐにバテたり、ケガをしやすくなったりします。朝・昼・夜の3食を残さずしっかり食べるようにしましょう！牛乳が飲めない人や苦手な人は、骨まで食べられる魚や緑のこい葉やさい（ほうれんそうなど）をできるだけ多く食べるようにしましょう。";
         commentTag.html(statement);
      }


      if (mainMeal < 3 & milk < 3 & fruit < 3 & t_sport != null & f_sport != null & mainDish >= 3 & sideDish >= 3) {
         statement = attach + "主食、牛乳・乳製品、果物がたりていないようです。これらの食品がたりていないと、部活動やクラブチームでの練習や試合ですぐにバテたり、すばやい判断ができなくなったりします。朝・昼・夜の3食を残さずしっかり食べるようにしましょう！かんづめのフルーツをヨーグルトに入れて、フルーツヨーグルトにするとおいしいですよ。おやつや朝ごはんのときに作ってみましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & milk < 3 & t_sport != null & f_sport != null & sideDish >= 3 & fruit >= 3) {
         statement = attach + "主食、主菜、牛乳・乳製品がたりていないようです。これらの食品が足りていないと、部活動・クラブチームでの練習や試合で、すぐにバテたり、すばやい判断ができなくなったりします。朝・昼・夜のごはんを残さずしっかり食べるようにしましょう！牛乳が苦手な人は、ココアやジャムなどをまぜて飲むようにしましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & mainDish < 3 & fruit < 3 & t_sport != null & f_sport != null & sideDish >= 3 & milk >= 3) {
         statement = attach + "主食、主菜、果物がたりていないようです。これらの食品を、しっかり食べていないと、部活動やクラブチームの練習・試合で、すぐにバテたり、ケガをしやすくなったりします。ジュースを飲むときは、100パーセントのフルーツジュースを飲むようにしましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & sideDish < 3 & fruit < 3 & t_sport != null & f_sport != null & milk >= 3 & mainDish >= 3) {
         statement = attach + "主食、副菜、果物がたりていないようです。これらをしっかり食べていないと、部活動やクラブチームの練習・試合で、すぐにバテたり、ケガをしやすくなったりします。わかめごはん、野菜サンド、きのこスパゲッティなどは、主食と副菜がいっしょにとれます。おうちの人に作ってもらうようにお願いしてみましょう。";
         commentTag.html(statement);
      }

      if (mainDish < 3 & sideDish < 3 & milk < 3 & t_sport != null & f_sport != null & mainMeal >= 3 & fruit >= 3) {

         statement = attach + "主菜、副菜、牛乳・乳製品がたりていないようです。部活動やクラブチームの練習・試合で常にいいプレーができるように、いろいろな種類の食品をバランスよく食べるようにしましょう！クリームシチューやサンドイッチなどは、この3つが一緒にとれます。おうちの人に作ってもらうようにお願いしてみましょう。";

         if (foodGrp34 != "") {
            statement1 = statement + "今回、" + foodGrp34 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (mainDish < 3 & sideDish < 3 & fruit < 3 & t_sport != null & f_sport != null & mainMeal >= 3 & milk >= 3) {
         statement = attach + "主菜、副菜、果物がたりていないようです。これらをしっかり食べていないと、部活動やクラブチームの練習でつかれやすくなったり、ケガをしやすくなったりします。常にいいプレーができるように、いろいろな種類の食品をバランスよく食べるようにしましょう！";

         if (foodGrp34 != "") {
            statement1 = statement + "今回、" + foodGrp34 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (mainDish < 3 & milk < 3 & fruit < 3 & t_sport != null & f_sport != null & mainMeal >= 3 & sideDish >= 3) {
         statement = attach + "主菜、牛乳・乳製品、果物がたりていないようです。部活動やクラブチームの練習・試合で常にいいプレーができるように、いろいろな種類の食品をバランスよく食べるようにしましょう！かんづめのフルーツをヨーグルトに入れて、フルーツヨーグルトにするとおいしいですよ。おやつや朝ごはんのときに作ってみましょう。";

         if (foodGrp35 != "") {
            statement1 = statement + "今回、" + foodGrp35 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (sideDish < 3 & milk < 3 & fruit < 3 & mainMeal >= 3 & mainDish >= 3) {
         statement = attach + "副菜、牛乳・乳製品、果物がたりていないようです。これらの食品には、体の調子をととのえてくれる「ビタミン」・「ミネラル」・「食物せんい」が多くふくまれています。体がつかれているときや、かぜをひきそうなときは、とくにしっかりとるようにしましょう！";

         if (foodGrp36 != "") {
            statement1 = statement + "今回、" + foodGrp36 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (mainMeal < 3 & mainDish < 3 & t_sport != null & f_sport != null & sideDish >= 3 & milk >= 3 & fruit >= 3) {
         statement = attach + "これからもっと背をのばして、体を大きくするためには、主食や主菜をもう少ししっかり食べるようにしましょう。とくに、ごはん、パン、めん類などの主食は、しっかり食べていないと、部活動・クラブチームでの練習や試合ですぐにバテたり、すばやい判断ができなくなったりします。鮭おにぎりやハムサンド、納豆ごはんなどは、主食と主菜を一緒にとることができるので、お腹がすいたときにおすすめです。";
         commentTag.html(statement);
      }

      if (mainDish < 3 & sideDish < 3 & mainMeal >= 3 & milk >= 3 & fruit >= 3) {
         statement = attach + "主菜と副菜がたりていないようです。ごはんだけでなく、おかずもしっかり食べるようにしましょう。カレーや肉じゃがなどは、主菜と副菜が両方入っています。おうちの人に作ってもらうようにお願いしてみましょう。";

         if (foodGrp34 != "") {
            statement1 = statement + "今回、" + foodGrp34 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }

      }

      if (sideDish < 3 & milk < 3 & mainDish >= 3 & mainMeal >= 3 & fruit >= 3) {
         statement = attach + "副菜と牛乳・乳製品がたりていないようです。これらには、体の調子をととのえる栄養素が多く入っています。しっかりとれていないと、体調をくずしやすくなったり、ケガがなおりにくくなったりするので、気をつけましょう！クリームシチューやきのこのグラタンなどは、副菜と牛乳・乳製品を一緒にとることができます。お家の人に作ってもらうようにお願いしてみましょう。";

         if (foodGrp36 != "") {
            statement1 = statement + "今回、" + foodGrp36 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (milk < 3 & fruit < 3 & sideDish >= 3 & mainDish >= 3 & mainMeal >= 3) {
         statement = attach + "牛乳・乳製品と果物がたりていないようです。これらの食品には、体をつくったり、体の調子をととのえるのに必要な栄養素が多くふくまれています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりするので、気をつけましょう！かんづめのフルーツをヨーグルトに入れて、フルーツヨーグルトにするとおいしいですよ。おやつや朝ごはんのときに作ってみましょう。";
         commentTag.html(statement);
      }

      if (sideDish < 3 & fruit < 3 & mainDish >= 3 & mainMeal >= 3 & milk >= 3) {
         statement = attach + "副菜と果物がたりていないようです。副菜と果物には、体の調子をととのえてくれる「ビタミン」や「食物せんい」が多く入っています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりします。";

         if (foodGrp36 != "") {
            statement1 = statement + "今回、" + foodGrp36 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (mainDish < 3 & milk < 3 & sideDish >= 3 & fruit >= 3 & mainMeal >= 3) {
         statement = attach + "主菜と牛乳・乳製品がたりていないようです。主菜と牛乳・乳製品には、筋肉や骨などをつくるもとが多く入っていて、体をじょうぶにしてくれます。しっかりとれていないとめまいがしたり、ケガがなおりにくくなったりします。クリームシチューやシーフードグラタンなどは、この2つを一緒にとることができるので、お家の人に作ってもらうようお願いしてみましょう。";

         if (foodGrp35 != "") {
            statement1 = statement + "今回、" + foodGrp35 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (mainMeal < 3 & sideDish < 3 & f_sport != null & t_sport != null & mainDish >= 3 & milk >= 3 & fruit >= 3) {
         statement = attach + "主食や副菜がたりていないようです。とくに、主食がたりていないと、部活動やクラブチームでの練習・試合で、すぐにバテたり、すばやい判断ができなくなったりします。わかめごはん、野菜サンド、きのこスパゲッティなどは、主食と副菜が一緒にとれます。お家の人に作ってもらうようにお願いしてみましょう。";
         commentTag.html(statement);
      }
      if (mainDish < 3 & fruit < 3 & t_sport != null & f_sport != null & sideDish >= 3 & milk >= 3 & mainMeal >= 3) {
         statement = attach + "主菜は、筋肉や骨・皮ふ・かみの毛など体の多くの部分をつくる材料になるので、体を大きくするために必要な食品です。しっかりとれていないと、ひん血になったり、ケガがなおりにくくなったりします。家や学校で出る食事は残さず食べるようにしましょう。";
         if (foodGrp35 != "") {
            statement1 = statement + "今回、" + foodGrp35 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }
      if (mainMeal < 3 & fruit < 3 & f_sport != null & t_sport != null & mainDish >= 3 & sideDish >= 3 & milk >= 3) {
         statement = attach + "主食が足りていないようです。ごはん・パン・めん類などは、頭をはたらかせたり、体を動かしたりするためのエネルギーになります。主食がたりていないと、部活動やクラブチームでの練習・試合で、すぐにバテたり、すばやい判断ができなくなったりします。食欲がないときは、食べやすいうどんやそうめんなどのめん類にしてもらうようにお家の人にお願いしてみましょう。";
         commentTag.html(statement);
      }
      if (mainMeal < 3 & milk < 3 & f_sport != null & t_sport != null & mainDish >= 3 & sideDish >= 3 & fruit >= 3) {
         statement = attach + "主食が足りていないようです。ごはん・パン・めん類などは、頭をはたらかせたり、体を動かしたりするためのエネルギーになります。主食がたりていないと、部活動やクラブチームでの練習・試合で、すぐにバテたり、すばやい判断ができなくなったりします。食欲がないときは、食べやすいうどんやそうめんなどのめん類にしてもらうようにお家の人にお願いしてみましょう。";
         commentTag.html(statement);
      }

      if (mainMeal < 3 & f_sport != null & t_sport != null & mainDish >= 3 & sideDish >= 3 & milk >= 3 & fruit >= 3) {
         statement = attach + "主食が足りていないようです。ごはん・パン・めん類などは、頭をはたらかせたり、体を動かしたりするためのエネルギーになります。主食がたりていないと、部活動やクラブチームでの練習・試合で、すぐにバテたり、すばやい判断ができなくなったりします。食欲がないときは、食べやすいうどんやそうめんなどのめん類にしてもらうようにお家の人にお願いしてみましょう。";
         commentTag.html(statement);
      }

      if (mainDish < 3 & f_sport != null & t_sport != null & mainMeal >= 3 & sideDish >= 3 & milk >= 3 & fruit >= 3) {
         statement = attach + "主菜は、筋肉や骨・皮ふ・かみの毛など体の多くの部分をつくる材料になるので、体を大きくするために必要な食品です。しっかりとれていないと、ひん血になったり、ケガがなおりにくくなったりします。家や学校で出る食事は残さず食べるようにしましょう。";
         if (foodGrp35 != "") {
            statement1 = statement + "今回、" + foodGrp35 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (sideDish < 3 & mainMeal >= 3 & mainDish >= 3 & milk >= 3 & fruit >= 3) {
         statement = attach + "副菜は、体の調子をととのえてくれる「ビタミン」や「ミネラル」、「食物せんい」が多くふくまれています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりするので、気をつけましょう！";

         if (foodGrp36 != "") {
            statement1 = statement + "今回、" + foodGrp36 + "があまりとれていなかったので、もっとしっかり食べるようにしましょう！";
            commentTag.html(statement1);
         }
         else {
            commentTag.html(statement);
         }
      }

      if (milk < 3 & mainMeal >= 3 & mainDish >= 3 & sideDish >= 3 & fruit >= 3) {
         statement = attach + "牛乳・乳製品には、骨や筋肉の材料となる「タンパク質」や骨を強くする「カルシウム」が多くふくまれています。もっと背をのばして、体を大きくするために必要な食品なので、もう少ししっかり食べるようにしましょう！牛乳が飲めない人や苦手な人は、骨まで食べられる魚や緑のこい葉やさい（ほうれんそうなど）をできるだけ多く食べるようにしましょう。";
         commentTag.html(statement);
      }

      if (fruit < 3 & f_sport != null & t_sport != null & mainMeal >= 3 & mainDish >= 3 & sideDish >= 3 & milk >= 3) {
         statement = attach + "果物は、体の調子をととのえてくれるビタミンが多くふくまれています。しっかりとれていないと、かぜをひきやすくなったり、つかれやすくなったりします。部活動やクラブチームの練習で体がつかれているときは、特にしっかりとるようにしましょう！ジュースを飲むときは、100パーセントのフルーツジュースを飲むようにしましょう。";
         commentTag.html(statement);
      }

      if (protein >= 5.0 & fastFood >= 3 & friedFood >= 3 & sweetFrequency >= 4) {
         statement = "ファーストフード、あげもの、あまいおかしはとりすぎないように気をつけましょう！";
         commentTag.append(statement);
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
                  <div class="mt-5">
                     <table border="1" width="100%" style="text-align:center;">
                        <tbody>
                           <tr height="24px">
                              <td widtd="14%">所属</td>
                              <td widtd="14%">氏名</td>
                              <td widtd="14%">チーム名</td>
                              <td widtd="14%">身長(cm)</td>
                              <td widtd="14%">体重(kg)</td>
                              <td widtd="14%">体脂肪率(%)</td>
                              <td widtd="14%">筋肉量(kg)</td>
                              <td widtd="*">チェック記入</td>
                        </tbody>
                           <tr>
                              <td id="p_group"></td>
                              <td id="p_name"></td>
                              <td id="p_team"></td>
                              <td id="p_height"></td>
                              <td id="p_weight"></td>
                              <td id="p_fat"></td>
                              <td id="p_muscle"></td>
                              <td id="p_date"></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="mt-5 row">
                     <div class="col-8">
                        <p class="s-title">①5つの食品のグループをどのくらい食べているかな?</p>
                     </div>
                     <div class="col-4">
                        <img class="img-fluid" src="{{ asset('images/img-1.png') }}" alt="notic-table">
                     </div>
                  </div>
                  <div>
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
               </div>
               <div style="margin: 10px 10%; ">
                  <div style="margin-top: 10px; background-color: #c9f8f9; padding:15px;" id="comment">
                  </div>
                  <div class="mt-10">
                     <p class="s-title">チーム内順位 
                        <span id="grade-top" class="ml-5">
                           <span class="ml-5" id="grade"></span>位
                           /
                           <span id="count"></span>人中
                        </span>
                     </p>
                     <div class="order-main mt-5">
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
                        <a href="{{url('/view-body-graph')}}"><span class="btn btn-primary btn-lg"
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
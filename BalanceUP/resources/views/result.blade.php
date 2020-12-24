@extends('app')
@section('title', '先頭ページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
   var values;
   $(document).ready(function(){
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      var useridinput = document.getElementById("userid")
      var userid = useridinput.value;
      $.get("{{url('/getDiet')}}", {userid:userid},function sucess(result){
         
         values = JSON.parse(result)['data'][0];
         grade = JSON.parse(result)['grade'];
         var g = ""+ grade;
         var c = document.getElementById("grad");
         c.innerHTML = g;
         intakeSourcegram();
         drawDietgram();

      });
      
      
      
   });
   $(window).resize(function(){
      drawDietgram();
      intakeSourcegram()
   });

   function drawDietgram(){
      var w = $('#board').width() * 0.5;
      var h = $('#board').width() * 0.5;
      var text = ['主食','主菜','副菜','牛乳・乳製品','果物'];
      var texten = ['stapleFood', 'mainDish', 'sideDish', 'milk', 'fruit'];
      var c = document.getElementById("dietgram");
      c.width = w;
      c.height = h;

      var r = h * 0.8 / 2;
      var ctx = c.getContext("2d");
      var x0 = w/2;
      var y0 = h/2 - r;
      var pi = 3.1415926535;
      
      ctx.beginPath();
      ctx.moveTo(x0,y0);
      ctx.font = "15px Arial";
      ctx.fillText(text[0],x0,y0-20);
      for(i = 1;i < 5; i++)
      {
         xh = w/2 + Math.cos(2 * pi/ 5 * i - pi / 2 ) * (r + 20);
         yh = h/2 + Math.sin(2 * pi / 5 * i - pi / 2) * (r + 20);
      
         x = w/2 + Math.cos(2 * pi/ 5 * i - pi / 2 ) * r;
         y = h/2 + Math.sin(2 * pi / 5 * i - pi / 2) * r;
         ctx.fillText(text[i],xh,yh);
         ctx.lineTo(x,y);
      }
      ctx.fillStyle = "DarkSalmon";
      ctx.fill();
      ctx.closePath();
      
      x0 = w/2;
      y0 = h/2 - (r - r / 3);
      ctx.beginPath();
      ctx.moveTo(x0,y0);
      for(i = 1;i < 5; i++)
      {
         x = w / 2 + Math.cos(2 * pi / 5 * i - pi / 2 ) * (r - r / 3);
         y = h / 2 + Math.sin(2 * pi / 5 * i - pi / 2) * (r - r / 3);
         ctx.lineTo(x,y);
      }
      
      ctx.fillStyle = "LightBlue";
      ctx.fill();
      ctx.closePath();
      
      x0 = w / 2;
      y0 = h / 2 -r / 3;
      ctx.beginPath();
      ctx.moveTo(x0,y0);
      for(i = 1;i < 5; i++)
      {
         x = w/2 + Math.cos(2 * pi/ 5 * i - pi / 2 ) * r / 3;
         y = h/2 + Math.sin(2 * pi / 5 * i - pi / 2) * r / 3;
         ctx.lineTo(x,y);
      }
      
      ctx.fillStyle = "LightSkyBlue";
      ctx.fill();
      ctx.closePath();
      
      x0 = w/2;
      y0 = h/2 - r * values['stapleFood'] / 4.5;
      ctx.beginPath();
      ctx.moveTo(x0,y0);
      
      for(i = 1; i < 5; i++)
      {
         x = w/2 + Math.cos(2 * pi/ 5 * i - pi / 2 ) * r * values[texten[i]] / 4.5;
         y = h/2 + Math.sin(2 * pi / 5 * i - pi / 2) * r * values[texten[i]] / 4.5;
         ctx.lineTo(x,y);
      }
      
      ctx.closePath();
      ctx.stroke();
      
   }


   function intakeSourcegram(){

      var w = $('#board').width();
      var h = w / 2;

      var textjp = ['エネルギー', 'タンパク質', '脂質', 'ビタミン', 'ミネラル', '食物繊維'];
      var texten = ['energy', 'protein', 'lipid', 'vitamin', 'mineral', 'fiber'];
      
      
      var meat = [0,1,3.5,7];
      var seafood = [0,1,3.5,7];
      var eggs = [0,1,3.5,7];
      var beans = [0,1,3.5,7];
      var LCvegetables = [0,1,2,3];
      var GYvegetables = [0,1,1,3];
      var mushrooms = [0,1.5,3,3];
      var seaweeds = [0,1.5,3,3];
      var potatoes = [0,1.5,3,3];
      var friedFood = [3,3,4.5,6];
      var sweets = [0,1.5,3,3];
      var meatforLipid = [3,3,3,6];
      var calcData= new Array();
      calcData[0] = values['stapleFood'];
      calcData[1] = values['mainDish'] * (meat[values['meat'] * 2] + seafood[values['seafood'] * 2] + eggs[values['eggs'] * 2] + beans[values['beans'] * 2])/21;
      calcData[2] = (meatforLipid[values['meat'] * 2] + friedFood[values['friedFood'] * 2] + sweets[values['sweets'] * 2])/3;
      calcData[3] = (LCvegetables[values['LCvegetables'] * 2] + GYvegetables[values['GYvegetables'] * 2] + mushrooms[values['mushrooms'] * 2] + seaweeds[values['seaweeds'] * 2] + potatoes[values['potatoes'] * 2] + values['fruit']) / 6;
      calcData[4] = (LCvegetables[values['LCvegetables'] * 2] + GYvegetables[values['GYvegetables'] * 2] + mushrooms[values['mushrooms'] * 2] + seaweeds[values['seaweeds'] * 2] + potatoes[values['potatoes'] * 2] + values['milk']) / 6;
      calcData[5] = (LCvegetables[values['LCvegetables'] * 2] + GYvegetables[values['GYvegetables'] * 2] + mushrooms[values['mushrooms'] * 2] + seaweeds[values['seaweeds'] * 2] + potatoes[values['potatoes'] * 2]) / 5;
         
      var c = document.getElementById("intakegram");
      c.width = w;
      c.height = h;
      var r = 200;
      var ctx = c.getContext("2d");
      var x0 = w/2;
      var y0 = h/2;

      var drectw = w * 0.6;
      var drecth = drectw / 2;
      ctx.fillStyle = "DarkSalmon";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2, drectw, drecth / 4);
      ctx.fillStyle = "LightSkyBlue";
      ctx.fillRect(x0 - drectw / 2, y0 - drecth / 2 + drecth / 4, drectw, drecth / 4 );

      for(i = 1; i < 7; i++){
         ctx.fillStyle ="black";
         ctx.font = drecth / 20 + "px Arial";
         ctx.fillText(textjp[i-1],x0 - drectw / 2 + i * (drectw / 7),y0 + drecth / 4);
         ctx.fillStyle = "red";
         ctx.beginPath();
         
         ctx.arc(x0 - drectw / 2 + i * (drectw / 7),y0 - (drecth / 2 / 6) * calcData[i - 1], drecth / 30 > 5 ? 5 : drecth / 30 ,0,2*Math.PI);
         ctx.fill();
         ctx.closePath();
      }
   }
</script>

<input id="userid" type="hidden" value="@isset($userid){{$userid}}@endisset">

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
               <div id = "board" class="col-lg-12 col-md-12 content-item content-item-1 background border-radius20" style="padding: 35px 130px;">
                  <div>
                     <center><p id = "board" class="lable-p" style="font-size: 20px;">食生活バランスチェック結果</p></center>
                  </div>
                  <div style="margin-top: 10px;">
                     <table border="1">
                        <tbody>
                           <tr>
                              <td widtd="14%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                              <td widtd="14%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                              <td widtd="14%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                              <td widtd="14%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                              <td widtd="14%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                              <td widtd="14%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                              <td widtd="*">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                           </tr>
                        </tbody>
                        <tbody>
                           <tr>
                              <td>&nbsp</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div style="margin-top: 5px;">
                     <p>①5つの食品のグループをどのくらい食べているのかな?</p>
                  </div>
                  <div style="position: relative;">
                     <center><canvas id="dietgram"></center>
                  </div>
                  <div style="margin-top: 35px;">
                     <p>② 食事から栄養素をどのくらいとれているかな?</p>
                  </div>
                  <div style="position: relative;">
                     <center><canvas id="intakegram"></center>
                  </div>
                  <div style="margin-top: 7px;">
                     <div style="margin-top: 10px; background-color: orange;">
                        アドバイス
                     </div>
                     <div style="display: flex; margin-top: 20px">
                        <p style="width: 20%">チーム順位</p>&nbsp;&nbsp;
                        <div style="height: 30px;background-color: green;margin-right: 0px;width: 80%;">
                           <p id="grad" style="text-align:center;color:red;  font-size:20px"></p>
                        </div>
                     </div>
                  </div>
                  <div>
                  <div style="text-align: right;padding-right: 100px;margin-top: 10px;">
                     <div>
                     @isset($player)
                              <a href="{{url('/viewGraph')}}"><span class="btn btn-primary btn-lg"
                              style="border-radius: 5px; min-width: 100px">Next</span></a>  
                     @else
                           <a href="{{url('/playerlist')}}"><span class="btn btn-primary btn-lg"
                              style="border-radius: 5px; min-width: 100px">return</span></a>
                     
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
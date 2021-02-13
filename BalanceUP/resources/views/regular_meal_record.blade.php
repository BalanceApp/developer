@extends('app')
@section('title', '食事の記録')
@section('content')

<style>
   label>input {
      visibility: hidden;
      border: none;
   }

   label>img {
      display: inline-block;
      padding: 0px;
      height: 20px;
      width: 20px;
      background: none;
      border: none;
      margin-left: -10px;
   }

   label>input:checked+img {
      background: url('../images/tick.png');
      background-repeat: no-repeat;
      background-position: center center;
      background-size: 20px 20px;
      border: none;
   }
</style>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
   $(document).ready(function () {
      $("#second").hide();
      $("#others_list").hide();
   })

   function nextPage() {
      let foodValArr = new Array();
      let next = true;

      for (let i = 1; i < 23; i++) {
         let foodName = "foo";
         foodName += i;
         foodValArr.push(getradioval(foodName));
      }

      if (foodValArr.includes(-1)) {
         alert("チェック漏れがあります!");
         next = false;
      }

      if (next) {
         $("#first").hide();
         $("#second").show();
      }

   }

   function previousPage() {
      $("#second").hide();
      $("#first").show();
   }

   function end() {
      let foodValArr1 = new Array();
      let end = true;
      let check = document.getElementById("others");

      for (let i = 23; i < 34; i++) {
         let foodName = "foo";
         foodName += i;
         foodValArr1.push(getradioval(foodName));
      }

      if (foodValArr1.includes(-1)) {
         alert("チェック漏れがあります!");
         end = false;
      }

      if (check.checked == true && $("#otherslist").val() =="") {
            alert("その他にチェックを入れた時は、その名前を入力してください。");
            end = false;  
      }

      if (end) {
         calculate();
      }
   }

   function calculate() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      let f = new Array();
      for (let i = 1; i < 34; i++) {
         let foodName = "foo";
         foodName += i;
         let val = parseInt(getradioval(foodName));
         if (val < 0) {
            val = 0;
         }
         f.push(val);
      }

      let score1 = [0, 1, 3.5, 7];
      let score2 = [0, 1, 2, 3];
      let score3 = [0, 1, 1, 3];
      let score4 = [0, 1.5, 3, 3];
      let score5 = [3, 3, 4.5, 6];
      let score6 = [3, 3, 3, 6];

      let mainMeal = (f[0] + f[1] + f[2]) / 2;
      let mainDish = (f[3] + f[4] + f[5]) / 2;
      let sideDish = (f[10] + f[11] + f[12]) / 2;
      let milk = f[18] * f[19] / 2;
      let fruit = f[20] * f[21] / 2;

      let meat = f[6];
      let seafood = f[7];
      let eggs = f[8];
      let beans = f[9];
      let LCvegetables = f[13];
      let GYvegetables = f[14];
      let mushrooms = f[15];
      let seaweeds = f[16];
      let potatoes = f[17];
      let sweets = f[22];
      let friedFood = f[28];

      let energy = mainMeal;
      let protein = mainDish * (score1[meat] + score1[seafood] + score1[eggs] + score1[beans]) / 21;
      let fat = (score6[meat] + score5[friedFood] + score5[sweets]) / 3;
      let vitamin = (score2[LCvegetables] + score3[GYvegetables] + score4[mushrooms] + score4[seaweeds] + score4[potatoes] + fruit) / 6;
      let mineral = (score2[LCvegetables] + score3[GYvegetables] + score4[mushrooms] + score4[seaweeds] + score4[potatoes] + milk) / 6;
      let fiber = (score2[LCvegetables] + score3[GYvegetables] + score4[mushrooms] + score4[seaweeds] + score4[potatoes]) / 5;
      let salt = (mainDish + sideDish) / 2;

      let _token = $('meta[name="csrf-token"]').attr('content');

      let foodInputs = new Array();
      for (let i = 0; i < 33; i++) {
         foodInputs.push(f[i] + 1);
      }
      foodInputs.push($("#energy").prop("checked") ? 1 : 0);
      foodInputs.push($("#calcium").prop("checked") ? 1 : 0);
      foodInputs.push($("#vitamin").prop("checked") ? 1 : 0);
      foodInputs.push($("#amino").prop("checked") ? 1 : 0);
      foodInputs.push($("#others").prop("checked") ? 1 : 0);
      foodInputs.push($("#unknown").prop("checked") ? 1 : 0);
      foodInputs.push($("#otherslist").val());

      $.post("{{url('/input-nutrition-score')}}", {
         mainMeal: mainMeal,
         mainDish: mainDish,
         sideDish: sideDish,
         milk: milk,
         fruit: fruit,
         energy: energy,
         protein: protein,
         fat: fat,
         vitamin: vitamin,
         mineral: mineral,
         fiber: fiber,
         salt: salt,
         foodInputs: foodInputs,
         _token: _token,
      },
         function (res) {
            if (res)
               location.href = "{{url('/finish-inputing')}}";
            else
               return;
         }
      );

   }

   function getradioval(name) {
      var radios = document.getElementsByName(name);
      for (var i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked) return radios[i].value;
      }
      return -1;
   }

   function others_check() {
      var check = document.getElementById("others");
      if (check.checked == true) {
         $("#others_list").show();
      } else $("#others_list").hide();
   }

   function showFocusItem(params) {
      window.location.href = '#' + params;
   }
</script>

<input id="userid" type="hidden" value="@isset($userid){{$userid}}@endisset">
<div class="container">
   <!--begin::Dashboard-->
   <!--begin::Row-->
   <div class="row">
      <div class="col-xl-12">
         <!--begin::Tiles Widget 1-->
         <div class="card card-custom gutter-b card-stretch">
            <form id="regular" method="POST">
               @csrf
               <div class="card-body d-flex flex-column px-0" >
                  <center>
                     <p style="letter-spacing: 5px;font-size: 20px;font-weight: bold;">
                        最近1週間の食事でどのくらい食べたか思い出して<br>
                        <img src="{{asset('images/square.png')}}" alt="Square" style="width: 20px;">
                        の中に当てはまるところに
                        <img src="{{asset('images/tick.png')}}" alt="Tick" style="width: 20px;">
                        をつけてみましょう
                     </p>
                  </center>
                  <div id="first">
                     <div class="row">
                        <div class="left-row">
                           <div>
                              <input type="radio" name="" checked disabled><span class="ml-1">は1週間分の食事について、</span>
                           </div>
                           <div>
                              <input type="radio" name="" disabled><span class="ml-1">は1日分の食事についての質問です。</span>
                           </div>
                           <div class="mt-10" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_1">主食</p>
                              <span class="mt-3 ml-3">(ご飯・パン・麺類・シリアル)</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">あさ、ひる、よるどのくらい食べましたか?</span>
                              <div class="row">         
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal11.png')}}" alt="ごはんの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食ベない</th>
                                             <th scope="col">ふつう量<br><span>より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span>より多い</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">あさ</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo1" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo1" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo1" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo1" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">ひる</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo2" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo2" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo2" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo2" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">よる</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo3" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo3" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo3" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo3" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal11.png')}}" alt="ごはんの量">
                                 </div>
                              </div>
                           </div>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_2">主菜</p>
                              <span class="mt-3 ml-3">（肉・魚・卵・豆をつかったメインのおかず）</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">あさ、ひる、よるどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class=" col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal21.png')}}" alt="主菜の量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span >より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span >より多い</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">あさ</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo4" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo4" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo4" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo4" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">ひる</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo5" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo5" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo5" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo5" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">よる</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo6" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo6" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo6" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo6" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal21.png')}}" alt="主菜の量">
                                 </div>
                              </div>
                           </div>                          
                           <div  class="mt-10" style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、それぞれどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class=" col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal22.png')}}" alt="主菜の種類">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">1〜2日</th>
                                             <th scope="col">3〜4日</th>
                                             <th scope="col">5日以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">肉</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo7" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo7" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo7" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo7" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">魚・貝など</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo8" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo8" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo8" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo8" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">たまご</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo9" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo9" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo9" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo9" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">豆</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo10" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo10" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo10" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo10" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal22.png')}}" alt="主菜の種類">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="right-row">
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_3">副菜</p>
                              <span class="mt-3 ml-3">（野菜・きのこ・海そう•いもをつかった料理）</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled /><span class="ml-1">あさ、ひる、よるどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal31.png')}}" alt="副菜の量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span >より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span >より多い</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">あさ</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo11" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo11" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo11" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo11" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">ひる</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo12" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo12" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo12" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo12" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">よる</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo13" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo13" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo13" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo13" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal31.png')}}" alt="副菜の量">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-5" style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1日でどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none"  src="{{asset('images/meal32.png')}}" alt="色のうすい野菜の量" id="1-tr">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">1回</th>
                                             <th scope="col">2回</th>
                                             <th scope="col">3回以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">色の<br>うすい<br>やさい</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo14" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo14" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo14" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo14" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal32.png')}}" alt="色のうすい野菜の量" id="1-tr">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-5" style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、それぞれどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal33.png')}}" alt="色のうすいやさいの量こまかく">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">1〜2日</th>
                                             <th scope="col">3〜4日</th>
                                             <th scope="col">5日以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">色の<br>こい<br>野菜</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo15" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo15" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo15" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo15" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">きのこ</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo16" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo16" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo16" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo16" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">海そう</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo17" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo17" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo17" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo17" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th scope="row">いも</th>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo18" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo18" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo18" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo18" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal33.png')}}" alt="色のうすいやさいの量こまかく">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_4">牛乳・乳製品</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1日でどのくらい食べましたか?</span>
                              <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                 <img class="d-sm-none" src="{{asset('images/meal41.png')}}" alt="乳製品の量" id="1-tr">
                                 <table class="table" style="text-align: center;">
                                    <thead>
                                       <tr>
                                          <th scope="col">食べない</th>
                                          <th scope="col">ふつう量<br><span >より少ない</span>
                                          </th>
                                          <th scope="col">ふつう量</th>
                                          <th scope="col">ふつう量<br><span >より多い</span>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo19" value=0 />
                                                <img />
                                             </label>
                                          </td>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo19" value=1 />
                                                <img />
                                             </label>
                                          </td>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo19" value=2 />
                                                <img />
                                             </label>
                                          </td>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo19" value=3 />
                                                <img />
                                             </label>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <img class="d-none d-sm-block" src="{{asset('images/meal41.png')}}" alt="乳製品の量" id="1-tr">
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">食べない</th>
                                       <th scope="col">1〜2日</th>
                                       <th scope="col">3〜4日</th>
                                       <th scope="col">5日以上</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo20" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo20" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo20" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo20" value=3 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_5">果物</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled><span class="ml-1">1日でどのくらい食べましたか?</span>
                              <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                 <img class="d-sm-none" src="{{asset('images/meal51.png')}}" alt="くだものの量" id='1-tr'>
                                 <table class="table" style="text-align: center;">
                                    <thead>
                                       <tr>
                                          <th scope="col">食べない</th>
                                          <th scope="col">ふつう量<br><span >より少ない</span>
                                          </th>
                                          <th scope="col">ふつう量</th>
                                          <th scope="col">ふつう量<br><span >より多い</span>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo21" value=0 />
                                                <img />
                                             </label>
                                          </td>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo21" value=1 />
                                                <img />
                                             </label>
                                          </td>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo21" value=2 />
                                                <img />
                                             </label>
                                          </td>
                                          <td>
                                             <label title="item1">
                                                <input type="radio" name="foo21" value=3 />
                                                <img />
                                             </label>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <img class="d-none d-sm-block" src="{{asset('images/meal51.png')}}" alt="くだものの量" id='1-tr'>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">食べない</th>
                                       <th scope="col">1〜2日</th>
                                       <th scope="col">3〜4日</th>
                                       <th scope="col">5日以上</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo22" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo22" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo22" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo22" value=3 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="float-right mt-10">
                              <div>
                                 <a onclick="nextPage();"><span class="btn btn-primary btn-lg">次へ</span></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="second">
                     <div class="row">
                        <div class="left-row">
                           <div>
                              <input type="radio" name="" checked disabled><span class="ml-1">は1週間分の食事について、</span>
                           </div>
                           <div>
                              <input type="radio" name="" disabled><span class="ml-1">は1日分の食事についての質問です。</span>
                           </div>
                           <div class="mt-10" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_6">あまいおかし</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled><span class="ml-1">1日でどのくらい食べしたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal61.png')}}" alt="あまいおかしの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span >より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span >より多い</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo23" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo23" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo23" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo23" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal61.png')}}" alt="あまいおかしの量">
                                 </div>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">食べない</th>
                                       <th scope="col">1〜2日</th>
                                       <th scope="col">3〜4日</th>
                                       <th scope="col">5日以上</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo24" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo24" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo24" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo24" value=3 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_7">しょっぱいおかし</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1日でどのくらい食べしたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal71.png')}}" alt="しょっぱいおかしの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span >より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span >より多い</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo25" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo25" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo25" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo25" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal71.png')}}" alt="しょっぱいおかしの量">
                                 </div>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">食べない</th>
                                       <th scope="col">1〜2日</th>
                                       <th scope="col">3〜4日</th>
                                       <th scope="col">5日以上</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo26" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo26" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo26" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo26" value=3 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_8">ジュース</p>
                              <span class="mt-5 ml-1">（スポーツドリンクを含む）</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled><span class="ml-1">1日でどのくらいのみましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal81.png')}}" alt="ジュースの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">のまない</th>
                                             <th scope="col">ふつう量<br><span >より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span >より多い</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo27" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo27" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo27" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo27" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal81.png')}}" alt="ジュースの量">
                                 </div>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらいのみましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">飲まなかった</th>
                                       <th scope="col">1〜2日</th>
                                       <th scope="col">3〜4日</th>
                                       <th scope="col">5日以上</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo28" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo28" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo28" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo28" value=3 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="right-row">
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_9">あげもの</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal91.png')}}" alt="あげものの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べない</th>
                                             <th scope="col">1〜2日</th>
                                             <th scope="col">3〜4日</th>
                                             <th scope="col">5日以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo29" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo29" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo29" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo29" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal91.png')}}" alt="あげものの量">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_10">ファーストフード</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <div class="row">
                                 <div class=" col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal101.png')}}" alt="ファーストフードの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べない</th>
                                             <th scope="col">1〜2日</th>
                                             <th scope="col">3〜4日</th>
                                             <th scope="col">5日以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo30" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo30" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo30" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo30" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal101.png')}}" alt="ファーストフードの量">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_11">みそ汁・スープ</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled><span class="ml-1">1日で、どのくらいのみますか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">0〜1はい</th>
                                       <th scope="col">2はい</th>
                                       <th scope="col">3はい以上</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo31" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo31" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo31" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_12">めん類のスープ</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">普段めん類を食べる時、どのくらいスープを飲みますか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">のまなかった</th>
                                       <th scope="col">半分のんだ</th>
                                       <th scope="col">全部のんだ</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo32" value=0 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo32" value=1 />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="radio" name="foo32" value=2 />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="mt-5" style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_13">
                                 サプリメント•栄養補助食品
                              </p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">1週間のあいだで、どのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <img class="d-sm-none" src="{{asset('images/meal131.png')}}" alt="サプリメントの量">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">とらなかった</th>
                                             <th scope="col">1〜2日</th>
                                             <th scope="col">3〜4日</th>
                                             <th scope="col">5日以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo33" value=0 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo33" value=1 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo33" value=2 />
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="radio" name="foo33" value=3 />
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <img class="d-none d-sm-block" src="{{asset('images/meal131.png')}}" alt="サプリメントの量">
                                 </div>
                              </div>
                           </div>
                           <div class="mt-5" style="display: block;">
                              <input type="radio" name="" checked disabled><span class="ml-1">おもにふくまれている成分は?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th style="width:17%;">エネルギー</th>
                                       <th style="width:17%;">カルシウム・鉄など</th>
                                       <th style="width:17%;">ビタミン</th>
                                       <th style="width:17%;">プロテイン・アミノ酸など</th>
                                       <th style="width:17%;">その他</th>
                                       <th>わからない</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <label title="item1">
                                             <input type="checkbox" name="energy" id="energy" />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="checkbox" name="calcium" id="calcium" />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="checkbox" name="vitamin" id="vitamin" />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="checkbox" name="amino" id="amino" />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="checkbox" onclick="others_check();" id="others"
                                                name="others" />
                                             <img />
                                          </label>
                                       </td>
                                       <td>
                                          <label title="item1">
                                             <input type="checkbox" name="unknown" id="unknown" />
                                             <img />
                                          </label>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <p id="others_list">
                                 <label style="font-size: 11px;"><span
                                       style="color: red;">*</span>その他にチェックをつけた場合には、その成分を書いてください</label>
                                 <input style="width: 100%;" type="text" name="otherslist" id="otherslist"/>
                              </p>
                           </div>
                           <div class="float-right mt-10">
                              <a onclick="previousPage();"><span class="btn btn-primary btn-lg">前へ戻る</span></a>
                              <a onclick="end();"><span class="btn btn-primary btn-lg">入力終了</span></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--end::Body-->
               </div>
            </form>
            <!--end::Tiles Widget 1-->
         </div>
      </div>
      <!--end::Row-->
      <!--end::Dashboard-->
   </div>
   <!--end::Container-->
</div>
<!--end::Entry-->

@stop
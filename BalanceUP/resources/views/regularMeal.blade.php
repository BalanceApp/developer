@extends('app')
@section('title', '先頭ページ')
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
   $(document).ready(function() {
      $("#second").hide();
      $("#others_list").hide();
   });

   function nextPage() {

       let foodValArr = new Array();
       let next = true;
       let mainfood = "";
       let mainDish = "";
       let sideDish = "";
       let fruit = "";
       let milk = "";

       for (let i = 1; i < 23; i++) {
            let foodName = "foo";
            foodName +=i;
            foodValArr.push(getradioval(foodName));
       }
// mainfood
       for (let j = 0; j < 3; j++) {
           if(foodValArr[j] == 0) {
                // alert("チェック漏れがあります.");
                mainfood ="ok";
                break;
           }
       }

       if(mainfood !="ok") {
            for (let j = 0; j < 3; j++) {
                if(foodValArr[j] < 1) {
                    alert("主食チェック漏れがあります。");
                    next = false;
                    window.location.href = '#p_title_1';
                    break;
                }
            }
       }
// end mainfodd

// mainDish
       if (next) {
           for (let j = 3; j < 10; j++) {
                if(foodValArr[j] == 0) {
                        // alert("チェック漏れがあります.");
                        mainDish ="ok";
                        break;
                }
            }

            if(mainDish !="ok") {
                    for (let j = 3; j < 10; j++) {
                        if(foodValArr[j] < 1) {
                            alert("主菜チェック漏れがあります。");
                            next = false;
                            window.location.href = '#p_title_2';
                            break;
                        }
                    }
            }
       }
// end mainDish
// sideDish
       if (next) {
           for (let j = 10; j < 18; j++) {
                if(foodValArr[j] == 0) {
                        // alert("チェック漏れがあります.");
                        sideDish ="ok";
                        break;
                }
            }

            if(sideDish !="ok") {
                    for (let j = 10; j < 18; j++) {
                        if(foodValArr[j] < 1) {
                            alert(" 副菜 チェック漏れがあります。");
                            next = false;
                            window.location.href = '#p_title_3';
                            break;
                        }
                    }
            }
       }
// end sideDish
// milk
       if (next) {
           for (let j = 18; j < 20; j++) {
                if(foodValArr[j] == 0) {
                        // alert("チェック漏れがあります.");
                        milk ="ok";
                        break;
                }
            }

            if(milk !="ok") {
                    for (let j = 18; j < 20; j++) {
                        if(foodValArr[j] < 1) {
                            alert("牛乳•乳製品チェック漏れがあります.");
                            next = false;
                            window.location.href = '#p_title_4';
                            break;
                        }
                    }
            }
       }
// end milk
// fruit
       if (next) {
           for (let j = 20; j < 22; j++) {
                if(foodValArr[j] == 0) {
                        // alert("チェック漏れがあります.");
                        fruit ="ok";
                        break;
                }
            }

            if(fruit !="ok") {
                    for (let j = 20; j < 22; j++) {
                        if(foodValArr[j] < 1) {
                            alert("果物チェック漏れがあります.");
                            next = false;
                            window.location.href = '#p_title_5';
                            break;
                        }
                    }
            }
       }
// end fruit

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
        let sweetfunny = "";
        let saltyfunny = "";
        let juice = "";
        let friedfood = "";
        let fastfood = "";
        let soup = "";
        let m_soup = "";
        let supplements = "";

        for (let i = 23; i < 34; i++) {
            let foodName = "foo";
            foodName +=i;
            foodValArr1.push(getradioval(foodName));
        }

        let energy = ($("#energy").val() ? 1 : 0) / 2;
        let calcium = ($("#calcium").val() ? 1 : 0) / 2;
        let vitamin = ($("#vitamin").val() ? 1 : 0) / 2;
        let others = ($("#others").val() ? 1 : 0) / 2;
        let unknown = ($("#unknown").val() ? 1 : 0) / 2;

// sweetfunny
        if (end) {
            for (let j = 0; j < 2; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        sweetfunny ="ok";
                        break;
                }
            }

            if(sweetfunny !="ok") {
                    for (let j = 0; j < 2; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("あまいおかしチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_6';
                            break;
                        }
                    }
            }
        }
// end sweetfunny
// saltyfunny
        if (end) {
            for (let j = 2; j < 4; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        saltyfunny ="ok";
                        break;
                }
            }

            if(saltyfunny !="ok") {
                    for (let j = 2; j < 4; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("しょっぱいおかしチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_7';
                            break;
                        }
                    }
            }
        }
// end saltyfunny

// juice
        if (end) {
            for (let j = 4; j < 6; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        juice ="ok";
                        break;
                }
            }

            if(juice !="ok") {
                    for (let j = 4; j < 6; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("ジュースチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_8';
                            break;
                        }
                    }
            }
        }
// end juice
// friedfood
        if (end) {
            for (let j = 6; j < 7; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        friedfood ="ok";
                        break;
                }
            }

            if(friedfood !="ok") {
                    for (let j = 6; j < 7; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("あげものチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_9';
                            break;
                        }
                    }
            }
        }
// end friedfood
// fastfood
        if (end) {
            for (let j = 7; j < 8; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        fastfood ="ok";
                        break;
                }
            }

            if(fastfood !="ok") {
                    for (let j = 7; j < 8; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("ファーストフードチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_10';
                            break;
                        }
                    }
            }
        }
// end fastfood
// soup
        if (end) {
            for (let j = 8; j < 9; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        soup ="ok";
                        break;
                }
            }

            if(soup !="ok") {
                    for (let j = 8; j < 9; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("みそ汁・スープチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_11';
                            break;
                        }
                    }
            }
        }
// end soup
// m_soup
        if (end) {
            for (let j = 9; j < 10; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        m_soup ="ok";
                        break;
                }
            }

            if(m_soup !="ok") {
                    for (let j = 9; j < 10; j++) {
                        if(foodValArr1[j] < 1) {
                            alert("めん類のスープチェック漏れがあります.");
                            end = false;
                            window.location.href = '#p_title_12';
                            break;
                        }
                    }
            }
        }
// end m_soup
// supplements
        if (end) {
            for (let j = 10; j < 11; j++) {
                if(foodValArr1[j] == 0) {
                        // alert("チェック漏れがあります.");
                        supplements ="ok";
                        break;
                }
            }

            if(supplements !="ok") {
                for (let j = 10; j < 11; j++) {
                    if(foodValArr1[j] < 1) {
                        alert("サプリメント•栄養補助食品 チェック漏れがあります.");
                        end = false;
                        window.location.href = '#p_title_13';
                        break;
                    }
                }
            }
        }
        // if (end) {
        //     if (energy ==0 & calcium ==0 & vitamin ==0 & others ==0 & unknown ==0) {
        //             alert("チェック漏れがあります.");
        //             end = false;
        //             return false;
        //         }
        // }
// end supplements

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

      let f1= parseInt(getradioval("foo1"));
      if (f1 < 0) {
          f1 = 0;
      }

      let f2= parseInt(getradioval("foo2"));
      if (f2 < 0) {
          f2 = 0;
      }

      let f3= parseInt(getradioval("foo3"));
      if (f3 < 0) {
          f3 = 0;
      }

      let f4= parseInt(getradioval("foo4"));
      if (f4 < 0) {
          f4 = 0;
      }
      let f5= parseInt(getradioval("foo5"));
      if (f5 < 0) {
          f5 = 0;
      }
      let f6= parseInt(getradioval("foo6"));
      if (f6 < 0) {
          f6 = 0;
      }
      let f7= parseInt(getradioval("foo7"));
      if (f7 < 0) {
          f7 = 0;
      }
      let f8= parseInt(getradioval("foo8"));
      if (f8 < 0) {
          f8 = 0;
      }
      let f9= parseInt(getradioval("foo9"));
      if (f9 < 0) {
          f9 = 0;
      }
      let f10= parseInt(getradioval("foo10"));
      if (f10 < 0) {
          f10 = 0;
      }
      let f11= parseInt(getradioval("foo11"));
      if (f11 < 0) {
          f11 = 0;
      }
      let f12= parseInt(getradioval("foo12"));
      if (f12 < 0) {
          f12 = 0;
      }
      let f13= parseInt(getradioval("foo13"));
      if (f13 < 0) {
          f13 = 0;
      }
      let f14= parseInt(getradioval("foo14"));
      if (f14 < 0) {
          f14 = 0;
      }
      let f15= parseInt(getradioval("foo15"));
      if (f15 < 0) {
          f15 = 0;
      }
      let f16= parseInt(getradioval("foo16"));
      if (f16 < 0) {
          f16 = 0;
      }
      let f17= parseInt(getradioval("foo17"));
      if (f17 < 0) {
          f17 = 0;
      }
      let f18= parseInt(getradioval("foo18"));
      if (f18 < 0) {
          f18 = 0;
      }
      let f19= parseInt(getradioval("foo19"));
      if (f19 < 0) {
          f19 = 0;
      }
      let f20= parseInt(getradioval("foo20"));
      if (f20 < 0) {
          f20 = 0;
      }
      let f21= parseInt(getradioval("foo21"));
      if (f21 < 0) {
          f21 = 0;
      }
      let f22= parseInt(getradioval("foo22"));
      if (f22 < 0) {
          f22 = 0;
      }
      let f23= parseInt(getradioval("foo23"));
      if (f23 < 0) {
          f23 = 0;
      }
      let f24= parseInt(getradioval("foo24"));
      if (f24 < 0) {
          f24 = 0;
      }
      let f25= parseInt(getradioval("foo25"));
      if (f25 < 0) {
          f25 = 0;
      }
      let f26= parseInt(getradioval("foo26"));
      if (f26 < 0) {
          f26 = 0;
      }
      let f27= parseInt(getradioval("foo27"));
      if (f27 < 0) {
          f27 = 0;
      }
      let f28= parseInt(getradioval("foo28"));
      if (f28 < 0) {
          f28 = 0;
      }
      let f29= parseInt(getradioval("foo29"));
      if (f29 < 0) {
          f29 = 0;
      }
      let f30= parseInt(getradioval("foo30"));
      if (f30 < 0) {
          f30 = 0;
      }
      let f31= parseInt(getradioval("foo31"));
      if (f31 < 0) {
          f31 = 0;
      }
      let f32= parseInt(getradioval("foo32"));
      if (f32 < 0) {
          f32 = 0;
      }
      let f33= parseInt(getradioval("foo33"));
      if (f33 < 0) {
          f33 = 0;
      }


      let stapleFood = (f1 + f2 + f3) / 2;
      let mainDish = (f4 + f5 + f6) / 2;
      let sideDish = (f11 + f12 + f13) / 2;
      let meat = f7 / 2;
      let seafood = f8 / 2;
      let eggs = f9 / 2;
      let beans = f10 / 2;
      let LCvegetables = f14 / 2;
      let GYvegetables = f15 / 2;
      let mushrooms = f16 / 2;
      let seaweeds = f17 / 2;
      let potatoes = f18 / 2;
      let milk = f19 * f20 / 2;
      let fruit = f21 * f22 / 2;
      let sweets = f23 * f24 / 2;
      let saltSweets = f25 * f26 / 2;
      let juice = f27 * f28 / 2;
      let friedFood = f29 / 2;
      let fastFood = f30 / 2;
      let misoSoup = f31 / 2;
      let MenSoup = f32 / 2;
      let supply = f33 / 2;
      let energy = ($("#energy").val() ? 1 : 0) / 2;
      let calcium = ($("#calcium").val() ? 1 : 0) / 2;
      let vitamin = ($("#vitamin").val() ? 1 : 0) / 2;
      let others = ($("#others").val() ? 1 : 0) / 2;
      let unknown = ($("#unknown").val() ? 1 : 0) / 2;
      let otherslist = $("#otherslist").val();
      // let description = $("#description").val();
      let _token = $('meta[name="csrf-token"]').attr('content');
      $.post("{{url('/dietData')}}", {
            stapleFood: stapleFood,
            mainDish: mainDish,
            sideDish: sideDish,
            meat: meat,
            seafood: seafood,
            eggs: eggs,
            beans: beans,
            LCvegetables: LCvegetables,
            GYvegetables: GYvegetables,
            mushrooms: mushrooms,
            seaweeds: seaweeds,
            potatoes: potatoes,
            milk: milk,
            fruit: fruit,
            sweets: sweets,
            saltSweets: saltSweets,
            juice: juice,
            friedFood: friedFood,
            fastFood: fastFood,
            misoSoup: misoSoup,
            MenSoup: MenSoup,
            supply: supply,
            energy: energy,
            calcium: calcium,
            vitamin: vitamin,
            others: others,
            unknown: unknown,
            description: "null",
            otherslist: otherslist,
            _token: _token,
            f1:f1,
            f2:f2,
            f3:f3,
            f4:f4,
            f5:f5,
            f6:f6,
            f7:f7,
            f8:f8,
            f9:f9,
            f10:f10,
            f11:f11,
            f12:f12,
            f13:f13,
            f14:f14,
            f15:f15,
            f16:f16,
            f17:f17,
            f18:f18,
            f19:f19,
            f20:f20,
            f21:f21,
            f22:f22,
            f23:f23,
            f24:f24,
            f25:f25,
            f26:f26,
            f27:f27,
            f28:f28,
            f29:f29,
            f30:f30,
            f31:f31,
            f32:f32,
            f33:f33,
         },
         function(res) {
            if (res)
               location.href = "{{url('/finishInputing')}}";
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
            <form action="{{url('/dietData')}}" id="regular" method="POST">
               @csrf
               <div class="card-body d-flex flex-column px-0" style="min-height:400px">
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
                           <div style="display: flex;" class="pad-left20">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;<span>は1週間分の食事について、</span>
                           </div>
                           <div style="display: flex;" class="pad-left20">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;<span>は1日分の食事についての質問です。</span>
                           </div>
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_1">主食</p>
                              <span style="margin-top: 10px;">(ご飯・パン・麺類・シリアル)</span>
                           </div>
                           <div style="display: block;">
                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                <span style="margin-top: 10px;">あさ、ひる、よるどのくらい食べましたか?</span>
                                <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">食ベない</th>
                                                <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                                </th>
                                                <th scope="col">ふつう量</th>
                                                <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal11.png')}}" alt="ごはんの量" style="width: 200px;">
                                </div>
                           </div>
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_2">主菜</p>
                              <span style="margin-top: 10px;">（肉・魚・卵・豆をつかったメインのおかず）</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">あさ、ひる、よるどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class=" col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal21.png')}}" alt="主菜の量">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">1週間のあいだで、それぞれどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class=" col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べなかった</th>
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
                                    <img src="{{asset('images/meal22.png')}}" alt="主菜の種類">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="right-row">
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_3">副菜</p>
                              <span style="margin-top: 10px;">（野菜・きのこ・海そう•いもをつかった料理）</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">あさ、ひる、よるどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal31.png')}}" alt="副菜の量">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div style="display: block;">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">1日でどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べなかった</th>
                                             <th scope="col">1回</th>
                                             <th scope="col">2回</th>
                                             <th scope="col">3回以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">色のうすい<br>野菜</th>
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
                                    <img src="{{asset('images/meal32.png')}}" alt="色のうすい野菜の量" id="1-tr">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">1週間のあいだで、それぞれどのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食べなかった</th>
                                             <th scope="col">1〜2日</th>
                                             <th scope="col">3〜4日</th>
                                             <th scope="col">5日以上</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <th scope="row">色のこい<br>野菜</th>
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
                                    <img src="{{asset('images/meal33.png')}}" alt="色のうすいやさいの量こまかく">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div>
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_4">牛乳•乳製品</p>
                           </div>
                           <div class="row">
                                 <input type="radio" name="" disabled>&nbsp;&nbsp;
                                 <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                        <thead>
                                            <tr>
                                            <th scope="col">食べない</th>
                                            <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                            </th>
                                            <th scope="col">ふつう量</th>
                                            <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal41.png')}}" alt="乳製品の量" id="1-tr">
                                </div>
                              <br>
                            <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                            <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                            <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th scope="col">食べなかった</th>
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
                           <br>
                           <div>
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_5">果物</p>
                           </div>
                           <div class="row">
                                <input type="radio" name="" disabled>&nbsp;&nbsp;
                                <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                        <thead>
                                            <tr>
                                            <th scope="col">食べない</th>
                                            <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                            </th>
                                            <th scope="col">ふつう量</th>
                                            <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal51.png')}}" alt="くだものの量" id='1-tr'>
                                </div>
                              <br>
                                 <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                 <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                                 <table class="table" style="text-align: center;">
                                    <thead>
                                       <tr>
                                          <th scope="col">食べなかった</th>
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
                        </div>
                     </div>
                     <div style="text-align: right; padding-right: 100px;">
                        <div>
                           <a onclick="nextPage();"><span class="btn btn-primary btn-lg" style="border-radius: 5px; min-width: 100px">次へ</span></a>
                        </div>
                     </div>
                  </div>
                  <div id="second">
                     <div class="row">
                        <div class="left-row">
                           <div style="display: flex;" class="pad-left20">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;<span>は1週間分の食事について、</span>
                           </div>
                           <div style="display: flex;" class="pad-left20">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;<span>は1日分の食事についての質問です。</span>
                           </div>
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_6">あまいおかし</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">1日でどのくらい食べしたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal61.png')}}" alt="あまいおかしの量">
                                 </div>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">食べなかった</th>
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
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_7">しょっぱいおかし</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">1日でどのくらい食べしたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べない</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal71.png')}}" alt="しょっぱいおかしの量">
                                 </div>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th scope="col">食べなかった</th>
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
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_8">ジュース</p>
                              <span style="margin-top: 10px;">（スポーツドリンクを含む）</span>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;">1日でどのくらいのみましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">のまない</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より少ない</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span style="font-size: 12px">より多い</span>
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
                                    <img src="{{asset('images/meal81.png')}}" alt="ジュースの量">
                                 </div>
                              </div>
                              <br>
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらいのみましたか?</span>
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
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べなかった</th>
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
                                    <img src="{{asset('images/meal91.png')}}" alt="あげものの量">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_10">ファーストフード</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                              <div class="row">
                                 <div class=" col-lg-12 col-md-12 col-sm-12 img-involve">

                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食べなかった</th>
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
                                    <img src="{{asset('images/meal101.png')}}" alt="ファーストフードの量">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_11">みそ汁・スープ</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日で、どのくらいのみますか?</span>
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
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_12">めん類のスープ</p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">普段めん類を食べる時、どのくらいスープを飲みますか?</span>
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
                           <br>
                           <div style="display: flex;">
                              <p class="lable-p" style="font-size: 20px;font-weight: bold;" id="p_title_13">サプリメント•栄養補助食品
                              </p>
                           </div>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
                              <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12 img-involve">

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
                                    <img src="{{asset('images/meal131.png')}}" alt="サプリメントの量">
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div style="display: block;">
                              <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                              <span style="margin-top: 10px;font-size: 12px;margin-top: 10px;">おもにふくまれている成分?</span>
                              <table class="table" style="text-align: center;">
                                 <thead>
                                    <tr>
                                       <th style="width:17%;">エネルギー</th>
                                       <th style="width:17%;">カルシウム・鉄など</th>
                                       <th style="width:17%;">ビタミン</th>
                                       <th style="width:17%;">プロテイン・アミノ酸など</th>
                                       <th style="width:17%;">その他</th>
                                       <th style="width:17%;">わからない</th>
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
                                             <input type="checkbox" onclick="others_check();" id="others" name="others" />
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
                                 <label style="font-size: 11px;"><span style="color: red;">*</span>その他にチェックをつけた場合には、その成分を書いてください</label>
                                 <input style="width: 100%;" type="text" name="otherslist" id="otherslist" />
                              </p>
                           </div>
                           <br>
                        </div>
                     </div>

                     <div style="text-align: right; padding-right: 100px;">
                        <div>
                           <a onclick="previousPage();"><span class="btn btn-primary btn-lg" style="border-radius: 5px; min-width: 100px">前へ戻る</span></a>
                           <a onclick="end();"><span class="btn btn-primary btn-lg" style="border-radius: 5px; min-width: 100px">入力終了</span></a>
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

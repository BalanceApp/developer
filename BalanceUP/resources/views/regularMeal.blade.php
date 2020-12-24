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
      background: url(images/tick.png);
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
      $("#first").hide();
      $("#second").show();
   }
   function previousPage() {
      $("#second").hide();
      $("#first").show();
   }
   function end(){
      calculate();
   }
   function calculate(){
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      let stapleFood = (parseInt(getradioval("foo1")) + parseInt(getradioval("foo2")) + parseInt(getradioval("foo3"))) / 2;
      let mainDish = (parseInt(getradioval("foo4")) + parseInt(getradioval("foo5")) + parseInt(getradioval("foo6")))/2;
      let sideDish = (parseInt(getradioval("foo11")) + parseInt(getradioval("foo12")) + parseInt(getradioval("foo13"))) / 2;
      let meat = getradioval("foo7") / 2;
      let seafood = getradioval("foo8") /2;
      let eggs = getradioval("foo9") / 2;
      let beans = getradioval("foo10") / 2;
      let LCvegetables = getradioval("foo14") / 2;
      let GYvegetables = getradioval("foo15") / 2;
      let mushrooms = getradioval("foo16") / 2;
      let seaweeds = getradioval("foo17") / 2;
      let potatoes = getradioval("foo18") / 2;
      let milk = getradioval("foo19") * getradioval("foo20") / 2;
      let fruit = getradioval("foo21") * getradioval("foo22") / 2;
      let sweets = getradioval("foo23") * getradioval("foo24") / 2;
      let saltSweets = getradioval("foo25") * getradioval("foo26") / 2;
      let juice = getradioval("foo27") * getradioval("foo28") / 2;
      let friedFood = getradioval("foo29") / 2;
      let fastFood = getradioval("foo30") / 2;
      let misoSoup = getradioval("foo31") / 2;
      let MenSoup = getradioval("foo32") / 2;
      let supply = getradioval("foo33") / 2;
      let energy = ($("#energy").val() ? 1 : 0) /2;
      let calcium = ($("#calcium").val() ? 1 : 0) / 2;
      let vitamin = ($("#vitamin").val() ? 1 : 0) / 2;
      let others = ($("#others").val() ? 1 : 0) / 2;
      let unknown = ($("#unknown").val() ? 1 : 0) / 2;
      let otherslist = $("#otherslist").val();
      let description = $("#description").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');
      $.post("{{url('/dietData')}}", {
            stapleFood:stapleFood,
            mainDish:mainDish,
            sideDish:sideDish,
            meat:meat,
            seafood:seafood,
            eggs:eggs,
            beans:beans,
            LCvegetables:LCvegetables,
            GYvegetables:GYvegetables,
            mushrooms:mushrooms,
            seaweeds:seaweeds,
            potatoes:potatoes,
            milk:milk,
            fruit:fruit,
            sweets:sweets,
            saltSweets:saltSweets, 
            juice:juice,
            friedFood:friedFood, 
            fastFood:fastFood,
            misoSoup:misoSoup,
            MenSoup:MenSoup,
            supply:supply,
            energy:energy,
            calcium:calcium,
            vitamin:vitamin,
            others:others,
            unknown:unknown,
            description:description,
            otherslist:otherslist,
            _token:_token
         },
         function(res){
            if(res)
            location.href = "{{url('/finishInputing')}}";
            else
            return;
         }
      );
   }
   function getradioval(name)
   {
      var radios = document.getElementsByName(name);
      for (var i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked)  return radios[i].value;
      }
      return 0;
   }
<<<<<<< HEAD

   function others_check(){
      var check = document.getElementById("others");
      if (check.checked == true)  
      {
         $("#others_list").show();
      }

      else $("#others_list").hide();
   }

</script>
=======
</script>
<div id="home">
   <!--begin::Main-->
   <!--begin::Header Mobile-->
   <div id="kt_header_mobile" class="header-mobile">
      <!--begin::Logo-->
      <a href="{{url('/')}}">
         <img alt="Logo" src="{{asset('others/assets/media/logos/logo_black.png')}}" class="logo-default max-h-30px" />
      </a>
      <!--end::Logo-->
      <!--begin::Toolbar-->
      <div class="d-flex align-items-center">
         <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
            <span></span>
         </button>
         <button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
            <span class="svg-icon svg-icon-xl">
               <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                  height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                     <polygon points="0 0 24 0 24 24 0 24" />
                     <path
                        d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                     <path
                        d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                        fill="#000000" fill-rule="nonzero" />
                  </g>
               </svg>
               <!--end::Svg Icon-->
            </span>
         </button>
      </div>
      <!--end::Toolbar-->
   </div>
   <!--end::Header Mobile-->
   <div class="d-flex flex-column flex-root">
      <!--begin::Page-->
      <div class="d-flex flex-row flex-column-fluid page">
         <!--begin::Wrapper-->
         <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
               <!--begin::Container-->
               <div class="container d-flex align-items-stretch justify-content-between">
                  <!--begin::Left-->
                  <div class="d-flex align-items-stretch mr-3">
                     <!--begin::Header Logo-->
                     <div class="header-logo">
                        <a href="/">
                           <img alt="Logo" src="{{asset('others/assets/media/logos/logo_white.png')}}"
                              class="logo-default max-h-40px" />
                           <img alt="Logo" src="{{asset('others/assets/media/logos/logo_black.png')}}"
                              class="logo-sticky max-h-40px" />
                        </a>
                     </div>
                     <!--end::Header Logo-->
                     <!--begin::Header Menu Wrapper-->
                     <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <!--begin::Header Menu-->
                        <div id="kt_header_menu"
                           class="header-menu header-menu-right header-menu-mobile header-menu-layout-default">
                           <!--begin::Header Nav-->
>>>>>>> 3596b64cdc62d90a9c4b2042ad7bcf9f6604b7c7

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
                  <form action="{{url('/dietData')}}" id="regular" method="POST" >
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
                              <div class="col-lg- col-md-6 col-sm-6"
                                 style="min-width: 500px; padding-left: 100px; padding-right:100px">
                                 <div style="display: flex;" class="pad-left20">
                                    <input type="radio" name="" checked
                                       disabled>&nbsp;&nbsp;<span>は1週間分の食事について、</span>
                                 </div>
                                 <div style="display: flex;" class="pad-left20">
                                    <input type="radio" name=""
                                       disabled>&nbsp;&nbsp;<span>は1日分の食事についての質問です。</span>
                                 </div>
                                 <br>
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">主食</p>
                                    <span style="margin-top: 10px;">(ご飯・パン・麺類・シリアル)</span>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">あさ、ひる、よるどのくらい食ペましたか?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食ペない</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">(より少ない)</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">（より多い）</span>
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
                                 </div>
                                 <br>
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">主菜</p>
                                    <span style="margin-top: 10px;">（肉・魚•卵•豆を便ったメインのおかず）</span>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">あさ、ひる、よるどのくらい食べましたか?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食ペない</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">(より少ない)</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">（より多い）</span>
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
                                 </div>
                                 <br>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">1週間のあいだで、それぞれどのくらい食べましたか?</span>
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
                                             <th scope="row">魚•貝など</th>
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
                                 </div>
                              </div>
<<<<<<< HEAD
                              <div class="col-lg-6 col-md-6 col-sm-6"
                                 style="min-width: 500px; padding-left: 100px; padding-right: 100px;">
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">副菜</p>
                                    <span style="margin-top: 10px;">（野菜・きのこ・海そう•いもを使った料理）</span>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">あさ、ひる、よるどのくらい食ペましたか?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">食ペない</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">(より少ない)</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">（より多い）</span>
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
                                 </div>
                                 <br>
                                 <div style="display: block;">
                                    <input type="radio" name="" disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">1日でどのくらい食べましたか?</span>
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
                                 </div>
                                 <br>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">1週間のあいだで、それぞれどのくらい食べましたか?</span>
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
                                             <th scope="row">色のうすい<br>野菜</th>
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
                                 </div>
                                 <br>
                                 <div>
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">牛乳•乳製品</p>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6" style="min-width: 400px;">
                                       <input type="radio" name="" disabled>&nbsp;&nbsp;
                                       <span
                                          style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                       <table class="table" style="text-align: center;">
                                          <thead>
                                             <tr>
                                                <th scope="col">食ペない</th>
                                                <th scope="col">ふつう量<br><span
                                                      style="font-size: 12px">(より少ない)</span>
                                                </th>
                                                <th scope="col">ふつう量</th>
                                                <th scope="col">ふつう量<br><span
                                                      style="font-size: 12px">（より多い）</span>
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
                                    </div>
                                    <br>
                                    <div class="col-md-6" style="min-width: 400px;">
                                       <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                       <span
                                          style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                 </div>
                                 <br>
                                 <div>
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">果物</p>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6" style="min-width: 400px;">
                                       <input type="radio" name="" disabled>&nbsp;&nbsp;
                                       <span
                                          style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                       <table class="table" style="text-align: center;">
                                          <thead>
                                             <tr>
                                                <th scope="col">食ペない</th>
                                                <th scope="col">ふつう量<br><span
                                                      style="font-size: 12px">(より少ない)</span>
                                                </th>
                                                <th scope="col">ふつう量</th>
                                                <th scope="col">ふつう量<br><span
                                                      style="font-size: 12px">（より多い）</span>
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
                                    </div>
                                    <br>
                                    <div class="col-md-6" style="min-width: 400px;">
                                       <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                       <span
                                          style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
=======
                              <!--end::Header-->
                              <!--begin::Body-->
                              <form action="{{url('/dietData')}}" id="regular" method="POST" >
					                  @csrf
                                 <div class="card-body d-flex flex-column px-0" style="min-height:400px">
                                    <center>
                                       <p style="letter-spacing: 5px;font-size: 20px;font-weight: bold;">
                                          最近1週間の食事でどのくらい食べたかを思い出して<br>
                                          <img src="{{asset('images/square.png')}}" alt="Square" style="width: 20px;">
                                          の中に当てはまるところに
                                          <img src="{{asset('images/tick.png')}}" alt="Tick" style="width: 20px;">
                                          をつけてみましょう
                                       </p>
                                    </center>
                                    <div id="first">
                                       <div class="row">
                                          <div class="col-lg- col-md-6 col-sm-6"
                                             style="min-width: 500px; padding-left: 100px; padding-right:100px">
                                             <div style="display: flex;" class="pad-left20">
                                                <input type="radio" name="" checked
                                                   disabled>&nbsp;&nbsp;<span>は1週間分の食事について、</span>
                                             </div>
                                             <div style="display: flex;" class="pad-left20">
                                                <input type="radio" name=""
                                                   disabled>&nbsp;&nbsp;<span>は1日分の食事についての質問です。</span>
                                             </div>
                                             <br>
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">主食</p>
                                                <span style="margin-top: 10px;">(ご飯・パン・麺類・シリアル)</span>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">あさ、ひる、よるで、どのくらい食べましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">#</th>
                                                         <th scope="col">食ベない</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より少ない</span>
                                                         </th>
                                                         <th scope="col">ふつう量</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より多い</span>
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
                                             </div>
                                             <br>
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">主菜</p>
                                                <span style="margin-top: 10px;">（肉・魚・卵・豆を使ったメインのおかず）</span>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">あさ、ひる、よるで、どのくらい食べましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">#</th>
                                                         <th scope="col">食べない</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より少ない</span>
                                                         </th>
                                                         <th scope="col">ふつう量</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より多い</span>
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
                                             </div>
                                             <br>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">1週間のあいだで、それぞれどのくらい食べましたか?</span>
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
                                             </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-6"
                                             style="min-width: 500px; padding-left: 100px; padding-right: 100px;">
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">副菜</p>
                                                <span style="margin-top: 10px;">（野菜・きのこ・海そう・いもを使った料理）</span>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">あさ、ひる、よるで、どのくらい食べましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">#</th>
                                                         <th scope="col">食べない</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より少ない</span>
                                                         </th>
                                                         <th scope="col">ふつう量</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より多い</span>
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
                                             </div>
                                             <br>
                                             <div style="display: block;">
                                                <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">1日でどのくらい食べましたか?</span>
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
                                             </div>
                                             <br>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">1週間のあいだで、それぞれどのくらい食べましたか?</span>
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
                                                         <th scope="row">色のうすい<br>野菜</th>
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
                                             </div>
                                             <br>
                                             <div>
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">牛乳・乳製品</p>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6" style="min-width: 400px;">
                                                   <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                   <span
                                                      style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                                   <table class="table" style="text-align: center;">
                                                      <thead>
                                                         <tr>
                                                            <th scope="col">食べない</th>
                                                            <th scope="col">ふつう量<br><span
                                                                  style="font-size: 12px">より少ない</span>
                                                            </th>
                                                            <th scope="col">ふつう量</th>
                                                            <th scope="col">ふつう量<br><span
                                                                  style="font-size: 12px">より多い</span>
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
                                                </div>
                                                <br>
                                                <div class="col-md-6" style="min-width: 400px;">
                                                   <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                   <span
                                                      style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                             </div>
                                             <br>
                                             <div>
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">果物</p>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6" style="min-width: 400px;">
                                                   <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                   <span
                                                      style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                                   <table class="table" style="text-align: center;">
                                                      <thead>
                                                         <tr>
                                                            <th scope="col">食べない</th>
                                                            <th scope="col">ふつう量<br><span
                                                                  style="font-size: 12px">より少ない</span>
                                                            </th>
                                                            <th scope="col">ふつう量</th>
                                                            <th scope="col">ふつう量<br><span
                                                                  style="font-size: 12px">より多い</span>
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
                                                </div>
                                                <br>
                                                <div class="col-md-6" style="min-width: 400px;">
                                                   <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                   <span
                                                      style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                       </div>
                                       <div style="text-align: right; padding-right: 100px;">
                                          <div>
                                             <a href="#" onclick="nextPage();"><span class="btn btn-primary btn-lg"
                                                   style="border-radius: 5px; min-width: 100px">Next</span></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div id="second">
                                       <div class="row">
                                          <div class="col-lg- col-md-6 col-sm-6"
                                             style="min-width: 500px; padding-left: 100px; padding-right:100px">
                                             <div style="display: flex;" class="pad-left20">
                                                <input type="radio" name="" checked
                                                   disabled>&nbsp;&nbsp;<span>は1週間分の食事について、</span>
                                             </div>
                                             <div style="display: flex;" class="pad-left20">
                                                <input type="radio" name=""
                                                   disabled>&nbsp;&nbsp;<span>は1日分の食事についての質問です。</span>
                                             </div>
                                             <br>
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">あまいおかし</p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">食べない</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より少ない</span>
                                                         </th>
                                                         <th scope="col">ふつう量</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より多い</span>
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
                                                <br>
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">しょっぱいおかし</p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">1日でどのくらい食べましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">食べない</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より少ない</span>
                                                         </th>
                                                         <th scope="col">ふつう量</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より多い</span>
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
                                                <br>
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">ジュース</p><span
                                                   style="margin-top: 10px;">（スポーツドリンクを含む）</span></p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                <span style="margin-top: 10px;">1日でどのくらいのみましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">のまない</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より少ない</span>
                                                         </th>
                                                         <th scope="col">ふつう量</th>
                                                         <th scope="col">ふつう量<br><span
                                                               style="font-size: 12px">より多い</span>
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
                                                <br>
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらいのみましたか?</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">のまなかった</th>
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
                                          <div class="col-lg-6 col-md-6 col-sm-6"
                                             style="min-width: 500px; padding-left: 100px; padding-right: 100px;">
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">あげもの</p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                             </div>
                                             <br>
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">ファーストフード</p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                             </div>
                                             <br>
                                             <div style="display: flex;">
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">みそ汁・スープ</p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日で、どのくらいのみますか?</span>
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
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">めん類のスープ</p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">普段めん類を食べる時、どのくらいスープをのみますか?</span>
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
                                                <p class="lable-p" style="font-size: 20px;font-weight: bold;">サプリメント・栄養補助食品
                                                </p>
                                             </div>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらいとりましたか?</span>
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
                                             </div>
                                             <br>
                                             <div style="display: block;">
                                                <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                                <span
                                                   style="margin-top: 10px;font-size: 12px;margin-top: 10px;">おもにふくまれている成分</span>
                                                <table class="table" style="text-align: center;">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">エネルギー</th>
                                                         <th scope="col">カルシウム・鉄など</th>
                                                         <th scope="col">ビタミン</th>
                                                         <th scope="col">プロテイン・アミノ酸など</th>
                                                         <th scope="col">その他</th>
                                                         <th scope="col">わからない</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <tr>
                                                         <td>
                                                            <label title="item1">
                                                               <input type="radio" name="foo34" value=0 />
                                                               <img />
                                                            </label>
                                                         </td>
                                                         <td>
                                                            <label title="item1">
                                                               <input type="radio" name="foo34" value=0 />
                                                               <img />
                                                            </label>
                                                         </td>
                                                         <td>
                                                            <label title="item1">
                                                               <input type="radio" name="foo34" value=0 />
                                                               <img />
                                                            </label>
                                                         </td>
                                                         <td>
                                                            <label title="item1">
                                                               <input type="radio" name="foo34" value=0 />
                                                               <img />
                                                            </label>
                                                         </td>
                                                         <td>
                                                            <label title="item1">
                                                               <input type="radio" name="foo34" value=0 />
                                                               <img />
                                                            </label>
                                                         </td>
                                                         <td>
                                                            <label title="item1">
                                                               <input type="radio" name="foo34" value=0 />
                                                               <img />
                                                            </label>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                             <br>
                                          </div>
                                       </div>
                                       
                                       <div style="text-align: right; padding-right: 100px;">
                                          <div>
                                             <a href="#" onclick="previousPage();"><span class="btn btn-primary btn-lg"
                                                   style="border-radius: 5px; min-width: 100px">Previous</span></a>
                                             <a href="#" onclick="end();"><span class="btn btn-primary btn-lg"
                                                   style="border-radius: 5px; min-width: 100px">End</span></a>
                                          </div>
                                       </div>
>>>>>>> 3596b64cdc62d90a9c4b2042ad7bcf9f6604b7c7
                                    </div>
                                 </div>

                              </div>
                           </div>
                           <div style="text-align: right; padding-right: 100px;">
                              <div>
                                 <a href="#" onclick="nextPage();"><span class="btn btn-primary btn-lg"
                                       style="border-radius: 5px; min-width: 100px">Next</span></a>
                              </div>
                           </div>
                        </div>
                        <div id="second">
                           <div class="row">
                              <div class="col-lg- col-md-6 col-sm-6"
                                 style="min-width: 500px; padding-left: 100px; padding-right:100px">
                                 <div style="display: flex;" class="pad-left20">
                                    <input type="radio" name="" checked
                                       disabled>&nbsp;&nbsp;<span>は1週間分の食事について、</span>
                                 </div>
                                 <div style="display: flex;" class="pad-left20">
                                    <input type="radio" name=""
                                       disabled>&nbsp;&nbsp;<span>は1日分の食事についての質問です。</span>
                                 </div>
                                 <br>
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">あまいおかし</p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">1日でどのくらい食べしたか?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食ペない</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">(より少ない)</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">（より多い）</span>
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
                                    <br>
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">しょっぱいおかし</p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">1日でどのくらい食べしたか?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食ペない</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">(より少ない)</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">（より多い）</span>
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
                                    <br>
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">ジュース</p><span
                                       style="margin-top: 10px;">（スポーツドリンクを含む）</span></p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" disabled>&nbsp;&nbsp;
                                    <span style="margin-top: 10px;">1日でどのくらい食べしたか?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th scope="col">食ペない</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">(より少ない)</span>
                                             </th>
                                             <th scope="col">ふつう量</th>
                                             <th scope="col">ふつう量<br><span
                                                   style="font-size: 12px">（より多い）</span>
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
                                    <br>
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                              <div class="col-lg-6 col-md-6 col-sm-6"
                                 style="min-width: 500px; padding-left: 100px; padding-right: 100px;">
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">あげもの</p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                 </div>
                                 <br>
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">ファーストフード</p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                 </div>
                                 <br>
                                 <div style="display: flex;">
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">みそ汁・スープ</p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1日で、どのくらいのみますか?</span>
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
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">めん類のスープ</p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">普段めん類を食べる時、どのくらいスープを飲みますか?</span>
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
                                    <p class="lable-p" style="font-size: 20px;font-weight: bold;">サプリメント•栄養補助食品
                                    </p>
                                 </div>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">1週間のあいだで、どのくらい食べましたか?</span>
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
                                 </div>
                                 <br>
                                 <div style="display: block;">
                                    <input type="radio" name="" checked disabled>&nbsp;&nbsp;
                                    <span
                                       style="margin-top: 10px;font-size: 12px;margin-top: 10px;">おもにふくまれている成分?</span>
                                    <table class="table" style="text-align: center;">
                                       <thead>
                                          <tr>
                                             <th style="width:17%;">エネルギー</th>
                                             <th style="width:17%;">カルシウム铁など</th>
                                             <th style="width:17%;">ピタミン</th>
                                             <th style="width:17%;">ブロティンアミノ酸など</th>
                                             <th style="width:17%;">その他</th>
                                             <th style="width:17%;">わからない</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <label title="item1">
                                                   <input type="checkbox" name="energy" id="energy"/>
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="checkbox" name="calcium" id="calcium"/>
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="checkbox" name="vitamin" id="vitamin"/>
                                                   <img />
                                                </label>
                                             </td>
                                             <td>
                                                <label title="item1">
                                                   <input type="checkbox"  name="amino" id="amino"/>
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
                                                   <input type="checkbox" name="unknown" id="unknown"/>
                                                   <img />
                                                </label>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <p id="others_list">
                                       <label style="font-size: 11px;"><span style="color: red;">*</span>その他にチェックをつけた場合には、その成分を書いてください</label>
                                       <input style="width: 100%;" type="text" name="otherslist" id="otherslist"/>
                                    </p>
                                    <p >
                                       <label style="font-size: 11px;"><span style="color: red;">*</span>自由記述欄</label>
                                       <textarea id="description" name="description"></textarea>
                                    </p>
                                   
                                 </div>
                                 <br>
                              </div>
                           </div>
                           
                           <div style="text-align: right; padding-right: 100px;">
                              <div>
                                 <a href="#" onclick="previousPage();"><span class="btn btn-primary btn-lg"
                                       style="border-radius: 5px; min-width: 100px">Previous</span></a>
                                 <a href="#" onclick="end();"><span class="btn btn-primary btn-lg"
                                       style="border-radius: 5px; min-width: 100px">End</span></a>
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
<<<<<<< HEAD
      <!--end::Entry-->
              
      @stop
=======
      @stop
>>>>>>> 3596b64cdc62d90a9c4b2042ad7bcf9f6604b7c7

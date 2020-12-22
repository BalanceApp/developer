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

                           <!--end::Header Nav-->
                        </div>
                        <!--end::Header Menu-->
                     </div>
                     <!--end::Header Menu Wrapper-->
                  </div>
                  <!--end::Left-->
                  <!--begin::Topbar-->
                  <div class="topbar">
                     <div
                        class="topbar-item header-menu header-menu-right header-menu-mobile header-menu-layout-default">
                        <ul class="menu-nav">
                           <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here"
                              data-menu-toggle="click" aria-haspopup="true">
                              <a href="javascript:;" class="menu-link menu-toggle">
                                 <span class="menu-text">Dashboard</span>
                                 <i class="menu-arrow"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div
                        class="topbar-item header-menu header-menu-right header-menu-mobile header-menu-layout-default">
                        <ul class="menu-nav">
                           <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                              aria-haspopup="true">
                              <a href="javascript:;" class="menu-link menu-toggle">
                                 <span class="menu-text">Features</span>
                                 <span class="menu-desc"></span>
                                 <i class="menu-arrow"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <!--end::Topbar-->
               </div>
               <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
               <!--begin::Subheader-->
               <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                  <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                     <!--begin::Info-->
                     <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column">
                           <!--begin::Breadcrumb-->
                           <div class="d-flex align-items-center font-weight-bold my-2">
                              <!--begin::Item-->
                              <a href="#" class="opacity-75 hover-opacity-100">
                                 <i class="flaticon2-shelter text-white icon-1x"></i>
                              </a>
                              <!--end::Item-->
                              <!--begin::Item-->
                              <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                              <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Dashboard</a>
                              <!--end::Item-->
                              <!--begin::Item-->
                              <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                              <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Latest
                                 Updated</a>
                              <!--end::Item-->
                           </div>
                           <!--end::Breadcrumb-->
                        </div>
                        <!--end::Heading-->
                     </div>
                     <!--end::Info-->
                  </div>
               </div>
               <!--end::Subheader-->
               <!--begin::Entry-->
               <div class="d-flex flex-column-fluid">
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
               </div>
               <!--end::Entry-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
               <!--begin::Container-->
               <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                  <!--begin::Copyright-->
                  <div class="text-dark order-2 order-md-1">
                     <span class="text-muted font-weight-bold mr-2">Copyright &copy 2015 </span>
                     <a href="http://keenthemes.com/metronic" target="_blank"
                        class="text-dark-75 text-hover-primary">Company name</a>
                  </div>
                  <!--end::Copyright-->
               <!--end::Container-->
            </div>
            <!--end::Footer-->
         </div>
         <!--end::Wrapper-->
      </div>
      <!--end::Page-->
   </div>
   <!--end::Main-->
</div>
@stop
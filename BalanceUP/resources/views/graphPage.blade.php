@extends('app')
@section('title', '先頭ページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/canvasjs.min.js')}}"></script>
<script>
    var everydayData;
   var weekData;
   var monthlyData;
   var yearData;
   var tabId = 1;
   $(document).ready(function(){
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
      var useridinput = document.getElementById("userid")
      var userid = useridinput.value;
      $.get("{{url('/getGraphData')}}",{userid:userid}, function sucess(result){
            everydayData = JSON.parse(result)['everydaydata'];
            everydayhData = everydayData['hdata'];
            everydaywData = everydayData['wdata'];
            everydayfData = everydayData['fdata'];
            everydaymData = everydayData['mdata'];

            var tempdata = new Array();
            for(i = 0; i<everydayhData.length; i++)
            {
               if(!everydayhData[i]) continue;
               var parts =everydayhData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:everydayhData[i].y};
            }
            everydayData['hdata'] = tempdata;
            var tempdata = new Array();
            for(i = 0; i<everydaywData.length; i++)
            {
               if(!everydaywData[i]) continue;
               var parts =everydaywData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:everydaywData[i].y};
            }
            everydayData['wdata'] = tempdata;
            var tempdata = new Array();
            for(i = 0; i<everydayfData.length; i++)
            {
               if(!everydayfData[i]) continue;
               var parts =everydayfData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:everydayfData[i].y};
            }
            everydayData['fdata'] = tempdata;
            var tempdata = new Array();
            for(i = 0; i<everydaymData.length; i++)
            {
               if(!everydaymData[i]) continue;
               var parts =everydaymData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:everydaymData[i].y};
            }
            everydayData['mdata'] = tempdata;

            weekData = JSON.parse(result)['week'];
            weekhData = weekData['hdata'];
            weekwData = weekData['wdata'];
            weekfData = weekData['fdata'];
            weekmData = weekData['mdata'];
            var tempdata = new Array();
            for(i = 0; i<weekhData.length; i++)
            {
               if(!weekhData[i]) continue;
               var parts =weekhData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:weekhData[i].y};
            }
         
            weekData['hdata'] = tempdata;

            var tempdata = new Array();
            for(i = 0; i<weekwData.length; i++)
            {
               if(!weekwData[i]) continue;
               var parts =weekwData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:weekwData[i].y};
            }
            weekData['wdata'] = tempdata;

            var tempdata = new Array();
            for(i = 0; i<weekfData.length; i++)
            {
               if(!weekfData[i]) continue;
               var parts =weekfData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:weekfData[i].y};
            }
            weekData['fdata'] = tempdata;
            var tempdata = new Array();
            for(i = 0; i<weekmData.length; i++)
            {
               if(!weekmData[i]) continue;
               var parts =weekmData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:weekmData[i].y};
            }
            weekData['mdata'] = tempdata;

            monthlyData = JSON.parse(result)['month'];
            monthlyhData = monthlyData['hdata'];
            monthlywData = monthlyData['wdata'];
            monthlyfData = monthlyData['fdata'];
            monthlymData = monthlyData['mdata'];
            var tempdata = new Array();
            for(i = 0; i<monthlyhData.length; i++)
            {
               if(!monthlyhData[i]) continue;
               var parts =monthlyhData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:monthlyhData[i].y};
            }
         
            monthlyData['hdata'] = tempdata;

            var tempdata = new Array();
            for(i = 0; i<monthlywData.length; i++)
            {
               if(!monthlywData[i]) continue;
               var parts =monthlywData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:monthlywData[i].y};
            }
            monthlyData['wdata'] = tempdata;

            var tempdata = new Array();
            for(i = 0; i<monthlyfData.length; i++)
            {
               if(!monthlyfData[i]) continue;
               var parts =monthlyfData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:monthlyfData[i].y};
            }
            monthlyData['fdata'] = tempdata;
            var tempdata = new Array();
            for(i = 0; i<monthlymData.length; i++)
            {
               if(!monthlymData[i]) continue;
               var parts =monthlymData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:monthlymData[i].y};
            }
            monthlyData['mdata'] = tempdata;

            yearData = JSON.parse(result)['year'];

            yearhData = yearData['hdata'];
            yearwData = yearData['wdata'];
            yearfData = yearData['fdata'];
            yearmData = yearData['mdata'];
            var tempdata = new Array();
            for(i = 0; i<yearhData.length; i++)
            {
               if(!yearhData[i]) continue;
               var parts = yearhData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:yearhData[i].y};
            }
         
            yearData['hdata'] = tempdata;

            var tempdata = new Array();
            for(i = 0; i<yearwData.length; i++)
            {
               if(!yearwData[i]) continue;
               var parts =yearwData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:yearwData[i].y};
            }
            yearData['wdata'] = tempdata;

            var tempdata = new Array();
            for(i = 0; i<yearfData.length; i++)
            {
               if(!yearfData[i]) continue;
               var parts =yearfData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:yearfData[i].y};
            }
            yearData['fdata'] = tempdata;
            var tempdata = new Array();
            for(i = 0; i<yearmData.length; i++)
            {
               if(!yearmData[i]) continue;
               var parts =yearmData[i].x.split('-');
               tempdata[i] = {x:new Date(parts[0], parts[1] - 1, parts[2]),y:yearmData[i].y};
            }
            yearData['mdata'] = tempdata;
         drawGraph();

      });
      
   });



   function drawGraph() {

      var hdata;
      var wdata;
      var mdata;
      var fdata;
      var valueFormatString;
      switch(tabId)
      {
         case 1:
         {
               hdata = everydayData['hdata'];
               wdata = everydayData['wdata'];
               fdata = everydayData['fdata'];
               mdata = everydayData['mdata'];
               valueFormatString = "DD MMM";
               break;
         }
         case 2:
         {
               hdata = weekData['hdata'];
               wdata = weekData['wdata'];
               fdata = weekData['fdata'];
               mdata = weekData['mdata'];
               valueFormatString = "";
               break;
         }
         case 3:
         {
               hdata = monthlyData['hdata'];
               wdata = monthlyData['wdata'];
               fdata = monthlyData['fdata'];
               mdata = monthlyData['mdata'];
               valueFormatString = "MMM";
               break;  
         }
         case 4:
         {
               hdata = yearData['hdata'];
               wdata = yearData['wdata'];
               fdata = yearData['fdata'];
               mdata = yearData['mdata'];
               valueFormatString = "YYY";
            break; 
         }

      }
      var charth = new CanvasJS.Chart("height", {
         theme: "light2",
         title:{
               text: "身長"
         },
         axisX:{
               valueFormatString: "DD MMM",
               crosshair: {
                  enabled: true,
                  snapToDataPoint: true
               }
         },
         axisY: {
               title: "",
               includeZero: true,
               crosshair: {
                  enabled: true
               }
         },
         toolTip:{
               shared:true
         },
         data: [{
               type: "line",
               markerType: "square",
               color: "#F08080",
               dataPoints: hdata
         }]
      });
      charth.render();

      var chartw = new CanvasJS.Chart("weight", {
         theme: "light2",
         title:{
               text: "体重"
         },
         axisX:{
               valueFormatString: "DD MMM",
               crosshair: {
                  enabled: true,
                  snapToDataPoint: true
               }
         },
         axisY: {
               title: "",
               includeZero: true,
               crosshair: {
                  enabled: true
               }
         },
         toolTip:{
               shared:true
         },
         data: [{
               type: "line",
               markerType: "square",
               color: "#F08080",
               dataPoints: wdata
         }]
      });
      chartw.render();

      var chartf = new CanvasJS.Chart("fat", {
         theme: "light2",
         title:{
               text: "除脂肪量"
         },
         axisX:{
               valueFormatString: "DD MMM",
               crosshair: {
                  enabled: true,
                  snapToDataPoint: true
               }
         },
         axisY: {
               title: "",
               includeZero: true,
               crosshair: {
                  enabled: true
               }
         },
         toolTip:{
               shared:true
         },
         data: [{
               type: "line",
               markerType: "square",
               color: "#F08080",
               dataPoints: fdata
         }]
      });
      chartf.render();


      var chartm = new CanvasJS.Chart("muscle", {
         theme: "light2",
         title:{
               text: "筋肉量"
         },
         axisX:{
               valueFormatString: "DD MMM",
               crosshair: {
                  enabled: true,
                  snapToDataPoint: true
               }
         },
         axisY: {
               title: "",
               includeZero: true,
               crosshair: {
                  enabled: true
               }
         },
         toolTip:{
               shared:true
         },
         data: [{
               type: "line",
               markerType: "square",
               color: "#F08080",
               dataPoints: mdata
         }]
      });
      chartm.render();
      
   }

   function toogleDataSeries(e){
      if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
         e.dataSeries.visible = false;
      } else{
         e.dataSeries.visible = true;
      }
      chart.render();
   }

   function everyday()
   {
      tabId = 1;
      drawGraph();
   }

   function week()
   {
      tabId = 2;
      drawGraph();
   }

   function month()
   {
      tabId = 3;
      drawGraph();
   }

   function year()
   {
      tabId = 4;
      drawGraph();
   }
</script>
@isset($userid)
   <input id="userid" type="hidden" value="{{$userid}}">
@endisset
<<<<<<< HEAD
=======
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
                        <a href="index.html">
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

      <!--begin::Container-->
      <div class="container">
         <!--begin::Dashboard-->
         <!--begin::Row-->
         <div class="row">
            <div class="col-xl-12">
               <!--begin::Tiles Widget 1-->
                  <div class="card card-custom gutter-b card-stretch">
                  <!--begin::Body-->
                     <div id="board" class="card-body d-flex flex-column px-0"
                     style="text-align: center; min-height:400px">
                        <div>
                           <h1 id="board" class="headBtn">からだの変化</h1> 
                        </div>
                     <div class="example-preview">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" onclick="everyday();">
                                    <span class="nav-icon">
                                          <i class="flaticon2-layers-1"></i>
                                    </span>
                                    <span class="nav-text" style="font-size: 28px">日</span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" onclick="week();" aria-controls="profile">
                                    <span class="nav-icon">
                                          <i class="flaticon2-layers-1"></i>
                                    </span>
                                    <span class="nav-text" style="font-size: 28px">週</span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" onclick="month();" aria-controls="profile">
                                    <span class="nav-icon">
                                          <i class="flaticon2-layers-1"></i>
                                    </span>
                                    <span class="nav-text" style="font-size: 28px">月</span>
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" onclick="year();" aria-controls="profile">
                                    <span class="nav-icon">
                                          <i class="flaticon2-layers-1"></i>
                                    </span>
                                    <span class="nav-text" style="font-size: 28px">年</span>
                                 </a>
                              </li>
                        </ul>

                        <div id="height" style="margin-top:50px;height: 200px; width: 100%;"></div>

                        <div id="weight" style="margin-top:50px;height: 200px; width: 100%;"></div>
                        <div id="fat" style="margin-top:50px;height: 200px; width: 100%;"></div>            
                        <div id="muscle" style="margin-top:50px;height: 200px; width: 100%;"></div>	      
                        
                        <div style="text-align: right;padding-right: 100px;margin-top: 10px;">
                           <div>
                           @isset($userid)
                              <a href="/playerlist"><span class="btn btn-primary btn-lg"
                                    style="border-radius: 5px; min-width: 100px">return</span></a>
                           @else
                              <a href="/nextMeal"><span class="btn btn-primary btn-lg"
                                    style="border-radius: 5px; min-width: 100px">Next</span></a>
                           @endisset
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
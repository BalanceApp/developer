@extends('app')
@section('title', '先頭ページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
        
    function senddata(){
        var checkbox = document.getElementsByName("users");
        var diet = document.getElementById("saveDiet");
        var change = document.getElementById("saveChange");
        var startyear = document.getElementById("startyear").value;
        var endyear = document.getElementById("endyear").value;
        var userlist = new Array();
        var dietData = diet.checked ? 1 : 0;
        var changeData= change.checked ? 1 : 0;

        for(var i=0; i<checkbox.length;i++)
        {
            if(checkbox[i].checked)
            {
            
                userlist.push(checkbox[i].id);
            }
        }
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.post("/saveCSV",{
            startyear:startyear,
            endyear:endyear,
            userlist:userlist,
            dietData:dietData,
            changeData:changeData
        },function sucess(response){
            const data = JSON.parse(response);
            for(i=0;i<data.length; i++)
            {
                url=  "{{url('/')}}/CSV/" + data[i];
                const link = document.createElement('a');
                 link.setAttribute('href', url);
                 link.setAttribute('download', data[i]);
                 link.click();    
            }
            
                       
        });

    }

    function setall()
    {
    var allcheck=document.getElementById("allcheck");
    var checkbox = document.getElementsByName("users");
        if(allcheck.checked)
        {
            for(var i=0; i<checkbox.length;i++)
            {
                checkbox[i].checked=true;                
            }
        }
        else
        {
            for(var i=0; i<checkbox.length;i++)
            {
                checkbox[i].checked=false;                
            }
        }
    }


</script>
<<<<<<< HEAD
=======
<div id="home">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile">
        <!--begin::Logo-->
        <a href="{{url('/')}}">
            <img alt="Logo" src="{{ asset('others/assets/media/logos/logo_black.png')}}" class="logo-default max-h-30px" />
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
                                    <div class="card card-custom gutter-b card-stretch" id="kt_page_stretched_card">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex flex-column px-0"
                                            style="text-align: center; min-height:400px">
                                            <div class="row col-md-12">
                                                <h1 class="headBtn col-sm-4"
                                                    style="border-style: solid solid solid solid; margin-left: 3%">ページ12
                                                    csv出力選択画面</h1>
                                            </div>
                                            <form method="POST" class="form" action="{{ url('/userinfocheck') }}" id="kt_login_signin_form">
                                                @csrf
                                                <div class="row col-md-12" style="margin-left:10%; margin-top: 50px">
                                                    <a style="padding-top:10px">期間</a>
                                                    <div class="col-md-3">
                                                        <input id ="startyear" class="form-control" type="text" name="">
                                                    </div>
                                                    <a style="padding-top:10px">年</a>
                                                    <a style="float: right; margin-left: 50px;">
                                                    <a style="padding-top:10px"> ~ </a>
                                                    <div class="col-md-3" style="margin-left:5%">
                                                        <input id="endyear" class="form-control" type="text" name="">
                                                    </div>
                                                    <a style="padding-top:10px">年</a>
                                                </div>
                                                <div class="card-scroll col-md-12" id="staffinfo" style="font-size:18px; margin-left: 10%;margin-top: 50px">
                                                    <div class="container">
                                                    <h3 style="text-align:left">選手</h3>
                                                        <div class="row col-md-12">
                                                            @isset($stafflist)
                                                                @foreach($stafflist as $value)
                                                                <div class="row col-md-4">
                                                                    <div> <input name="users" id="{{$value->userid}}" type="checkbox"> 
                                                                    </div>
                                                                    <div style="margin-left: 10%; text-decoration:underline">
                                                                        {{ $value->name }} 
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @endisset
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-left: 80%">
                                                    <input id="allcheck" type="checkbox" class="" style="margin-top:3px" onclick="setall()"> 
                                                    <a style="margin-left: 5%">全て選択</a>
                                                </div>
                                                <div class="row" style="margin-left: 10%;margin-top:10px">
                                                    <h3 style="margin-left: 15%">項目</h3>
                                                    <input id="saveDiet" type="checkbox" class="" style="margin-top:5px; margin-left:5%"> 
                                                    <h3 style="margin-left: 1%; text-decoration:underline">食事チェック結果</h3>
                                                    <input id="saveChange" type="checkbox" class="" style="margin-top:5px; margin-left:10%"> 
                                                    <h3 style="margin-left: 1%; text-decoration:underline">からだの変化</h3>
                                                </div>
                                                <div style="display: block;margin-top: 10px;margin-left: 80%">
                                                    <a href="#" class="nextBtn" onclick="senddata()" style="text-decoration:underline;font-size:18px">ダウンロード</a>
                                                </div>
                                            </form>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Tiles Widget 1-->
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--end::Dashboard-->
                        </div>
 
    @stop
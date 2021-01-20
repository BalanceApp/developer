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

        // console.log("player",checkbox);
        if (userlist.length < 1 ) {
            alert("プレイヤーを選択してください。");
            return false;
        }

        else if(startyear == "" || endyear =="") {
            alert("csv出力期間を正しく入力してください。");
            return false;
        }

        else if(!diet.checked && !change.checked) {
            alert("csv出力項目を選択してください。");
            return false;
        }

        else {

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
                        <div class="col-md-12">
                            <h1 class="headBtn col-sm-4"
                                style="border-style: solid solid solid solid; margin-left: 3%">
                                csv出力選択画面</h1>
                        </div>
                        <form method="POST" class="form" action="{{ url('/userinfocheck') }}" id="kt_login_signin_form">
                            @csrf
                            <div class="row container"> 
                                <h3 class="col-md-1" style="padding-top:10px;text-align:center;">期間</h3>
                                <div class="col-md-2">
                                    <input id ="startyear" class="form-control" type="date" name="">
                                </div>
                                <p class="col-md-1" style="padding-top:10px">年</p> 
                                <p class="col-md-1" style="padding-top:10px"> ~ </p>
                                <div class="col-md-3">
                                    <input id="endyear" class="form-control" type="date" name="">
                                </div>
                                <p class="col-md-1" style="padding-top:10px">年</p> 
                            </div>
                            <div class="card-scroll col-md-12" id="staffinfo" style="font-size:18px; margin-left: 10%;margin-top: 50px">
                                <div class="container">
                                    <h3 style="text-align:left">選手</h3>
                                    <div class="man-list row">
                                        @isset($stafflist)
                                            @foreach($stafflist as $value)
                                                <div class="col-lg-6 col-md-6 col-sm-6" style="text-decoration:underline; text-align: left;">
                                                    <input name="users" id="{{$value->userid}}" type="checkbox" style="margin-right: 10px;">
                                                    {{ $value->name }}
                                                </div>
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: end;padding:30px;">
                                <input id="allcheck" type="checkbox" style="margin-top:3px" onclick="setall()">
                                <a style="margin-left: 5%">全て選択</a>
                            </div>
                            <div class="row">
                                <h3 class="col-lg-1 col-md-1 col-sm-1" style="text-align: start;padding-left: 40px;">項目</h3>
                                <div class="col-lg-2 col-md-2 col-sm-2" style="display:flex;margin-left: 40px;">
                                    <input id="saveDiet" type="checkbox" style="margin-top: 3px;margin-right: 13px;">
                                    <h3>食事チェック結果</h3>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2" style="display:flex;margin-left: 40px;">
                                    <input id="saveChange" type="checkbox" style="margin-top: 3px;margin-right: 13px;">
                                    <h3 style="text-decoration:underline">からだの変化</h3>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2" style="display:flex;margin-left: 40px;">
                                    <input id="changeData" type="checkbox" style="margin-top: 3px;margin-right: 13px;">
                                    <h3 style="text-decoration:underline">入力未修正データ</h3>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3" style="display:flex;margin-left: 40px;">
                                    <input id="evaluatedData" type="checkbox" style="margin-top: 3px;margin-right: 13px;">
                                    <h3 style="text-decoration:underline">栄養評価式による得点</h3>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: end;margin-right: 35px;margin-top: 10px;">
                                <a href="#" class="nextBtn make-csv" onclick="senddata()">ダウンロード</a>
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

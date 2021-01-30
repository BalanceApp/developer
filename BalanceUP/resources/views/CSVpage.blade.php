@extends('app')
@section('title', 'CSVダウンロードページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    function senddata() {
        let users = document.getElementsByName("users");
        let changeBody = document.getElementById("changeBody");
        let foodInput = document.getElementById("foodInput");
        let nutritionScore = document.getElementById("nutritionScore");
        let startyear = document.getElementById("startyear").value;
        let endyear = document.getElementById("endyear").value;

        let userlist = [];
        let changeBodyCheck = changeBody.checked ? 1 : 0;
        let foodInputCheck = foodInput.checked ? 1 : 0;
        let nutritionScoreCheck = nutritionScore.checked ? 1 : 0;
        
        for (let i = 0; i < users.length; i++) {
            if (users[i].checked) {

                userlist.push(users[i].id);
            }
        }

        if (userlist.length < 1) {
            alert("プレイヤーを選択してください。");
            return false;
        }

        else if (startyear == "" || endyear == "") {
            alert("csv出力期間を正しく入力してください。");
            return false;
        }

        else if(!changeBodyCheck && !foodInputCheck && !nutritionScoreCheck) {
            alert("csv出力項目を選択してください。");
            return false;
        }

        else {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.post("/saveCSV", {
                startyear: startyear,
                endyear: endyear,
                userlist: userlist,
                changeBodyCheck:changeBodyCheck,
                foodInputCheck:foodInputCheck,
                nutritionScoreCheck:nutritionScoreCheck
            }, function sucess(response) {
                const data = JSON.parse(response);
                for(i=0;i<data.length; i++){
                    url=  "{{url('/')}}/CSV/" + data[i];
                    const link = document.createElement('a');
                    link.setAttribute('href', url);
                    link.setAttribute('download', data[i]);
                    link.click();
                }
            }
            );
        }

    }

    function setall() {
        let allcheck = document.getElementById("allcheck");
        let checkbox = document.getElementsByName("users");
        if (allcheck.checked) {
            for (let i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = true;
            }
        }
        else {
            for (let i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = false;
            }
        }
    }


</script>

<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-custom gutter-b card-stretch" id="kt_page_stretched_card">
                <div class="card-body d-flex flex-column px-0" style="text-align: center; min-height:400px">
                    <h1 class="headBtn col-sm-4" style="border-style: solid solid solid solid; margin-left: 3%">
                        csv出力選択画面</h1>
                    <form method="POST" class="form" action="{{ url('/userinfocheck') }}" id="kt_login_signin_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="mt-3">期間</h3>
                            </div>
                            <div class="col-md-3">
                                <input id="startyear" class="form-control" type="date" name="">
                            </div>
                            <div class="col-md-1">
                                <h1 class="mt-1"> ~ </h1>
                            </div>
                            <div class="col-md-3">
                                <input id="endyear" class="form-control" type="date" name="">
                            </div>
                        </div>
                        <div class="row mt-20" id="staffinfo">
                            <div class="col-md-2">
                                <h3>選手</h3>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    @isset($playerlist)
                                    @foreach($playerlist as $value)
                                    <div class="col-md-2 mt-1">
                                        <input name="users" id="{{$value->userid}}" type="checkbox">
                                        <span class="h4">{{ $value->name }}</span>
                                    </div>
                                    @endforeach
                                    @endisset
                                </div>
                            </div>
                            <div class="col-md-2 mt-1">
                                <input id="allcheck" type="checkbox" onclick="setall()">
                                <span class="h4">全て選択</span>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <h3 class="col-md-2">項目</h3>
                            <div class="col-md-8 mt-1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="changeBody" type="checkbox">
                                        <span class="h4"><u>からだの変化</u></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="foodInput" type="checkbox">
                                        <span class="h4"><u>入力未修正データ</u></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="nutritionScore" type="checkbox">
                                        <span class="h4"><u>栄養評価式による得点</u></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-md-12">
                                <a href="#" class="nextBtn make-csv" onclick="senddata()">ダウンロード</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
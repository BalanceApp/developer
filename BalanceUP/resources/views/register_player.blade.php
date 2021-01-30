@extends('app')
@section('title', 'アカウント作成')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    function validateform()
	{
		if($('#name').val()=="" || $('#userid').val()=="" || $('#password').val()=="")
		{
			$('#error').html("名前、ログインID、パスワードを入力してください");
			return false;
		}
		else{
			$('#submit').click();
		}
	}

	function clearerror()
	{
		$('#error').html("");
	}
</script>

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
                <div class="card-body d-flex flex-column px-0" style="text-align: center; min-height:400px">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="login-signin">
                                <div class="mb-20">
                                    <h3>アカウント作成</h3>
                                </div>

                                <form method="POST" class="form" action="{{ url('/store-player') }}"
                                    id="kt_login_signin_form">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        <div class="col-lg-8 col-md-8 col-sm-8" style="text-align:start;">
                                            <label for="name">名前<span
                                                    style="color:red; padding-right:40px;">*</span></label>
                                            <input class="m-input" onclick="clearerror();" type="text" id="name"
                                                name="name">
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;" class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        <div class="col-lg-8 col-md-8 col-sm-8" style="text-align:start;">
                                            <label for="birthday" style="padding-right:20px;">生年月日</label>
                                            <input class="m-input" type="date" id="birthday" name="birthday"
                                                style="padding: 7px 4px;">
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;" class="form-group row">
                                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        <div class="col-lg-8 col-md-8 col-sm-8" style="text-align:start;">
                                            <label style="padding-right:40px;">性別</label>
                                            <div class="form-check-inline">
                                                <label class="radio py-4 form-check-label" for="male">
                                                    <input type="radio" checked name="sex" id="male"
                                                        class="form-check-input">
                                                    <span></span>男</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="radio form-check-label" for="female">
                                                    <input type="radio" name="sex" id="female" class="form-check-input">
                                                    <span></span>女</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px;" class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        <div class="col-lg-8 col-md-8 col-sm-8" style="text-align:start;">
                                            <label for="sport" style="padding-right:48px;">競技</label>
                                            <input class="m-input" type="text" id="sport" name="sport">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        <label class="col-lg-8 col-md-8 col-sm-8"
                                            style="text-align:start;">食物アレルギー</label>
                                    </div>
                                    <div style="margin-top: 20px;" class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                                        <table class="col-lg-8 col-md-8 col-sm-8 check-list">
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="shrimp">
                                                    <span>えび</span>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="crab" class="margin-top-6">
                                                    <span></span>かに
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="margin-top-6">
                                                    <span></span>小麦
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="soba" class="margin-top-6">
                                                    <span></span>そば
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="milk" class="margin-top-6">
                                                    <span></span>乳
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="egg" class="margin-top-6">
                                                    <span></span>卵
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="squid" class="margin-top-6">
                                                    <span></span>いか
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="orange" class="margin-top-6">
                                                    <span></span>オレンジ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="beef" class="margin-top-6">
                                                    <span></span>牛肉
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="salmon" class="margin-top-6">
                                                    <span></span>さけ
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="mackerel" class="margin-top-6">
                                                    <span></span>さば
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="soybeans" class="margin-top-6">
                                                    <span></span>大豆
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="chicken" class="margin-top-6">
                                                    <span></span>鶏肉
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="banana" class="margin-top-6">
                                                    <span></span>バナナ
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="pork" class="margin-top-6">
                                                    <span></span>豚肉
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="peache" class="margin-top-6">
                                                    <span></span>もも
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-6"
                                            style="margin-top: 20px;text-align:start;">
                                            <label for="refer-input">※その他の方のみ入力</label>
                                            <input class="m-input" type="text" id="refer-input" name="refer-input"
                                                style="width: 50%;">
                                        </div>
                                    </div>
                                    <div style="margin-top: 40px;" class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        <label class="col-lg-2 col-md-2 col-sm-2"
                                            style="text-align:start;">ログイン情報</label>
                                        <input onclick="clearerror();" type="text"
                                            class="m-input col-lg-3 col-md-3 col-sm-3" id="userid" name="userid"
                                            placeholder="ID">
                                        <div class="col-lg-2 col-md-2 col-sm-2" style="margin-top: 20px;"></div>
                                        <input onclick="clearerror();" type="password"
                                            class="m-input col-lg-3 col-md-3 col-sm-3" id="password" name="password"
                                            placeholder="PW">
                                    </div>
                                    <div style="display: block;margin-top: 40px;">
                                        <button type="submit" id="submit" style="display: none;"></button>
                                        <center>
                                            <p id="error" style="color: red; padding: 20px;"></p>
                                        </center>
                                        <a onclick="validateform();"
                                            class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">アカウント作成</a>
                                    </div>

                                </form>
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
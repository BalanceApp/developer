@extends('app')
@section('title', 'ログイン')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>

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
						<div class="col-sm-3"></div>
						<div class="col-sm-6">
							<div class="login-signin">
								<div class="mb-20">
									<h3>ログイン</h3>
									<!-- <div class="text-muted font-weight-bold">Enter your details to login
																to your account:</div> -->
								</div>

								<center>
									<p id="error" style="color: #0c3392; padding: 20px;"></p>
								</center>
								@isset($data_erro)
								<center>
									<p id="unkown" style="color: #0c3392; padding: 20px;">{{ $data_erro }}</p>
								</center>
								@endisset
								<form method="POST" class="form" action="{{ url('/login-staff') }}"
									id="kt_login_signin_form">
									@csrf
									<div class="form-group mb-5">
										<input onclick="clearerror();"
											class="form-control h-auto form-control-solid py-4 px-8" type="text"
											placeholder="ID" name="userid" id="username" autocomplete="off" />
									</div>
									<div class="form-group mb-5">
										<input onclick="clearerror();"
											class="form-control h-auto form-control-solid py-4 px-8" type="password"
											placeholder="PW" name="password" id="password" />
									</div>
									<button type="submit" id="submit" style="display: none;"></button>
									<a id="kt_login_signin_submit" onclick="validateform();"
										class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">ログイン</a>
								</form>
								<div class="mt-10">
									<span class="text-muted mr-2">初めての方</span>
									<a href="/register-staff" id="kt_login_signup" class="font-weight-bold">アカウント作成</a>
								</div>
							</div>
						</div>
						<div class="col-sm-3"></div>
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
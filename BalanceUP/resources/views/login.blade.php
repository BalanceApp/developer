@extends('app')
@section('title', 'ログイン')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>
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
				<div class="card-body d-flex flex-column px-0"
					style="text-align: center; min-height:400px">
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-6">
							<div class="login-signin">
								<div class="mb-20">
									<h3>ログイン</h3>
									<!-- <div class="text-muted font-weight-bold">Enter your details to login
										to your account:</div> -->
								</div>
								
								<center><p id="error" style="color: #0c3392; padding: 20px;"></p></center>
								@isset($data_erro)
									<center><p id="unkown" style="color: #0c3392; padding: 20px;">{{ $data_erro }}</p></center>
								@endisset
								<form method="POST" class="form" action="{{ url('/check') }}"
									id="kt_login_signin_form">
									@csrf
									<div class="form-group mb-5">
										<input
											onclick="clearerror();" class="form-control h-auto form-control-solid py-4 px-8"
											type="text" placeholder="ID" name="userid" id="username"
											autocomplete="off" />
									</div>
									<div class="form-group mb-5">
										<input
											onclick="clearerror();" class="form-control h-auto form-control-solid py-4 px-8"
											type="password" placeholder="PW" name="password" id="password"/>
									</div>
									<button type="submit" id="submit" style="display: none;"></button>
									<a id="kt_login_signin_submit" onclick="validateform();"
										class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">ログイン</a>
								</form>
								<div class="mt-10">
									<span class="text-muted mr-2">初めての方</span>
									<a href="/register" id="kt_login_signup" class="font-weight-bold">アカウント作成</a>
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
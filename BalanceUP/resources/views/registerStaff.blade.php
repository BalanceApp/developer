@extends('app')
@section('title', 'アカウント作成')
@section('content')
<script src="asset('js/jquery.min.js')}}"></script>
<script>
	function validateform()
	{
		if($('#userid').val()=="" || $('#userid').val()=="" || $('#password').val()=="")
		{
			$('#error').html("名、ログイン識別子、パスワードを入力してください名とパスワードを入力してください");
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
				<br>
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
										<div class="card-body d-flex flex-column px-0"
											style="text-align: center; min-height:400px">
											<div class="row">
												<div class="col-sm-12">
													<div class="login-signin">
														<div class="mb-20">
															<h3>アカウント作成</h3>
															<!-- <div class="text-muted font-weight-bold">Enter your details to login
																to your account:</div> -->
														</div>
														
														<form method="POST" class="form" action="{{ url('/staffinfocheck') }}" id="kt_login_signin_form">
                                                            @csrf
															<div style="display: block;margin-top: 60px; padding-left: 30px;">
																<div style="display: flex;" class="row">
																		<label for="name" class="col-sm-3 py-4 px-8 h-auto text-right">名前<span style="color:red">*</span></label>
																		<input onclick="clearerror();" type="text" class="col-sm-4 form-control h-auto form-control-solid py-4 px-8" id="name" name="name" placeholder="name">
																</div>
																<div style="display: flex;margin-top: 20px;" class="row">
																		<label for="birthday" class="col-sm-3 py-4 px-8 h-auto text-right">生年月日</label>
																		<input type="date" class="col-sm-4 form-control h-auto form-control-solid py-4 px-8" id="birthday" name="birthday" placeholder="">
																</div>
																<div style="display: flex;margin-top: 20px;" class="form-group row">
																		<label class="col-sm-3 py-4 px-8 text-right">性別</label>
																		<div class="form-check-inline">
																			<label class="radio py-4 form-check-label" for="male">
																			<input type="radio" checked name="sex" id="male" class="py-4 px-8 form-check-input">
																			<span></span>男</label>
																		</div>
																		<div class="form-check-inline">
																			<label class="radio py-4 px-8 form-check-label" for="female">
																			<input type="radio" name="sex" id="female" class="py-4 px-8 form-check-input">
																			<span></span>女</label>
																		</div>
																</div> 
																<div style="display: flex;margin-top: 20px;" class="form-group row">
																		<label class="col-sm-3 py-4 px-8 text-right">ログイン情報</label>
																		<input onclick="clearerror();" type="text" class="col-sm-2 form-control h-auto form-control-solid py-4 px-8" id="userid" name="userid" placeholder="ID">
																		<input onclick="clearerror();" type="password" class="col-sm-2 form-control h-auto form-control-solid py-4 px-8" style="margin-left: 20px;" id="password" name="password" placeholder="PW">
																</div>
																<div style="display: block;margin-top: 50px;">
																		<button type="submit" id="submit" style="display: none;"></button>
																		<center><p id="error" style="color: red; padding: 20px;"></p></center>
																		<a onclick="validateform();" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Next</a>
																</div> 
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
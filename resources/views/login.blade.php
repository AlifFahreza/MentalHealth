<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mental Health</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form" action="{{url('proses_login')}}" method="POST" id="logForm">

					<span class="login100-form-title p-b-55">
						Login
					</span>

					<div class="wrap-input100 m-b-16">
					{{ csrf_field() }}
                    @if(session('message'))
                    <div class="alert alert-danger alert-dismissable show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>x</span>
                            </button>
                            {{session('message')}}
                        </div>
                    </div>
                    @endif
					</div>

					<div class="wrap-input100 m-b-16">
					{{ csrf_field() }}
                    @if(session('berhasil'))
                    <div class="alert alert-success alert-dismissable show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>x</span>
                            </button>
                            {{session('berhasil')}}
                        </div>
                    </div>
                    @endif
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
						@if($errors->has('email'))
                            <span class="error">{{ $errors->first('email') }}</span>
                        @endif
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
						@if($errors->has('password'))
                            <span class="error">{{ $errors->first('password') }}</span>
                        @endif
					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-115">
						<span class="txt1">
							Not a member?
						</span>

						<a class="txt1 bo1 hov1" href="{{ route('sign-up') }}">
							Sign up now							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/js/main.js"></script>

</body>
</html>
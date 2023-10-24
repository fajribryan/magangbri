<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="{{ asset ('/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/fonts/iconic/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/select2/select2.min.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/css/main.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="/register" method="POST">
					@csrf
					<span class="login100-form-title p-b-26">
						Registrasi
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nama">
						<span class="focus-input100" data-placeholder="Nama"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="pn">
						<span class="focus-input100" data-placeholder="Personal Number"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="perusahaan">
						<span class="focus-input100" data-placeholder="Perusahaan"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="tim">
						<span class="focus-input100" data-placeholder="Team"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="jabatan">
						<span class="focus-input100" data-placeholder="Jabatan"></span>
					</div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="nama_kc">
                        <span class="focus-input100" data-placeholder="Nama KC"></span>
                    </div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="kode_kc">
						<span class="focus-input100" data-placeholder="KODE KC"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nama_uko">
						<span class="focus-input100" data-placeholder="Nama UKO"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="kode_uko">
						<span class="focus-input100" data-placeholder="KODE UKO"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nama_ro">
						<span class="focus-input100" data-placeholder="Nama RO"></span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="kode_ro">
						<span class="focus-input100" data-placeholder="KODE RO"></span>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Register
							</button>
						</div>
					</div>

					<div class="text-center p-t-30">
						<span class="txt1">
							Sudah punya akun?
						</span>

						<a class="txt2" href="/login">
							Silahkan Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset ('/js/main.js') }}"></script>

</body>
</html>
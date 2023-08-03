<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="">
			<meta name="author" content="">
			<title>Login</title>
			<!-- Custom fonts for this template-->
			<link href="<?php echo base_url( "resources/vendor/fontawesome-free/css/all.min.css");?>" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
			<!-- Custom styles for this template-->
			<link href="<?php echo base_url("resources/css/sb-admin-2.css");?>" rel="stylesheet">
		</head>
		<body class="bg-gradient-success">
			<br>
			<br>
			<br>
			<div class="container ">
				<!-- Outer Row -->
				<div class="row justify-content-center">
					<div class="col-xl-10 col-lg-12 col-md-9">
						<div class="card o-hidden border-0 shadow-lg my-5">
							<div class="card-body p-0">
								<!-- Nested Row within Card Body -->
								<div class="row">
									<div class="col-lg-6 d-none d-lg-block bg-login-image">
										<center>
											<img src="<?php echo base_url(); ?>/resources/img/01.jpg" width="90%" height="100%"/>
										</center>

									</div>
									<div class="col-lg-6">
										<div class="p-5">
											<div class="text-center">
												<h1 class="h4 text-gray-900 mb-4">BIENVENIDO</h1>
											</div>
											<form  method="post" action="" name="frmLogin" id="frmLogin">
												<div class="form-group">
													<input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingresar Usuario..." name="usuario">
												</div>
												<div class="form-group">
													<input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Ingresar Contraseña" name="contra" required="true">
												</div>
												<input type="submit" value="Iniciar Sesion" name="btnLogin" class="btn btn-primary btn-user btn-block">
												<hr>
												<a href="<?php echo site_url("Contrasenia")?>" class="btn btn-google btn-user btn-block">
													<i class=" btn-btn-user btn-danger"></i> Olvide mi contraseña
												</a>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Bootstrap core JavaScript-->
			<script src="<?php echo base_url("resources/vendor/jquery/jquery.min.js");?>"></script>
			<script src="<?php echo base_url("resources/vendor/bootstrap/js/bootstrap.bundle.min.js");?>"></script>
			<!-- Core plugin JavaScript-->
			<script src="<?php echo base_url("resources/vendor/jquery-easing/jquery.easing.min.js");?>"></script>
			<!-- Custom scripts for all pages-->
			<link href="<?php echo base_url("resources/css/sb-admin-2.css");?>" rel="stylesheet">
		</body>
	</html>

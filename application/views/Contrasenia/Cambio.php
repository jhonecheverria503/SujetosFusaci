<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="">
			<meta name="author" content="">
			<title>Login</title>
			<link href="<?php echo base_url( "resources/vendor/fontawesome-free/css/all.min.css");?>" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
			<link href="<?php echo base_url("resources/css/sb-admin-2.css");?>" rel="stylesheet">
		</head>
		<body class="bg-gradient-success">
			<br>
			<br>
			<br>
			<div class="container ">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-lg-12 col-md-9">
						<div class="card o-hidden border-0 shadow-lg my-5">
							<div class="card-body p-0">
								<div class="row">
									<div class="col-lg-6 d-none d-lg-block bg-login-image">
										<img src="<?php echo base_url(); ?>/resources/img/01.jpg" width="100%" height="90%"/>
									</div>
									<div class="col-lg-6">
										<div class="p-5">
											<div class="text-center">
												<h1 class="h4 text-gray-900 mb-4">CAMBIO DE CONTRASEÑA</h1>
											</div>
											<div class="form-group">
												<label for="cliente" class="control-label">Ingrese el código que ha sido enviado a su correo</label>
												<textarea id="txtToken" name="txtToken" class="form-control" rows="5"></textarea>
											</div>
											<div class="form-group">
												<br>
											</div>
											<hr>
											<input type="button" id="btnModal" value="Cambiar Contraseña" class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#cambioContrasenaModal" disabled>
											<a href="<?php echo site_url("Login")?>" class="btn btn-google btn-user btn-block">
												<i class=" btn-btn-user btn-danger"></i> Cancelar
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script src="<?php echo base_url("resources/vendor/jquery/jquery.min.js");?>"></script>
			<script src="<?php echo base_url("resources/vendor/bootstrap/js/bootstrap.bundle.min.js");?>"></script>
			<script src="<?php echo base_url("resources/vendor/jquery-easing/jquery.easing.min.js");?>"></script>
			<link href="<?php echo base_url("resources/css/sb-admin-2.css");?>" rel="stylesheet">
			<div class="modal fade" id="cambioContrasenaModal" tabindex="-1" role="dialog" aria-labelledby="cambioContrasenaModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="opcionMenuModalLabel">Nueva Opción de Menú</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" target="" id="frmCambioContra" name="frmCambioContra">
							<div class="modal-body">
								<div class="row">
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Nombre</label>
											<input type="text" id="txtNombre" name="txtNombre" class="form-control" readonly>
											<input type="hidden" id="txtIdUsuario" name="txtIdUsuario" class="form-control" readonly>
											<input type="hidden" id="txtUsuario" name="txtUsuario" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Correo</label>
											<input type="text" id="txtCorreo" name="txtCorreo" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Contraseña</label>
											<input type="password" id="txtContraseña" name="txtContraseña" class="form-control" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Contraseña</label>
											<input type="password" id="txtContrasenaValida" name="txtContrasenaValida" class="form-control" required>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<input class='btn btn-danger' type="submit" value="Cambiar Contraseña">
							</div>
						</form>
					</div>
					</form>
				</div>
			</div>
		</body>
	</html>

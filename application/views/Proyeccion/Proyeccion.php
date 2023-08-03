<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Sistema de Información de Flujo de Agencias</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="<?php echo site_url("Proyeccion/getParameters"); ?>" id="frmExport" name="frmExport" method="post" target="_blank">
					<div class="row">
						<div class="clearfix"></div>
						<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
						</div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<center><label>Agencia</label>
							<select id="cbxAgencia" name="cbxAgencia" class="form-control agencia">
								<option value="null">Seleccione</option>
							</select>
						</div>
						<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
						</div>
					</div>
				<br>
				<div class="row">
					<div class="clearfix"></div>
					<div class="form-column col-md-4 col-sm-4 col-xs-4 col-lg-4 result1">
					</div>
					<div class="form-column col-md-8 col-sm-8 col-xs-8 col-lg-8 result2">
					</div>
				</div>
				<div class="result"></div>
			</div>
		</body>
	</html>

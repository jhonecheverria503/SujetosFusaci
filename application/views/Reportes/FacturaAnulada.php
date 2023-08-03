<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Facturas Anuladas</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="<?php echo site_url("FacturaAnulada/getFacturas")?>" method="post" target="_blank">
					<div class="row">
						<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
							<div class="form-group">
								<a class="navbar-brand">Fecha Inicio</a>
								<input type="date" id="FechaInicio" name="FechaInicio" class="form-control" required>
							</div>
						</div>
						<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
							<div class="form-group">
								<a class="navbar-brand">Fecha Fin</a>
								<input type="date" id="FechaFin" name="FechaFin" class="form-control" required>
							</div>
						</div>
						<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
							<div class="form-group">
								<a class="navbar-brand"><br></a>
								<button class="btn btn-outline-success form-control" type="submit" onclick="$(location).attr('href','index')" >Generar</button>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
		</body>
	</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Descarga de Presupuesto Autorizado</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="<?php echo site_url('Presupuesto/getParameters')?>" method="post" id="frmPresupuesto" name="frmPresupuesto" target="_blank">
					<div class="row">
						<div class="form-column col-md-4 col-sm-4 col-xs-4 col-lg-4">
							<div class="form-group">
							</div>
						</div>
						<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
							<div class="form-group">
								<label>Año:</label>
							</div>
						</div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<div class="form-group">
								<select class="form-control cbxAnio" id="cbxAnio" name="cbxAnio">
									<option value="null">Seleccione</option>
								</select>
							</div>
						</div>
						<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
							<div class="form-inline">
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-column col-md-4 col-sm-4 col-xs-4 col-lg-4">
							<div class="form-group">
							</div>
						</div>
						<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
							<div class="form-group">
								<label>Formato:</label>
							</div>
						</div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<div class="form-group">
								<select class="form-control" id="cbxFormato" name="cbxFormato">
									<option value="null">Seleccione</option>
									<option value="excel">EXCEL</option>
									<option value="pdf">PDF</option>
								</select>
							</div>
						</div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<div class="form-group">
								<input type="submit" value="Generar" onclick="$(location).attr('href','index')" class="btn btn-success btn-block btnSubmit" id="btnSubmit" name="btnSubmit"/>
							</div>
						</div>
						<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
							<div class="form-group">
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="clearfix"></div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<div class="form-group">
							</div>
						</div>
						<div class="form-column col-md-4 col-sm-4 col-xs-4 col-lg-4">
							<div class="form-group">
								<label>Incluir Traslados Presupuestarios:</label>
							</div>
						</div>
						<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
							<div class="form-group">
								<input type="checkbox" id="trasPre" name="trasPre" class="form-control">
							</div>
						</div>
						<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
							<div class="form-group">
							</div>
						</div>
					</div>
				</form>
			</div>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Inicio</title>
	<p1></p1>
</head>
<body>
<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
	<center><h3 class="form-group">Ejecución Presupuestaria</label></h3>
</div>
<div class="clearfix"></div>
<div class="container navbar-light bg-light col-md-12">
	<form action="<?php echo site_url("EjecucionPresupuestaria/getParameters")?>" method="post" target="_blank">
		<div class="row">
			<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
				<center><label class="form-group"></label>
			</div>
			<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
				<center><label class="form-group">Del:</label>
			</div>
			<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
				<input type="date" class="form-control" id="txtFecIni" name="txtFecIni" onkeydown="return false" required>
			</div>
			<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
				<div class="form-group">
				</div>
			</div>
			<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
				<center><label class="form-group">Al:</label>
			</div>
			<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
				<input type="date" class="form-control" id="txtFecFin" name="txtFecFin" onkeydown="return false" required>
			</div>
			<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
				<center><label class="form-group"></label>
			</div>
			<div class="clearfix"></div>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<div class="form-group">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
				<div class="form-group">
				</div>
			</div>
			<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
				<div class="form-group">
					<input type="submit" value="Generar" class="btn btn-success btn-block btnSubmit" id="btnSubmit" name="btnSubmit"/>
				</div>
			</div>
			<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
				<div class="form-group">
					<label></label>
				</div>
			</div>
		</div>
	</form>
	<br>
</div>
</body>
</html>

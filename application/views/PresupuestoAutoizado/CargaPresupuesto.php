<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Carga de Presupuesto Autorizado</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="" method="post" enctype="multipart/form-data" id="formPresupuesto" name="formPresupuesto">
					<div class="row">
						<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
							<div class="form-inline">
								<label>Año:</label>
							</div>
						</div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<div class="form-inline">
								<select class="form-control cbxAnio" id="cbxAnio" name="cbxAnio">
									<option value="null">Seleccione</option>
									<?php for($i=date("Y");$i<=date("Y")+10;$i++){?>
										<option value="<?php echo $i?>"><?php echo $i?></option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="form-column col-md-6 col-sm-6 col-xs-6 col-lg-6">
							<div class="form-inline">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="file" name="uploadFile" value="">
									<label class="custom-file-label" for="customFile">No se ha seleccionado ningún archivo...</label>
								</div>
							</div>
						</div>
						<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
							<div class="form-inline">
								<input type="submit" value="Cargar" class="btn btn-success btn-block btnSubmit" id="btnSubmit" name="btnSubmit"/>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>

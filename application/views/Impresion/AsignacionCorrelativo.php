<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Documento Generado</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="" method="post">
					<div class="row">
						<div class="clearfix"></div>
						<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-inline">
								<a class="navbar-brand">N° Correlativo Temporal</a>
								<input class="form-control col-md-9 col-sm-9 col-xs-9 col-lg-9" name="txtFind" id="txtFind" type="search" placeholder="Search" aria-label="Search" required="required" ">
							</div>
						</div>
					</div>
				</form>
				<br>
				<div class="result"></div>
			</div>
			<!--Asignar correlativo de Sujeto-->
			<div class="modal fade" id="AsignarCorrelativoModal" tabindex="-1" role="dialog" aria-labelledby="AsignarCorrelativoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="AsignarCorrelativoModalLabel">Asignación de Correlativo</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?php echo site_url("DocumentoGenerado/printFactura")?>" method="post" target="_blank" id="FacturaSujetoExcluidoForm" name="FacturaSujetoExcluidoForm">
							<div class="modal-body">
								<div class="row">
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">DUI</label>
											<input type="text" id="Dui" name="Dui" pattern="[0-9]{9}" placeholder="Ejemplo: 123456789" class="form-control" onkeypress="return validarNumeros(event)" readonly>
											<input type="hidden" id="idFactura" name="idFactura" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">NIT</label>
											<input type="text" id="Nit" name="Nit" pattern="[0-9]{14}" placeholder="Ejemplo: 12345678901234" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Nombre</label>
											<input type="text" id="Nombre" name="Nombre" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apellido</label>
											<input type="text" id="Apellido" name="Apellido" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Telefono</label>
											<input type="text" id="Telefono" name="Telefono" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Fecha</label>
											<input type="date" id="fechaSujeto" name="fechaSujeto" value="" class="form-control">
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Detalle</label>
											<textarea class="form-control" id="Detalle" name="Detalle"></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Correlativo</label>
											<input type="text" id="corr" name="corr" onclick="return Aviso()" class="form-control" readonly>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Serie</label>
											<input type="text" id="serie" name="serie" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Resolucion</label>
											<input type="text" class="form-control" id="resolucion" name="resolucion" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Monto</label>
											<input type="text" id="Monto" name="Monto" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Tipo</label>
											<select class="form-control" id="tipo" name="tipo" onchange="validaTipo()" required>
												<option value="1">Bien</option>
												<option value="2">Servicio</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">ISR</label>
											<input type="text" id="Isr" name="Isr" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Gasto</label>
											<input type="text" id="Gasto" name="Gasto" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<input class='btn btn-danger btnNuevoFacturaSujetoExcluido' type="submit" value="Guardar" id="btnNuevoFacturaSujetoExcluido">
							</div>
						</form>
					</div>
				</div>
			</div>
		</body>
	</html>

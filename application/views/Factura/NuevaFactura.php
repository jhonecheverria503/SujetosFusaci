<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Nueva Factura de Sujeto Excluido</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="" method="post">
					<div class="row">
						<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-inline">
								<a class="navbar-brand">DUI O NIT</a>
								<input class="form-control col-md-10 col-sm-10 col-xs-10 col-lg-10" name="txtFind" id="txtFind" onkeypress="return validarNumeros(event)" type="search" placeholder="Search" aria-label="Search" required="required" onkeypress="return validarNumeros(event)" >
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
				<br>
				<div class="result"></div>
			</div>
			<!--Actualizar Sujeto-->
			<div class="modal fade" id="ActualizarSujetoModal" tabindex="-1" role="dialog" aria-labelledby="ActualizarSujetoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ActualizarSujetoModalLabel">Nueva Factura de Sujeto Excluido</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?php echo site_url("Factura/getNewFactura")?>" method="post" target="_blank" id="FacturaSujetoExcluidoForm" name="FacturaSujetoExcluidoForm">
							<div class="modal-body">
								<div class="row">
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">DUI</label>
											<input type="text" id="UDui" name="UDui" pattern="[0-9]{9}" placeholder="Ejemplo: 123456789" class="form-control" onkeypress="return validarNumeros(event)" readonly>
											<input type="hidden" id="idSujeto" name="idSujeto" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">NIT</label>
											<input type="text" id="UNit" name="UNit" pattern="[0-9]{14}" placeholder="Ejemplo: 12345678901234" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Nombre</label>
											<input type="text" id="UNombre" name="UNombre" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apellido</label>
											<input type="text" id="UApellido" name="UApellido" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Dirección y Contacto</label>
											<input type="hidden" id="UContacto" name="UContacto" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Calle/Avenida/Pasaje/Poligono/Block</label>
											<textarea class="form-control" rows="3" cols="" id="UDirecc" name="UDirecc" readonly></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">N° de Casa</label>
											<input type="text" id="UNoCasa" name="UNoCasa" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apartamento / Local</label>
											<input type="text" id="UAptoLocal" name="UAptoLocal" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Otros datos que complementa el Domicilio</label>
											<textarea class="form-control" rows="3" cols="" id="UOtrosDatos" name="UOtrosDatos" readonly></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Colonia</label>
											<input type="text" id="UColonia" name="UColonia" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Correo</label>
											<input type="text" id="UCorreo" name="UCorreo" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Departamento</label>
											<input type="text" id="UDepartamento" name="UDepartamento" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Municipio</label>
											<input type="text" id="UMunicipio" name="UMunicipio" class="form-control" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Telefono</label>
											<input type="text" id="UTelefono" name="UTelefono" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Correlativo Temporal</label>
											<input type="text" id="corTemp" name="corTemp" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Compra de</label>
											<textarea class="form-control" rows="3" cols="" id="Concepto" name="Concepto" onKeyup="this.value=this.value.toUpperCase()" required></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Monto Liquido</label>
											<input type="text" id="montoLiquido" name="montoLiquido" onchange="validaTipo()"  pattern="^\d*(\.\d{0,2})?$" placeholder="Ejemplo: XXXXXXX.XX" class="form-control" onkeypress="return validarNumeros(event)" required>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Tipo</label>
											<select class="form-control" id="tipo" name="tipo" onchange="validaTipo()" required>
												<option value="null">Seleccione...</option>
												<option value="1">Bien</option>
												<option value="2">Servicio</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Gasto</label>
											<input type="text" id="gasto" name="gasto" placeholder="Ejemplo: 0.00" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">ISR</label>
											<input type="text" id="isr" name="isr" placeholder="Ejemplo: 0.00" class="form-control" onkeypress="return validarNumeros(event)" readonly>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<input class='btn btn-danger btnNuevoFacturaSujetoExcluido' type="submit" value="Añadir"  onclick="$(location).attr('href','index')" id="btnNuevoFacturaSujetoExcluido">
							</div>
						</form>
					</div>
				</div>
			</div>
		</body>
	</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Sujeto Excluido</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="" method="post">
					<div class="row">
						<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<div class="form-inline">
								<a class="navbar-brand">DUI O NIT</a>
								<input class="form-control col-md-10 col-sm-10 col-xs-10 col-lg-10" name="txtFind" id="txtFind" onkeypress="return validarNumeros(event)" type="search" placeholder="Search" aria-label="Search" required="required" ">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
				<br>
				<div class="result"></div>
			</div>
			<!--Ingresar Sujeto-->
			<div class="modal fade" id="sujetoExcluidoModal" tabindex="-1" role="dialog" aria-labelledby="sujetoExcluidoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="sujetoExcluidoModalLabel">Nuevo Sujeto Excluido</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" id="SujetoExcluidoForm" name="SujetoExcluidoForm">
							<input type="hidden" name="txtUsuarioL" id="txtUsuarioL" value="<?php echo $_SESSION['usuario']?>">
							<div class="modal-body">
								<div class="row">
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">DUI</label>
											<input type="text" id="txtDui" name="txtDui" pattern="[0-9]{9}" maxlength="9" placeholder="Ejemplo: 123456789" class="form-control" onkeypress="return validarNumeros(event)" required>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">NIT</label>
											<input type="text" id="txtNit" name="txtNit" pattern="[0-9]{14}" maxlength="14" placeholder="Ejemplo: 12345678901234" class="form-control" onkeypress="return validarNumeros(event)">
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Nombre</label>
											<input type="text" id="txtNombre" name="txtNombre" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apellido</label>
											<input type="text" id="txtApellido" name="txtApellido" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div  class="form-group">
											<label for="cliente" class="control-label">Dirección y Contacto</label>
											<input type="hidden" id="txtContacto" name="txtContacto" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<hr class="sidebar-divider">
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Calle/Avenida/Pasaje/Poligono/Block</label>
											<textarea class="form-control" rows="3" cols="" id="txtDirecc" name="txtDirecc" onKeyup="this.value=this.value.toUpperCase()" required></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">N° de Casa</label>
											<input type="text" id="txtNoCasa" name="txtNoCasa" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apartamento / Local</label>
											<input type="text" id="txtAptoLocal" name="txtAptoLocal" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Otros datos que complementan el domicilio</label>
											<input type="text" id="txtOtrosDatos" name="txtOtrosDatos" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Colonia</label>
											<input type="text" id="txtColonia" name="txtColonia" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Correo</label>
											<input type="email" id="txtCorreo" name="txtCorreo" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Departamento</label>
											<select class="form-control departamento" id="cbxDeptos" name="cbxDeptos" required="required">
												<option value="null">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Municipio</label>
											<select class="form-control municipio" id="cbxMunici" name="cbxMunici" required="required">
												<option value="null">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Telefono</label>
											<input type="text" id="txtTelefono" name="txtTelefono" pattern="[0-9]{8}" maxlength="8" class="form-control" onkeypress="return validarNumeros(event)" required>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<input class='btn btn-danger btnNuevoSujetoExcluido' type="submit" value="Añadir" id="btnNuevoSujetoExcluido">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--Actualizar Sujeto-->
			<div class="modal fade" id="ActualizarSujetoModal" tabindex="-1" role="dialog" aria-labelledby="ActualizarSujetoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ActualizarSujetoModalLabel">Actualizar Sujeto Excluido</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post" id="ActualizaSujetoExcluidoForm" name="ActualizaSujetoExcluidoForm">
							<div class="modal-body">
								<div class="row">
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">DUI</label>
											<input type="text" id="UDui" name="UDui" pattern="[0-9]{9}" maxlength="9" placeholder="Ejemplo: 123456789" class="form-control" onkeypress="return validarNumeros(event)" required>
											<input type="hidden" id="idSujeto" name="idSujeto" class="form-control" onkeypress="return validarNumeros(event)" required>
										</div>
									</div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">NIT</label>
											<input type="text" id="UNit" name="UNit" pattern="[0-9]{14}" maxlength="14" placeholder="Ejemplo: 12345678901234" class="form-control" onkeypress="return validarNumeros(event)" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Nombre</label>
											<input type="text" id="UNombre" name="UNombre" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apellido</label>
											<input type="text" id="UApellido" name="UApellido" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Direccion y Contacto</label>
											<input type="hidden" id="UContacto" name="UContacto" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Calle/Avenida/Pasaje/Poligono/Block</label>
											<textarea class="form-control" rows="3" cols="" id="UDirecc" name="UDirecc" onKeyup="this.value=this.value.toUpperCase()" required></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">N° de Casa</label>
											<input type="text" id="UNoCasa" name="UNoCasa" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Apartamento / Local</label>
											<input type="text" id="UAptoLocal" name="UAptoLocal" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Otros datos que complementan el domicilio</label>
											<input type="text" id="txtUOtrosDatos" name="txtUOtrosDatos" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Colonia</label>
											<input type="text" id="UColonia" name="UColonia" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Correo</label>
											<input type="email" id="UCorreo" name="UCorreo" class="form-control" onKeyup="this.value=this.value.toUpperCase()" required>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Departamento</label>
											<select class="form-control departamento" id="UcbxDeptos" name="UcbxDeptos" required="required">
												<option value="null">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Municipio</label>
											<select class="form-control" id="UcbxMunici" name="UcbxMunici" required="required">
												<option value="null">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Telefono</label>
											<input type="text" id="UTelefono" name="UTelefono" class="form-control" pattern="[0-9]{8}" maxlength="8" onkeypress="return validarNumeros(event)" required>
										</div>
									</div>
									<div class="form-column col-md-3">
										<div class="form-group">
											<label for="cliente" class="control-label">Estado ¿Activo? ¿Inactivo?</label>
											<div class="clearfix"></div>
											<input type="checkbox" class='EstadoSujeto' id="chkEstado" name="chkEstado" >
										</div>
									</div>
									<div class="form-column col-md-3">
										<div class="form-group">
											<label for="cliente" class="control-label">¿Tiene registro de Hacienda?</label>
											<div class="clearfix"></div>
											<input type="checkbox" class='EstadoSujeto' id="chkHacienda" name="chkHacienda">
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<input class='btn btn-danger btnActualizaSujetoExcluido' type="submit" value="Añadir" id="btnActualizaSujetoExcluido">
							</div>
						</form>
					</div>
				</div>
			</div>
		</body>
	</html>
<?php

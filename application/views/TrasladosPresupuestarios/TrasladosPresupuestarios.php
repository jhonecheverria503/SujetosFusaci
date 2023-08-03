<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
		</head>
		<body>
		<form action="" method="post" id="frmTraslado" name="frmTraslado">
			<div class="row">
				<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
					<center><label class="form-group">Fecha Proceso</label>
				</div>
				<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
					<input type="text" value="<?php echo date('d/m/Y') ?>" class="form-control" readonly>
				</div>
				<div class="form-column col-md-4 col-sm-4 col-xs-4 col-lg-4">
					<div class="form-group">
					</div>
				</div>
				<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
					<center><label class="form-group">Correlativo</label>
				</div>
				<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
					<input type="text" class="form-control" id="txtCorr" name="txtCorr" readonly>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Ingreso de traslado presupuestario</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<div class="row">
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
						</div>
					</div>
					<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
						<div class="form-group">
							<label>Mes</label>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
							<select class="form-control" id="cbxMes" name="cbxMes">
								<option value="null">Seleccione</option>
								<option value="1" <?php echo date('m') == 1 ? 'selected' : ''; ?>>Enero</option>
								<option value="2" <?php echo date('m') == 2 ? 'selected' : ''; ?>>Febrero</option>
								<option value="3" <?php echo date('m') == 3 ? 'selected' : ''; ?>>Marzo</option>
								<option value="4" <?php echo date('m') == 4 ? 'selected' : ''; ?>>Abril</option>
								<option value="5" <?php echo date('m') == 5 ? 'selected' : ''; ?>>Mayo</option>
								<option value="6" <?php echo date('m') == 6 ? 'selected' : ''; ?>>Junio</option>
								<option value="7" <?php echo date('m') == 7 ? 'selected' : ''; ?>>Julio</option>
								<option value="8" <?php echo date('m') == 8 ? 'selected' : ''; ?>>Agosto</option>
								<option value="9" <?php echo date('m') == 9 ? 'selected' : ''; ?>>Septiembre</option>
								<option value="10" <?php echo date('m') == 10 ? 'selected' : ''; ?>>Octubre</option>
								<option value="11" <?php echo date('m') == 11 ? 'selected' : ''; ?>>Noviembre</option>
								<option value="12" <?php echo date('m') == 12 ? 'selected' : ''; ?>>Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-inline">
						</div>
					</div>
					<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
						<div class="form-group">
							<label>Año</label>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
							<select class="form-control cbxAnio" id="cbxAnio" name="cbxAnio">
								<option value="null">Seleccione</option>
							</select>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-inline">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
						<div class="form-group">
						</div>
					</div>
					<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
						<div class="form-group">
							<label>Descripción:</label>
						</div>
					</div>
					<div class="form-column col-md-4 col-sm-4 col-xs-4 col-lg-4">
						<div class="form-group">
							<textarea rows="" cols="" class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
							<input type="submit" value="Guardar" class="btn btn-success btn-block btnSubmit" id="btnSubmit" name="btnSubmit"/>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-column col-md-6 col-sm-6 col-xs-6 col-lg-6">
						<div class="form-group">
							<center><label><b>Salidas</b></label>
						</div>
					</div>
					<div class="form-column col-md-6 col-sm-6 col-xs-6 col-lg-6">
						<div class="form-group">
							<center><label><b>Entradas</b></label>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-column col-md-6 col-sm-6 col-xs-6 col-lg-6">
						<div class="form-group">
							<div class="table-responsive">
								<table class="table" id="tablaS">
									<thead class="thead-light">
									<tr>
										<th scope="col">Cuenta</th>
										<th scope="col">Agencia</th>
										<th scope="col">Monto</th>
										<th scope="col">
											<button id="btnAddS" name="btnAddS" type="button" class="btn btn-success">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</button>
										</th>
									</tr>
									</thead>
									<tbody>
									<tr class="fila-fijaS">
										<td>
											<select class="form-control cuenta" id="cbxCuentaS" name="cbxCuentaS[]" required="required">
												<option value="null">Seleccione...</option>
											</select>
										</td>
										<td>
											<select class="form-control agencia" id="cbxAgenciaS" name="cbxAgenciaS[]" required="required">
												<option value="null">Seleccione...</option>
											</select>
										</td>
										<td>
											<input class="form-control montoS monto" type="text" id="txtMontoS" required="required" name="txtMontoS[]" onkeypress="return validarNumeros(event,this)" onkeyup="calculaTotalSalida()">
										</td>
										<td class="eliminar">
											<button type="button" value="-" class="btn btn-warning" onclick="calculaTotalSalida()">
												<i class="fa fa-minus" aria-hidden="true"></i>
											</button>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="form-column col-md-6 col-sm-6 col-xs-6 col-lg-6">
						<div class="form-group">
							<div class="form-group">
								<div class="table-responsive">
									<table class="table" id="tablaE">
										<thead class="thead-light">
										<tr>
											<th scope="col">Cuenta</th>
											<th scope="col">Agencia</th>
											<th scope="col">Monto</th>
											<th scope="col">
												<button id="btnAddE" name="btnAddE" type="button" class="btn btn-success">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</button>
											</th>
										</tr>
										</thead>
										<tbody>
										<tr class="fila-fijaE">
											<td>
												<select class="form-control cuenta" id="cbxCuentaE" name="cbxCuentaE[]" required="required">
													<option value="null">Seleccione...</option>
												</select>
											</td>
											<td>
												<select class="form-control agencia" id="cbxAgenciaE" name="cbxAgenciaE[]" required="required">
													<option value="null">Seleccione...</option>
												</select>
											</td>
											<td>
												<input class="form-control montoE monto" type="text" id="txtMontoE" required="required" name="txtMontoE[]" onkeypress="return validarNumeros(event,this)" onkeyup="calculaTotalEntrada()">
											</td>
											<td class="eliminar">
												<button type="button" value="-" class="btn btn-warning"  onclick="calculaTotalSalida()">
													<i class="fa fa-minus" aria-hidden="true"></i>
												</button>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
						</div>
					</div>
					<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
						<div class="form-group">
							<label>Total</label>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" name="totalSalida" id="totalSalida" readonly>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-inline">
						</div>
					</div>
					<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
						<div class="form-group">
							<label>Total</label>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
							<input type="text" class="form-control" name="totalEntrada" id="totalEntrada" readonly>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-inline">
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
						<center><h3 class="form-group"><label id="lblMessage" name="lblMessage"></label></h3>
					</div>
				</div>
			</div>
		</form>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Busqueda de Traslados Presupuestarios</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<form action="" method="post">
					<div class="row">
						<div class="clearfix"></div>
						<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
							<center><input class="form-control col-md-9 col-sm-9 col-xs-9 col-lg-9" name="txtFind" id="txtFind" type="search" placeholder="Correlativo ó descripción de traslado" aria-label="Search" required="required" ">
						</div>
					</div>
				</form>
				<br>
				<div class="result"></div>
			</div>
			<!--Asignar correlativo de Sujeto-->
			<div class="modal fade" id="TrasladoPresupuestarioModal" tabindex="-1" role="dialog" aria-labelledby="TrasladoPresupuestarioModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="TrasladoPresupuestarioModalLabel">Traslado Presupuestario</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post" id="frmTrasladoPresupuestario" name="frmTrasladoPresupuestario">
							<div class="modal-body">
								<div class="row">
									<div class="clearfix"></div>
									<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
										<center><label class="form-group">Fecha Proceso</label>
									</div>
									<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
										<input type="text" id="txtFecProceso" class="form-control" readonly>
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
									<div class="clearfix"></div>
									<div class="clearfix"></div>
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
											<input type="text" class="form-control" id="txtMes" name="txtMes" readonly>
										</div>
									</div>
									<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
										<div class="form-group">
										</div>
									</div>
									<div class="form-column col-md-1 col-sm-1 col-xs-1 col-lg-1">
										<div class="form-group">
											<label>Año</label>
										</div>
									</div>
									<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
										<div class="form-group">
											<input type="text" class="form-control" id="txtAnio" name="txtAnio" readonly>
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
									<div class="form-column col-md-5 col-sm-5 col-xs-5 col-lg-5">
										<div class="form-group">
											<textarea rows="" cols="" class="form-control" id="txtDescripcion" name="txtDescripcion" readonly></textarea>
										</div>
									</div>
									<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
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
													</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="form-column col-md-6 col-sm-6 col-xs-6 col-lg-6">
										<div class="form-group">
											<div class="table-responsive">
												<table class="table" id="tablaE">
													<thead class="thead-light">
													<tr>
														<th scope="col">Cuenta</th>
														<th scope="col">Agencia</th>
														<th scope="col">Monto</th>
													</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
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
									<div class="form-row col-md-12 col-sm-12 col-xs-12 col-lg-12" id="divProduc2">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</body>
	</html>

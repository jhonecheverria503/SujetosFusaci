<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Resolucion de nueva papelería</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<div class="row">
					<div class="form-column col-md-2 col-sm-2 col-xl-2 col-lg-2">
						<div class="form-inline">
							<button class='btn btn-success btn-block' type="submit" data-toggle="modal" value="" data-target="#AñadirCorrelativoModel" id="prueba">
								Nueva Resolucion
							</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="table-responsive">
					<br>
					<table class="table" id="MetasAsesores" style="text-align:center";>
						<thead class="thead-light">
						<tr>
							<th scope="col">Correlativo</th>
							<th scope="col">Fecha de Emisión</th>
							<th scope="col">Resolucion</th>
							<th scope="col">Correlativo</th>
							<th scope="col">En Existencia</th>
							<th scope="col">Pendientes de Asignar</th>
							<th scope="col">Estado</th>
							<th style="display: none" scope="col">Codigo Fuente</th>
						</tr>
						</thead>
						<tbody>
						<!-- IMPRIME LOS DATOS Y DA FORMATO DECIMAL A LOS QUE RETOTNAN .00 -->
						<?php
						if (!empty($res)){
							foreach ($res as $datos){
								?>
								<tr>
									<td id="Correlativo"><?php echo $datos->id; ?><input type="hidden" id="idResolucion" name="idResolucion" value="<?php echo $datos->id; ?>"></td>
									<td id="FecEmi"><?php echo date("d/m/Y",Strtotime($datos->fecEmision)); ?></td>
									<td id="Resolucion"><?php echo $datos->resolucion; ?></td>
									<td id="Correlativos"><?php echo 'Del '.$datos->corIni.' Al '.$datos->corFin; ?></td>
									<td id="Existencia"><?php echo (double)($datos->corFin - $datos->corActual); ?></td>
									<td id="Pendientes"><?php echo (double)$datos->PendientesAsig; ?></span></td>
									<td>
									<?php
									if($datos->estado=='1'){
										echo "<center>
												<button class='btn btn-danger changeStatus' type='submit' value='$datos->id'>
													Inactivar
												</button>
											</center>";
									}
									else{
										echo "<center>
												<button class='btn btn-success changeStatus' type='submit' value='$datos->id'>
													Activar
												</button>
											</center>";
									}
									?>
									</td>
									<td style="display: none" id="estado<?php echo $datos->id;?>"><?php echo $datos->estado; ?></td>
								</tr>
								<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!--Añadir Papeleria-->
			<div class="modal fade" id="AñadirCorrelativoModel" tabindex="-1" role="dialog" aria-labelledby="AñadirCorrelativoModelLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="AñadirCorrelativoModellLabel">Nueva Resolucion</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post" id="NuevaResolucionForm" name="NuevaResolucionForm">
							<div class="modal-body">
								<div class="row">
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Fecha de Emision</label>
											<input type="date" id="Fecha" name="Fecha" class="form-control" required>
										</div>
									</div>
									<div class="form-column col-md-3">
										<div class="form-group">
											<label for="cliente" class="control-label">Serie</label>
											<input type="text" id="Serie" name="Serie" class="form-control">
										</div>
									</div>
									<div class="form-column col-md-3">
										<div class="form-group">
											<label for="cliente" class="control-label">Estado</label><br>
											<input type="checkbox" id="Estado" name="Estado"><label>  Activo</label>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
										<div class="form-group">
											<label for="cliente" class="control-label">Resolucion</label>
											<input type="text" id="Resolucion" name="Resolucion" placeholder="Ejemplo: 0000-RES-CR-00000-0000" class="form-control">
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Correlativo Inicial</label>
											<input type="text" id="CorIni" name="CorIni" class="form-control">
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-column col-md-6">
										<div class="form-group">
											<label for="cliente" class="control-label">Correlativo Final</label>
											<input type="text" id="CorFin" name="CorFin" class="form-control">
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

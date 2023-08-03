<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
			<title>Inicio</title>
			<p1></p1>
		</head>
		<body>
			<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
				<center><h3 class="form-group">Generación de Correlativos</label></h3>
			</div>
			<div class="clearfix"></div>
			<div class="container navbar-light bg-light col-md-12">
				<div class="row">
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
						</div>
					</div>
					<?php
					$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'17');
					if($permiso[0]->Contador>0) {
					?>
					<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
						<div class="form-group">
							<a href="<?php echo site_url("GeneracionCorrela/ResolucionPapeleria")?>">
								<button type="button" class="btn btn-outline-primary">
									INGRESAR RESOLUCION DE NUEVA PAPELERIA
								</button>
							</a>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
						</div>
					</div>
					<?php
						}
					$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'16');
					if($permiso[0]->Contador>0) {
					?>
					<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
						<div class="form-group">
							<a href="<?php echo site_url("GeneracionCorrela/AsignacionCorrelativo")?>">
								<button type="button" class="btn btn-outline-primary" value="">ASIGNACION DE CORRELATIVOS</button>
							</a>
						</div>
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<div class="form-group">
						</div>
					</div>
					<div class="clearfix"></div>
					<?php
						}
					?>
				</div>
				<br>
			</div>
		</body>
	</html>

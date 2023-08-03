<?php


class Factura extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Factura_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
		$corTempModel = substr($_SESSION["oficina"],1,2).'-'.substr(strstr($_SESSION['Dia'],'/'),1,2).substr(strstr($_SESSION['Dia'],'/'),4,4).'-';
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 03,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Nueva Factura.",
			"usuario" => $_SESSION['usuario'],
			"dirIp"=>$_SERVER['REMOTE_ADDR'],
			"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$permiso["padres"]=$this->GestionPermiso_Model->getPadres($_SESSION['usuario']);
		$permiso["hijos"]=$this->GestionPermiso_Model->getHijos($_SESSION['usuario']);
		$this->load->view("layout/head");
		$this->load->view("layout/sidebar", $permiso);
		$this->load->view("layout/navbar");
		$this->load->view("Factura/NuevaFactura");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Factura/end_NuevaFactura");
	}

	public function findSujeto(){
		$datos=$this->input->post();
		$Referencia=$datos["Referencia"];
		$data = $this->Factura_Model->getSujeto($Referencia);
		if (!empty($data)){
			if(!empty($Referencia)){
				?>
				<div class="table-responsive">
				<table class="table" id="sujetoExcluido">
				<thead class="thead-light">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">DUI</th>
					<th scope="col">NIT</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Telefono</th>
					<th style="display: none" scope="col">contacto</th>
					<th style="display: none" scope="col">direccion</th>
					<th style="display: none" scope="col">noCasa</th>
					<th style="display: none" scope="col">aptoLocal</th>
					<th style="display: none" scope="col">otrosDatos</th>
					<th style="display: none" scope="col">colonia</th>
					<th style="display: none" scope="col">correo</th>
					<th style="display: none" scope="col">depto</th>
					<th style="display: none" scope="col">municipio</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($data as $datos){
					?>
					<tr>
						<td id="codigo<?php echo $datos->id; ?>"><?php echo $datos->id; ?></td>
						<td id="DUI<?php echo $datos->id; ?>"><?php echo $datos->dui; ?></td>
						<td id="NIT<?php echo $datos->id; ?>"><?php echo $datos->nit; ?></td>
						<td id="Nombre<?php echo $datos->id; ?>"><?php echo $datos->nombre; ?></td>
						<td id="Apellido<?php echo $datos->id; ?>"><?php echo $datos->apellido; ?></td>
						<td id="Telefono<?php echo $datos->id; ?>"><?php echo $datos->telefono; ?></td>
						<td style="display: none" id="Contacto<?php echo $datos->id; ?>"><?php echo $datos->contacto; ?></td>
						<td style="display: none" id="Direccion<?php echo $datos->id; ?>"><?php echo $datos->direccion; ?></td>
						<td style="display: none" id="NoCasa<?php echo $datos->id; ?>"><?php echo $datos->noCasa; ?></td>
						<td style="display: none" id="AptoLocal<?php echo $datos->id; ?>"><?php echo $datos->aptoLocal; ?></td>
						<td style="display: none" id="otrosDatos<?php echo $datos->id; ?>"><?php echo $datos->otrosDatos; ?></td>
						<td style="display: none" id="Colonia<?php echo $datos->id; ?>"><?php echo $datos->colonia; ?></td>
						<td style="display: none" id="Correo<?php echo $datos->id; ?>"><?php echo $datos->correo; ?></td>
						<td style="display: none" id="Depto<?php echo $datos->id; ?>"><?php echo rtrim($datos->depto); ?></td>
						<td style="display: none" id="Municipio<?php echo $datos->id; ?>"><?php echo rtrim($datos->municipio); ?></td>
						<td>
							<button class='btn btn-primary edit' type="submit" data-toggle="modal" value="<?php echo $datos->id; ?>" data-target="#ActualizarSujetoModal" id="prueba">
								Seleccionar
							</button>
						</td>
					</tr>
					<?PHP
				}
			}
			?>
			</tbody>
			</table>
			</div>
			<?php
		}
		else{
			if(!empty($Referencia)){
				?>
				<div class="row">
					<div class="form-column col-md-9 col-sm-9 col-xs-9 col-lg-9">
					</div>
					<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
						<form action="<?php echo site_url("SujetoExcluido/index")?>" method="post">
							<div class="row">
								<div class="form-column col-md-12 col-sm-12 col-xs-12 col-lg-12">
									<div class="form-inline">
										<button class='btn btn-primary' type="submit" data-toggle="modal" data-target="#sujetoExcluidoModal" id="prueba">CREAR SUJETO EXCLUIDO</button>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</form>
					</div>
				</div>
				<?php
			}
		}
	}

	public function getNewFactura(){
		$corTempModel = substr($_SESSION["oficina"],1,2).'-'.substr(strstr($_SESSION['Dia'],'/'),1,2).substr(strstr($_SESSION['Dia'],'/'),4,4).'-';
		$data = $this->input->post();
		if($data['tipo'] == 'null'){
			echo '<html><script>alert("Seleccione un tipo");window.close();</script></html>';
			exit();
		}
		$corr = $this->Factura_Model->getCorrTemp();
		if (!empty($corr)){
			$corrTemp = $corTempModel.str_pad($corr[0]->corTemp, 4, '0', STR_PAD_LEFT);;
		}
		else{
			$corrTemp = $corTempModel.'0001';
		}
		$datoNuevaFactura = array(
				"idSujeto"=>$data["idSujeto"],
				"usuario"=>$_SESSION['usuario'],
				"fecCrea"=>date("d/m/Y H:m:s"),
				"corTemp"=>$corrTemp,
				"tipo"=>$data["tipo"],
				"detalle"=>$data["Concepto"],
				"monto"=>$data["montoLiquido"],
				"isr"=>$data["isr"],
				"gasto"=>$data["gasto"],
				"estado"=>"1",
				"fechaServ"=>date("d/m/Y H:m:s"),
		);
		$resInsert = $this->Factura_Model->insertNuevaFactura($datoNuevaFactura);
		$dataBitacora = array(
				"idAccion" => 05,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Ingreso Nueva Factura con correlativo temporal: ".$corrTemp." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$datosSujeto = $this->Factura_Model->getDatosSujeto($data["idSujeto"]);
		$dataFactura = array(
			"corTemp"=>$corrTemp,
			"Fecha"=>date("d/m/Y H:m:s"),
			"nombre"=>$datosSujeto[0]->nombre,
			"apellido"=>$datosSujeto[0]->apellido,
			"direccion"=>$datosSujeto[0]->direccion,
			"nit"=>$datosSujeto[0]->nit,
			"dui"=>$datosSujeto[0]->dui,
			"telefono"=>$datosSujeto[0]->Telefono,
			"concepto"=>$data["Concepto"],
			"monto"=>$data["montoLiquido"],
			"gasto"=>$data["gasto"],
			"isr"=>$data["isr"]
		);
		$dataBitacora = array(
				"idAccion" => 15,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó Factura: ".$corrTemp." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$this->load->view("Reportes/NuevaFactura",$dataFactura);
	}

	public function getCorrTemp(){
		$corTempModel = substr($_SESSION["oficina"],1,2).'-'.substr(strstr($_SESSION['Dia'],'/'),1,2).substr(strstr($_SESSION['Dia'],'/'),4,4).'-';
		$corr = $this->Factura_Model->getCorrTemp();
		if (!empty($corr)){
			$corrTemp = $corTempModel.str_pad($corr[0]->corTemp, 4, '0', STR_PAD_LEFT);
			echo $corrTemp;
		}
		else{
			$corrTemp = $corTempModel.'0001';
			echo $corrTemp;
		}
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'2');
		if($permiso[0]->Contador>0) {
		}
		else{
			?>
			<script type="text/javascript">
				alert("No posee permisos para ingresar a éste modulo");
				window.setTimeout(function(){
					location = ('/ModuloContabilidad/index.php/Login');
				} ,20);
			</script>
			<?php
		}
	}
}

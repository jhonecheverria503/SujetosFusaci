<?php


class AnularFactura extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("AnularFactura_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 03,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Anulación de Factura.",
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
		$this->load->view("Impresion/AnularFactura");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Impresion/end_AnularFactura");
	}

	public function findFactura(){
		$datos=$this->input->post();
		$Referencia=$datos["Referencia"];
		$data = $this->AnularFactura_Model->getFactura($Referencia);
		if (!empty($data)){
			if(!empty($Referencia)){
				?>
				<div class="table-responsive">
				<table class="table" id="sujetoExcluido">
				<thead class="thead-light">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Cor.Temp.</th>
					<th scope="col">Nombre</th>
					<th scope="col">Concepto</th>
					<th scope="col">Valor</th>
					<th style="display: none" scope="col">Telefono</th>
					<th style="display: none" scope="col">Apellido</th>
					<th style="display: none" scope="col">direccion</th>
					<th style="display: none" scope="col">DUI</th>
					<th style="display: none" scope="col">NIT</th>
					<th style="display: none" scope="col">FecCrea</th>
					<th style="display: none" scope="col">tipo</th>
					<th style="display: none" scope="col">monto</th>
					<th style="display: none" scope="col">isr</th>
					<th style="display: none" scope="col">estado</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($data as $datos){
					?>
					<tr>
						<td id="codigo<?php echo $datos->id; ?>"><?php echo $datos->id; ?></td>
						<td id="DUI<?php echo $datos->id; ?>"><?php echo $datos->corAsig; ?></td>
						<td id="NIT<?php echo $datos->id; ?>"><?php echo $datos->nombre." ".$datos->apellido; ?></td>
						<td id="Detalle<?php echo $datos->id; ?>"><?php echo $datos->detalle; ?></td>
						<td id="Gasto<?php echo $datos->id; ?>"><?php echo $datos->gasto; ?></td>
						<td style="display: none" id="Telefono<?php echo $datos->id; ?>"><?php echo $datos->telefono; ?></td>
						<td style="display: none" id="Nombre<?php echo $datos->id; ?>"><?php echo $datos->nombre; ?></td>
						<td style="display: none" id="Apellido<?php echo $datos->id; ?>"><?php echo $datos->apellido; ?></td>
						<td style="display: none" id="Direccion<?php echo $datos->id; ?>"><?php echo $datos->direccion; ?></td>
						<td style="display: none" id="Dui<?php echo $datos->id; ?>"><?php echo $datos->dui; ?></td>
						<td style="display: none" id="Nit<?php echo $datos->id; ?>"><?php echo $datos->nit; ?></td>
						<td style="display: none" id="Fecha<?php echo $datos->id; ?>"><?php echo date("Y-m-d",strtotime($datos->fecCrea)); ?></td>
						<td style="display: none" id="Tipo<?php echo $datos->id; ?>"><?php echo $datos->tipo; ?></td>
						<td style="display: none" id="Monto<?php echo $datos->id; ?>"><?php echo $datos->monto; ?></td>
						<td style="display: none" id="Isr<?php echo $datos->id; ?>"><?php echo $datos->isr; ?></td>
						<td style="display: none" id="Estado<?php echo $datos->id; ?>"><?php echo $datos->estado; ?></td>
						<td>
							<button class='btn btn-primary edit' type="submit" value="<?php echo $datos->id; ?>">
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
					<div class="form-column col-md-10 col-sm-10 col-xs-10 col-lg-10">
					</div>
					<div class="form-column col-md-2 col-sm-2 col-xs-2 col-lg-2">
						<a>...Sin Resultado</a>
					</div>
				</div>
				<?php
			}
		}
	}

	public function getCorr(){
		$corTempModel = substr($_SESSION["oficina"],1,2).'-ANULACION-'.substr(strstr($_SESSION['Dia'],'/'),1,2).substr(strstr($_SESSION['Dia'],'/'),4,4).'-';
		$corr = $this->AnularFactura_Model->getCorrAnula();
		if (!empty($corr)){
			$corAnula = $corTempModel.str_pad($corr[0]->corAnula, 4, '0', STR_PAD_LEFT);
			echo $corAnula;
		}
		else{
			$corAnula = $corTempModel.'0001';
			echo $corAnula;
		}
	}

	public function getData(){
		$datos=$this->input->post();
		$resComprobacion = $this->AnularFactura_Model->comprobarCorrelativo($datos["corrAnula"]);
		if($resComprobacion[0]->conta > 0){
			$data['estado']=false;
			$data['descripcion']="Correlativo ya ha sido asignado";
			echo json_encode($data);
		}
		else{
			$dataUpdate = array(
				"motivoAnul"=>$datos["Motivo"],
				"corAsig"=>"0000",
				"corAnul"=>$datos["corrAnula"],
				"usuAnul"=>$_SESSION['usuario'],
				"fecAnul"=>date("d/m/Y H:m:s"),
				"estado"=>'1'
			);
			$where = "id = '".$datos["idFactura"]."'";
			$resUpdate = $this->AnularFactura_Model->updateFactura($dataUpdate,$where);
			$dataBitacora = array(
					"idAccion" => 11,
					"descripcion" => "Usuario ".$_SESSION['usuario']." Anuló Factura: ".$datos["idFactura"]."",
					"usuario" => $_SESSION['usuario'],
					"dirIp"=>$_SERVER['REMOTE_ADDR'],
					"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
			);
			$this->Bitacora_Model->insertAccion($dataBitacora);
			echo $resUpdate;
		}
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'10');
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

<?php


class ImpresionFactura extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("ImpresionFactura_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 03,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Impresión de Factura.",
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
		$this->load->view("Impresion/ImpresionFactura");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Impresion/end_ImpresionFactura");
	}

	public function findFactura(){
		$datos=$this->input->post();
		$Referencia=$datos["Referencia"];
		$data = $this->ImpresionFactura_Model->getFacturas($Referencia);
//		var_dump($data);
		if (!empty($data)){
			if(!empty($Referencia)){
				?>
				<div class="table-responsive">
				<table class="table" id="sujetoExcluido">
				<thead class="thead-light">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Cor.Asign.</th>
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
						<td id="corrAsignado<?php echo $datos->id; ?>"><?php echo $datos->corAsig; ?></td>
						<td id="nombres<?php echo $datos->id; ?>"><?php echo $datos->nombre." ".$datos->apellido; ?></td>
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

	public function printFactura(){
		$datos=$this->input->post();
		$Referencia=$datos["idFactura"];
		$data = $this->ImpresionFactura_Model->getDatosFactura($Referencia);
		$dataFactura = array(
				"Fecha"=>date("d/m/Y H:m:s",strtotime($data[0]->fecCrea)),
				"Nombre"=>$data[0]->nombre,
				"Apellido"=>$data[0]->apellido,
				"Direccion"=>($data[0]->direccion.' ,'.$data[0]->aptoLocal.' ,'.$data[0]->noCasa.' ,'.$data[0]->colonia),
				"DUI"=>$data[0]->dui,
				"NIT"=>$data[0]->nit,
				"Telefono"=>$data[0]->telefono,
				"Descripcion"=>$data[0]->detalle,
				"PrecioUni"=>$data[0]->gasto,
				"ISR"=>$data[0]->isr,
				"Total"=>$data[0]->monto
		);
		$dataBitacora = array(
				"idAccion" => 15,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó Factura: ".$Referencia." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$this->load->view("Reportes/FacturaFinal",$dataFactura);
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'11');
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

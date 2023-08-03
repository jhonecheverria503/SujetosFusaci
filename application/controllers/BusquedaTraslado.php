<?php


class BusquedaTraslado extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("BusquedaTraslado_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}
	public function index(){
		$dataBitacora = array(
			"idAccion" => 17,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Busqueda de Traslados Presupuestarios.",
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
		$this->load->view("TrasladosPresupuestarios/BusquedaTraslado");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("TrasladosPresupuestarios/end_BusquedaTraslado");
	}

	public function findTraslado(){
		$post=$this->input->post();
		$result = $this->BusquedaTraslado_Model->findTraslado($post["Referencia"]);
		if (!empty($result)){
			if(!empty($post["Referencia"])){
		?>
		<div class="table-responsive">
			<table class="table" id="trasladoPresupuestarios">
				<thead class="thead-light">
				<tr>
					<th scope="col">Correlativo</th>
					<th scope="col">Descripción</th>
					<th scope="col">Salida</th>
					<th scope="col">Entrada</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
			<?php
				foreach ($result as $datos){
			?>
					<tr>
						<td id="Correlativo<?php echo $datos->correlativo; ?>"><?php echo $datos->correlativo; ?></td>
						<td id="Descripción<?php echo $datos->correlativo; ?>"><?php echo $datos->descripcion; ?></td>
						<td id="Salida<?php echo $datos->correlativo; ?>"><?php echo $datos->Total_Salida; ?></td>
						<td id="Entrada<?php echo $datos->correlativo; ?>"><?php echo $datos->Total_Entrada; ?></td>
						<td>
							<button class='btn btn-primary edit' type="submit" value="<?php echo $datos->correlativo; ?>">
								Seleccionar
							</button>
						</td>
					</tr>
		<?php
				}
			}
		?>
				</tbody>
			</table>
		</div>
	<?php
		}
		else{
			if(!empty($post["Referencia"])){
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

	public function getTraslado(){
		$post = $this->input->post('id');
		$resTraslado = $this->BusquedaTraslado_Model->getTraslado($post);
		echo json_encode($resTraslado);
	}

	public function getSalidas(){
		$post = $this->input->post('id');
		$resTraslado = $this->BusquedaTraslado_Model->getSalidas($post);
		foreach ($resTraslado as $rs){
		?>
		<tr>
			<td>
				<input class="form-control cuenta" value="<?php echo $rs->ccodcta.'-'.$rs->Nombre_Cuenta?>" readonly>
			</td>
			<td>
				<input class="form-control agencia" value="<?php echo $rs->Agencia?>" readonly>
			</td>
			<td>
				<input class="form-control montoS monto" type="text" value="<?php echo $rs->monto?>" readonly>
			</td>
		</tr>
		<?php
		}
	}

	public function getEntradas(){
		$post = $this->input->post('id');
		$resTraslado = $this->BusquedaTraslado_Model->getEntradas($post);
		foreach ($resTraslado as $rs){
		?>
		<tr>
			<td>
				<input class="form-control cuenta" value="<?php echo $rs->ccodcta.'-'.$rs->Nombre_Cuenta?>" readonly>
			</td>
			<td>
				<input class="form-control agencia" value="<?php echo $rs->Agencia?>" readonly>
			</td>
			<td>
				<input class="form-control montoE monto" type="text" value="<?php echo $rs->monto?>" readonly>
			</td>
		</tr>
		<?php
		}
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'24');
		if($permiso[0]->Contador>0) {
		}
		else{
			?>
			<script type="text/javascript">
				alert("No posee permisos para ingresar a éste modulo");
				window.setTimeout(function(){
					location = ('<?php echo site_url("Login")?>');
				} ,20);
			</script>
			<?php
		}
	}

}

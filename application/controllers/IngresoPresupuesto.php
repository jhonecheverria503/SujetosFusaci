<?php


class IngresoPresupuesto extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("IngresoPresupuesto_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 19,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Ingreso a Presupuesto.",
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
		$this->load->view("PresupuestoAutoizado/IngresoPresupuesto");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("PresupuestoAutoizado/end_IngresoPresupuesto");
	}

	public function getAnios(){
		$anios = $this->IngresoPresupuesto_Model->getAnios();
		echo '<option value="null">Seleccione</option>';
		foreach ($anios as $fila) {
			?>
			<option value="<?php echo $fila->anio ?>" <?php if($fila->anio==DATE('Y')){echo 'Selected';}?>><?php echo $fila->anio ?></option>
			<?php
		}
	}

	public function getCuentas(){
		$proveedor = $this->IngresoPresupuesto_Model->getCuentas();
		echo '<option value="null">Seleccione...</option>';
		foreach ($proveedor as $fila) {
			?>
			<option value="<?php echo rtrim($fila->ccodcta) ?>"><?php echo rtrim($fila->ccodcta).' - '.$fila->cdescrip ?></option>
			<?php
		}
	}

	public function getParameter(){
		$datos = $this->input->post();
		$oficinas = $this->IngresoPresupuesto_Model->getOficina();
		$i = 0;
		foreach ($oficinas as $ofi) {
			$dataInsert[$i] = array(
				"anio"=>$datos['cbxAnio'],
				"ccodcta"=>$datos['cbxCuenta'],
				"ccodofi"=>$ofi->ccodofi,
				"enero"=>0.00,
				"febrero"=>0.00,
				"marzo"=>0.00,
				"abril"=>0.00,
				"mayo"=>0.00,
				"junio"=>0.00,
				"julio"=>0.00,
				"agosto"=>0.00,
				"septiembre"=>0.00,
				"octubre"=>0.00,
				"noviembre"=>0.00,
				"diciembre"=>0.00,
				"estado"=>1,
				"fecCre"=>date("d/m/Y H:m:s"),
				"usuCre"=>$_SESSION['usuario'],
				"fecUpd"=>date("d/m/Y H:m:s"),
				"usuUpd"=>$_SESSION['usuario']
			);
			$i++;
		}
		$resInsert = $this->IngresoPresupuesto_Model->insertPresupuesto($dataInsert);
		$resInsertHistorico = $this->IngresoPresupuesto_Model->insertHistoricoPresupuesto($dataInsert);
		if($resInsert){
			$dataBitacora = array(
					"idAccion" => 24,
					"descripcion" => "Usuario ".$_SESSION['usuario']." Ingreso al presupuesto del año: '".$datos['cbxAnio']."' la cuenta : '".$datos['cbxCuenta']."' .",
					"usuario" => $_SESSION['usuario'],
					"dirIp"=>$_SERVER['REMOTE_ADDR'],
					"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
			);
			$this->Bitacora_Model->insertAccion($dataBitacora);
			$array['estado'] = True;
			$array['estado'] = True;
			$array['descripcion'] = 'Cuenta Añadida Correctamente';
			echo json_encode($array);
		}
		else{
			$array['estado'] = False;
			$array['descripcion'] = 'Hubo un error al añadir cuenta, contactese con el administrador del sistema.';
			echo json_encode($array);
		}
	}

	private function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'29');
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

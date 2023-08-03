<?php


class TrasladosPresupuestarios extends CI_CONTROLLER{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("TrasladosPresupuestarios_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 17,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Traslados Presupuestarios.",
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
		$this->load->view("TrasladosPresupuestarios/TrasladosPresupuestarios");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("TrasladosPresupuestarios/end_TrasladosPresupuestarios");
	}

	public function getTraslado(){
		$data = $this->input->post();
		$json = array();
		$j=0;
		for ($i = 0; $i <= (COUNT($data["cbxCuentaS"]) - 1); $i++) {
			if ($data["cbxMes"] == 'null') {
				$json['estado'] = false;
				$json['descripcion'] = "Por favor Seleccione una Mes";
				echo json_encode($json);
				die();
			}
			if ($data["cbxAnio"] == 'null') {
				$json['estado'] = false;
				$json['descripcion'] = "Por favor seleccione un Año";
				echo json_encode($json);
				die();
			}
			if ($data["cbxCuentaS"][$i] == '0' or $data["cbxCuentaS"][$i] == "null") {
				$json['estado'] = false;
				$json['descripcion'] = "Por favor ingrese una Cuenta Contable en la posición de Salidas N° " . ($i + 1);
				echo json_encode($json);
				die();
			}
			if ($data["cbxAgenciaS"][$i] == '0' or $data["cbxAgenciaS"][$i] == "null") {
				$json['estado'] = false;
				$json['descripcion'] = "Por favor ingrese una Agencia en la posición de Salidas N° " . ($i + 1);
				echo json_encode($json);
				die();
			}
		}
		for ($i = 0; $i <= (COUNT($data["cbxCuentaE"]) - 1); $i++) {
			if($data["cbxCuentaE"][$i]=='0' OR $data["cbxCuentaE"][$i]=="null") {
				$json['estado'] = false;
				$json['descripcion'] = "Por favor ingrese una Cuenta Contable en la posición de Entrada N° ".($i+1);
				echo json_encode($json);
				die();
			}
			if($data["cbxAgenciaE"][$i]=='0' OR $data["cbxAgenciaE"][$i]=="null") {
				$json['estado'] = false;
				$json['descripcion'] = "Por favor ingrese una Agencia en la posición de Entrada N° ".($i+1);
				echo json_encode($json);
				die();
			}
		}
		$mesLetra = $this->convertMes($data['cbxMes']);
		if(isset($data)){
			//Proceso de restar
			$contadorSalidas = 0;
			$contadorEntradas = 0;
			for($i=0;$i<COUNT($data['cbxCuentaS']);$i++){
				$monto = $data['txtMontoS'][$i];
				$ccodofi = $this->validaAgencia($data['cbxAgenciaS'][$i],($i+1),'Salida');
				$ccodcta = $this->validaCuenta($data['cbxCuentaS'][$i],$data['cbxAgenciaS'][$i],($i+1),'Salida');
				$anio = $data['cbxAnio'];
				$dataTraslado[$j] = array(
						"anio"=>$data['cbxAnio'],
						"mes"=>$mesLetra,
						"ccodcta"=>$ccodcta,
						"ccodofi"=>$ccodofi,
						"monto"=>$monto,
						"tipo"=>'Salida',
						"descripcion"=>$data['txtDescripcion'],
						"correlativo"=>$data['txtCorr'],
						"estado"=>1,
						"fecCre"=>date("d/m/Y"),
						"usuCre"=>$_SESSION['usuario'],
						"fecUpd"=>date("d/m/Y"),
						"usuUpd"=>$_SESSION['usuario']
				);
				$resSalida = $this->TrasladosPresupuestarios_Model->salidaPresupuesto($mesLetra,$anio,$ccodofi,$ccodcta,$monto);
				if($resSalida>0){
					$contadorSalidas++;
					$j++;
					continue;
				}
				else{
					$json['estado'] = false;
					$json['descripcion'] = "Error al registrar la salida N° ".($i+1);
					echo json_encode($json);
					die();
				}
			}
			if(COUNT($data['cbxCuentaS'])!=$contadorSalidas){
				$json['estado'] = false;
				$json['descripcion'] = "Se registraron ".$contadorSalidas." Salidas de ".(COUNT($data['cbxCuentaS']))."; Por favor verificar.";
				echo json_encode($json);
				die();
			}
			else{
				//Proceso de sumar
				for($i=0;$i<COUNT($data['cbxCuentaE']);$i++){
					$monto = $data['txtMontoE'][$i];
					$ccodofi = $this->validaAgencia($data['cbxAgenciaE'][$i],($i+1),'Entrada');
					$ccodcta = $this->validaCuenta($data['cbxCuentaE'][$i],$data['cbxAgenciaE'][$i],($i+1),'Entrada');
					$anio = $data['cbxAnio'];
					$dataTraslado[$j] = array(
							"anio"=>$anio,
							"mes"=>$mesLetra,
							"ccodcta"=>$ccodcta,
							"ccodofi"=>$ccodofi,
							"monto"=>$monto,
							"tipo"=>'Entrada',
							"descripcion"=>$data['txtDescripcion'],
							"correlativo"=>$data['txtCorr'],
							"estado"=>1,
							"fecCre"=>date("d/m/Y"),
							"usuCre"=>$_SESSION['usuario'],
							"fecUpd"=>date("d/m/Y"),
							"usuUpd"=>$_SESSION['usuario']
					);
					$resEntrada = $this->TrasladosPresupuestarios_Model->entradaPresupuesto($mesLetra,$anio,$ccodofi,$ccodcta,$monto);
					if($resEntrada>0){
						$contadorEntradas++;
						$j++;
						continue;
					}
					else{
						$json['estado'] = false;
						$json['descripcion'] = "Error al registrar la Entrada N° ".($i+1);
						echo json_encode($json);
						die();
					}
				}
				if(COUNT($data['cbxCuentaE'])!=$contadorEntradas){
					$json['estado'] = false;
					$json['descripcion'] = "Se registraron ".$contadorSalidas." Entradas de ".(COUNT($data['cbxCuentaS']))."; Por favor verificar.";
					echo json_encode($json);
					die();
				}
				else{
					$resTraslado = $this->TrasladosPresupuestarios_Model->insertTraslados($dataTraslado);
					if($resTraslado) {
						$json['estado'] = true;
						$json['descripcion'] = "Entradas y salidas registradas correctamente";
						echo json_encode($json);
						die();
					}
					else{
						$json['estado'] = false;
						$json['descripcion'] = "Error al insertar datos del traslado en tabla de Traslados; Por favor verificar.";
						echo json_encode($json);
						die();
					}
				}
			}
		}
	}

	public function getAnios(){
		$anios = $this->TrasladosPresupuestarios_Model->getAnios();
		echo '<option value="null">Seleccione</option>';
		foreach ($anios as $fila) {
			?>
			<option value="<?php echo $fila->anio ?>" <?php if($fila->anio==DATE('Y')){echo 'Selected';}?>><?php echo $fila->anio ?></option>
			<?php
		}
	}

	public function getCorr(){
		$corrModel = substr(strstr($_SESSION['Dia'],'/'),1,2).'-'.substr(strstr($_SESSION['Dia'],'/'),4,4).'-';
		$corr = $this->TrasladosPresupuestarios_Model->getCorr();
		if (!empty($corr)){
			$corr = $corrModel.str_pad($corr[0]->corr, 5, '0', STR_PAD_LEFT);
			echo $corr;
		}
		else{
			$corr = $corrModel.'00001';
			echo $corr;
		}
	}

	public function getCuentas(){
		$data = $this->input->post();
		$proveedor = $this->TrasladosPresupuestarios_Model->getCuentas();
		echo '<option value="null">Seleccione...</option>';
		foreach ($proveedor as $fila) {
			?>
			<option value="<?php echo rtrim($fila->ccodcta) ?>"><?php echo rtrim($fila->ccodcta).' - '.$fila->cdescrip ?></option>
			<?php
		}
	}

	public function getAgencias(){
		$data = $this->input->post();
		$categorias = $this->TrasladosPresupuestarios_Model->getAgencias();
		echo '<option value="null">Seleccione...</option>';
		foreach ($categorias as $fila) {
		?>
			<option value="<?php echo rtrim($fila->ccodofi) ?>"><?php echo $fila->cnomofi ?></option>
		<?php
		}
	}

	public function validaAgencia($ccodofi,$posicion,$tipo){
		$resultado=$this->TrasladosPresupuestarios_Model->validaAgencia($ccodofi);
		if($resultado[0]->Contador>0) {
			return str_pad($ccodofi, 3, '0', STR_PAD_LEFT);
		}
		else{
			$array = array();
			$array['estado'] = False;
			$array['descripcion'] = 'Oficina No Valida en la posición de '.$tipo.': "'.$posicion.'", Oficina: "'.$ccodofi.'"';
			echo json_encode($array);
			die();
		}
	}

	public function validaCuenta($ccodcta,$oficina,$posicion,$tipo){
		$resultado=$this->TrasladosPresupuestarios_Model->validaCuenta($ccodcta,$oficina);
		if($resultado[0]->Contador>0) {
			return trim($ccodcta);
		}
		else{
			$array = array();
			$array['estado'] = False;
			$array['descripcion'] = 'Cuenta Contable No valida en la posición de '.$tipo.': "'.$posicion.'", Cuenta Contable: "'.$ccodcta.'"';
			echo json_encode($array);
			die();
		}
	}

	public function  convertMes($noMes){
		switch ($noMes) {
			case $noMes=='1':
				$mes = "enero";
				break;
			case $noMes=='2':
				$mes =  "febrero";
				break;
			case $noMes=='3':
				$mes =  "marzo";
				break;
			case $noMes=='4':
				$mes =  "abril";
				break;
			case $noMes=='5':
				$mes =  "mayo";
				break;
			case $noMes=='6':
				$mes =  "junio";
				break;
			case $noMes=='7':
				$mes =  "julio";
				break;
			case $noMes=='8':
				$mes =  "agosto";
				break;
			case $noMes=='9':
				$mes =  "septiembre";
				break;
			case $noMes=='10':
				$mes =  "octubre";
				break;
			case $noMes=='11':
				$mes =  "noviembre";
				break;
			case $noMes=='12':
				$mes =  "diciembre";
				break;
			default:
				$data = array();
				$data['estado'] = false;
				$data['descripcion'] = "Mes no valido";
				echo json_encode($data);
				die();
		}
		return $mes;
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'23');
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

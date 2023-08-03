<?php


class CargaPresupuesto extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("CargaPresupuesto_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 17,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Carga de presupuesto.",
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
		$this->load->view("PresupuestoAutoizado/CargaPresupuesto");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("PresupuestoAutoizado/end_CargaPresupuesto");
	}

	public function getFile(){
		require_once APPPATH . "/third_party/PHPExcel.php";
		$datos=$this->input->post();
		$array = array();
		if($datos['cbxAnio']=='null'){
			$array['estado'] = False;
			$array['descripcion'] = 'No se ha seleccionado ningún año';
			echo json_encode($array);
			exit();
		}
		$this->validaAnio($datos['cbxAnio']);
		if($_FILES['uploadFile']['name']<>''){
			$path = 'uploads/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uploadFile')) {
				$error = array('error' => $this->upload->display_errors());
				$error['error'] = $error['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>' ? "El tipo de archivo que está intentando cargar no está permitido." :$error['error'];
				$array['estado'] = False;
				$array['descripcion'] = $error['error'];
				echo json_encode($array);
			}
			else{
				$data = array('upload_data' => $this->upload->data());
			}
			if(empty($error)){
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
				}
				else{
					$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$i=0;
					foreach ($allDataInSheet as $value) {
						if($i==0){
							$resValida = $this->validaDocumento($value);
							if($resValida>0){
								$i = 1;
								continue;
							}
						}
						if($value['A']==NULL AND $value['B']==NULL AND $value['C']==NULL
								AND $value['D']==NULL AND $value['E']==NULL AND $value['F']==NULL
								AND $value['G']==NULL AND $value['H']==NULL AND $value['I']==NULL
								AND $value['J']==NULL AND $value['K']==NULL AND $value['L']==NULL
								AND $value['M']==NULL AND $value['N']==NULL){
							break;
						}
						$dataInsert[$i] = array(
							"anio"=>$datos['cbxAnio'],
							"ccodcta"=>$this->validaCuenta(trim($value['A']),($i+1),'A'),
							"ccodofi"=>$this->validaOficina($value['B'],($i+1),'B'),
							"enero"=>$this->validaEspacios($value['C'],($i+1),'C'),
							"febrero"=>$this->validaEspacios($value['D'],($i+1),'D'),
							"marzo"=>$this->validaEspacios($value['E'],($i+1),'E'),
							"abril"=>$this->validaEspacios($value['F'],($i+1),'F'),
							"mayo"=>$this->validaEspacios($value['G'],($i+1),'G'),
							"junio"=>$this->validaEspacios($value['H'],($i+1),'H'),
							"julio"=>$this->validaEspacios($value['I'],($i+1),'I'),
							"agosto"=>$this->validaEspacios($value['J'],($i+1),'J'),
							"septiembre"=>$this->validaEspacios($value['K'],($i+1),'K'),
							"octubre"=>$this->validaEspacios($value['L'],($i+1),'L'),
							"noviembre"=>$this->validaEspacios($value['M'],($i+1),'M'),
							"diciembre"=>$this->validaEspacios($value['N'],($i+1),'N'),
							"estado"=>1,
							"fecCre"=>date("d/m/Y H:m:s"),
							"usuCre"=>$_SESSION['usuario'],
							"fecUpd"=>date("d/m/Y H:m:s"),
							"usuUpd"=>$_SESSION['usuario']
						);
						$i++;
					 }
					$resInsert = $this->CargaPresupuesto_Model->insertPresupuesto($dataInsert);
					$resInsertHistorico = $this->CargaPresupuesto_Model->insertHistoricoPresupuesto($dataInsert);
					if($resInsert){
						$dataBitacora = array(
								"idAccion" => 18,
								"descripcion" => "Usuario ".$_SESSION['usuario']." Ingreso presupuesto para año: '".$datos['cbxAnio']."' con nombre de archivo: '".$import_xls_file."' .",
								"usuario" => $_SESSION['usuario'],
								"dirIp"=>$_SERVER['REMOTE_ADDR'],
								"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
						);
						$this->Bitacora_Model->insertAccion($dataBitacora);
						$array['estado'] = True;
						$array['descripcion'] = 'Presupuesto cargado correctamente';
						echo json_encode($array);
					}
					else{
						$array['estado'] = False;
						$array['descripcion'] = 'Hubo un error al cargar presupuesto, contactese con el administrador del sistema.';
						echo json_encode($array);
					}
				}
				catch (Exception $e) {
					$array['estado'] = False;
					$array['descripcion'] = 'Error al cargar archivo: "'.pathinfo($inputFileName, PATHINFO_BASENAME).'" Error: "'.$e->getMessage().'"';
					echo json_encode($array);
					die();
				}
			}
		}
		else{
			$array['estado'] = False;
			$array['descripcion'] = 'No se ha seleccionado ningún archivo';
			echo json_encode($array);
		}

	}

	public function validaAnio($input = null){
		if($input!=null){
			$resultado=$this->CargaPresupuesto_Model->getAnio($input);
			if($resultado[0]->Contador>0){
				$resUpdate = $this->changeFiles($input);
				if($resultado[0]->Contador==$resUpdate){
					return 1;
				}
				else{
					$array['estado'] = False;
					$array['descripcion'] = 'No se ha podido eliminar los registros anteriores, por favor verificar';
					echo json_encode($array);
					exit();
				}
			}
		}
		else{
			$data = $this->input->post();
			$resultado=$this->CargaPresupuesto_Model->getAnio($data['anio']);
			if($resultado[0]->Contador>0){
				echo true;
			}
			else{
				echo false;
			}
		}
	}

	public function validaOficina($oficina,$posición,$celda){
		$resultado=$this->CargaPresupuesto_Model->getOficina($oficina);
		if($resultado[0]->Contador>0) {
			return str_pad($oficina, 3, '0', STR_PAD_LEFT);
		}
		else{
			$array = array();
			$array['estado'] = False;
			$array['descripcion'] = 'Oficina No Valida en la celda: "'.$celda.$posición.'", Oficina: "'.$oficina.'"';
			echo json_encode($array);
			die();
		}
	}

	public function validaCuenta($ccodcta,$posición,$celda){
		$resultado=$this->CargaPresupuesto_Model->getCuenta($ccodcta);
		if($resultado[0]->Contador>0) {
			return trim($ccodcta);
		}
		else{
			$array = array();
			$array['estado'] = False;
			$array['descripcion'] = 'Cuenta Contable No valida en la celda: "'.$celda.$posición.'", Cuenta Contable: "'.$ccodcta.'"';
			echo json_encode($array);
			die();
		}
	}

	public function validaEspacios($espacio,$posición,$celda){
		if($espacio == 0) {
			return 0;
		}
		elseif($espacio == NULL){
			$array = array();
			$array['estado'] = False;
			$array['descripcion'] = 'Espacio Vacio en la celda: "'.$celda.$posición.'"';
			echo json_encode($array);
			die();
		}
		else{
			return floatval($espacio);
		}
	}

	public function validaDocumento($datos){
		$count = 0;
		switch ($datos) {
			case isset($datos['A']) and $datos['A']=='Cuenta_Contable':
				$count = $count + 1;
			case isset($datos['B']) and $datos['B']=='Codigo_Agencia':
				$count = $count + 1;
			case isset($datos['C']) and $datos['C']=='Enero':
				$count = $count + 1;
			case isset($datos['D']) and $datos['D']=='Febrero':
				$count = $count + 1;
			case isset($datos['E']) and $datos['E']=='Marzo':
				$count = $count + 1;
			case isset($datos['F']) and $datos['F']=='Abril':
				$count = $count + 1;
			case isset($datos['G']) and $datos['G']=='Mayo':
				$count = $count + 1;
			case isset($datos['H']) and $datos['H']=='Junio':
				$count = $count + 1;
			case isset($datos['I']) and $datos['I']=='Julio':
				$count = $count + 1;
			case isset($datos['J']) and $datos['J']=='Agosto':
				$count = $count + 1;
			case isset($datos['K']) and $datos['K']=='Septiembre':
				$count = $count + 1;
			case isset($datos['L']) and $datos['L']=='Octubre':
				$count = $count + 1;
			case isset($datos['M']) and $datos['M']=='Noviembre':
				$count = $count + 1;
			case isset($datos['N']) and $datos['N']=='Diciembre':
				$count = $count + 1;
			case isset($datos['CO']) and $datos['CO']=='P1@n7Pr3$uPu3$70':
				$count = $count + 1;
		}
		if($count==15){
			return 1;
		}
		else{
			$array = array();
			$array['estado'] = False;
			$array['descripcion'] = 'Por favor ingresar el documento correcto autorizado por "Desarrollo y Tecnología"';
			echo json_encode($array);
			die();
		}
	}

	public function changeFiles($anio){
		$updateStatus = $this->CargaPresupuesto_Model->changeRegs($anio);
		$updateStatus = $this->CargaPresupuesto_Model->changeRegsHistorico($anio);
		return $updateStatus;
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'21');
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

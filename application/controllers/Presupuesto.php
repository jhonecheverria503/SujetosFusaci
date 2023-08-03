<?php


class Presupuesto extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Presupuesto_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 19,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Descarga de Presupuesto.",
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
		$this->load->view("PresupuestoAutoizado/Presupuesto");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("PresupuestoAutoizado/end_Presupuesto");
	}

	public function getAnios(){
		$anios = $this->Presupuesto_Model->getAnios();
		echo '<option value="*">Seleccione</option>';
		foreach ($anios as $fila) {
		?>
			<option value="<?php echo $fila->anio ?>" <?php if($fila->anio==DATE('Y')){echo 'Selected';}?>><?php echo $fila->anio ?></option>
		<?php
		}
	}

	public function getParameters(){
		$data = $this->input->post();
		if($data['cbxFormato']=='pdf'){
			$this->downloadPdf($data['cbxAnio'],isset($data['trasPre'])?$data['trasPre']:null);
		}
		elseif ($data['cbxFormato']=='excel'){
			$this->downloadExcel($data['cbxAnio'],isset($data['trasPre'])?$data['trasPre']:null);
		}
		else{
		?>
			<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
			<script>
				$(document).ready(function() {
					swal({
						title: "Error!",
						text: "Formato no Seleccionado",
						timer: 1500,
						type: 'error',
						closeOnConfirm: true,
						closeOnCancel: true
					});
					setTimeout( function(){
						window.close();
					}, 1500 );
				})
			</script>
		<?php
		}
	}

	public function downloadPdf($anio,$trasPres = null){
		if($anio!='*') {
			if(isset($trasPres)) {
				$data['dataPresupuesto'] = $this->Presupuesto_Model->getPresupuesto($anio);
			}
			else{
				$data['dataPresupuesto'] = $this->Presupuesto_Model->getHistoricoPresupuesto($anio);
			}
			$data['anio'] = $anio;
			if(COUNT($data['dataPresupuesto'])>0) {
				$this->load->view("PresupuestoAutoizado/PDF_Presupuesto", $data);
			}
		}
		else{
			echo '<script>alert("No se seleccionó un año correcto")</script>';
			echo "<script>window.close();</script>";
		}
	}

	public function downloadExcel($anio,$trasPres = null){
		if(isset($anio)){
			if(isset($trasPres)) {
				$resPresupuesto = $this->Presupuesto_Model->getPresupuesto($anio);
			}
			else{
				$resPresupuesto = $this->Presupuesto_Model->getHistoricoPresupuesto($anio);
			}
			if(COUNT($resPresupuesto)>0){
				//Cargamos la librería de excel.
				$this->load->library('excel');
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->setCellValue("A1", 'PRESUPUESTO: '.$anio.'');
				$this->excel->getActiveSheet()->setTitle('PRESUPUESTO'.$anio.'');
				$this->excel->setActiveSheetIndex(0)->mergeCells('A1:P1');
				//Contador de filas
				$contador = 2;
				//Le aplicamos negrita a los títulos de la cabecera.
				$estiloTituloReporte = array(
						'font' => array(
								'name' => 'Arial',
								'bold' => true,
						),
						'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_SOLID,
								'color' => array('rgb' => 'B0C8E0')
						),
						'borders' => array(
								'allborders' => array(
										'style' => PHPExcel_Style_Border::BORDER_THIN
								)
						),
				);
				$style = array(
						'alignment' => array(
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						)
				);
				$this->excel->getDefaultStyle()->applyFromArray($style);
				$this->excel->getActiveSheet()->getStyle('A1:P1')->applyFromArray($estiloTituloReporte);
				$this->excel->setActiveSheetIndex(0)->mergeCells('A1:P1');
				//Contador de filas
				$contador = 2;
				$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
				//Le aplicamos negrita a los títulos de la cabecera.
				$this->excel->getActiveSheet()->getStyle("A{$contador}:P{$contador}")->getFont()->setBold(true);
				//Le aplicamos color a los titulos.
				$this->excel->getActiveSheet()->getStyle("A{$contador}:P{$contador}")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('70AD47');
				//Seteamos los nombres de las columnas
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'CUENTA_CONTABLE');
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'NOMBRE_CUENTA_CONTABLE');
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'CODIGO_OFICINA');
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'NOMBRE_OFICINA');
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'ENERO');
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'FEBRERO');
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'MARZO');
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'ABRIL');
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'MAYO');
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'JUNIO');
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'JULIO');
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'AGOSTO');
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'SEPTIEMBRE');
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'OCTUBRE');
				$this->excel->getActiveSheet()->setCellValue("O{$contador}", 'NOVIEMBRE');
				$this->excel->getActiveSheet()->setCellValue("P{$contador}", 'DICIEMBRE');
				foreach ($resPresupuesto as $d) {
					//Incrementamos una fila más, para ir a la siguiente.
					$contador++;
					//Informacion de las filas de la consulta.
					$this->excel->getActiveSheet()->setCellValue("A{$contador}", $d->ccodcta);
					$this->excel->getActiveSheet()->setCellValue("B{$contador}", $d->nombCcodcta);
					$this->excel->getActiveSheet()->setCellValue("C{$contador}", $d->ccodofi);
					$this->excel->getActiveSheet()->setCellValue("D{$contador}", $d->nombCcodofi);
					$this->excel->getActiveSheet()->setCellValue("E{$contador}", $d->enero);
					$this->excel->getActiveSheet()->setCellValue("F{$contador}", $d->febrero);
					$this->excel->getActiveSheet()->setCellValue("G{$contador}", $d->marzo);
					$this->excel->getActiveSheet()->setCellValue("H{$contador}", $d->abril);
					$this->excel->getActiveSheet()->setCellValue("I{$contador}", $d->mayo);
					$this->excel->getActiveSheet()->setCellValue("J{$contador}", $d->junio);
					$this->excel->getActiveSheet()->setCellValue("K{$contador}", $d->julio);
					$this->excel->getActiveSheet()->setCellValue("L{$contador}", $d->agosto);
					$this->excel->getActiveSheet()->setCellValue("M{$contador}", $d->septiembre);
					$this->excel->getActiveSheet()->setCellValue("N{$contador}", $d->octubre);
					$this->excel->getActiveSheet()->setCellValue("O{$contador}", $d->noviembre);
					$this->excel->getActiveSheet()->setCellValue("P{$contador}", $d->diciembre);
				}
				//Le ponemos un nombre al archivo que se va a generar.
				$archivo = "presupuesto".$anio.".xls";
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="' . $archivo . '"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
				$dataBitacora = array(
						"idAccion" => 15,
						"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó reporte Presupuesto Año : ".$anio." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
						"usuario" => $_SESSION['usuario'],
						"dirIp"=>$_SERVER['REMOTE_ADDR'],
						"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
				);
				$this->Bitacora_Model->insertAccion($dataBitacora);
				//Hacemos una salida al navegador con el archivo Excel.
				$objWriter->save('php://output');
			}
		}
		else{
			echo '<script>alert("No ha seleccionado un formato valido")</script>';
			echo "<script>window.close();</script>";
		}
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'22');
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

<?php


class ReporteTraslado extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("ReporteTraslado_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 23,
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
		$this->load->view("Reportes/ReporteTraslado");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Reportes/end_ReporteTraslado");
	}

	public function getParameters(){
		$post = $this->input->post();
		$post['txtFecIni'] = isset($post['txtFecIni']) ? date('d/m/Y',strtotime($post['txtFecIni'])) : Null;
		$post['txtFecFin'] = isset($post['txtFecFin']) ? date('d/m/Y',strtotime($post['txtFecFin'])) : Null;
		if($post['cbxFormato']=='pdf'){
			$this->downloadPdf($post['txtFecIni'],$post['txtFecFin']);
		}
		elseif ($post['cbxFormato']=='excel'){
			$this->downloadExcel($post['txtFecIni'],$post['txtFecFin']);
		}
		else{
			echo '<script>alert("No ha seleccionado un formato valido")</script>';
			echo "<script>window.close();</script>";
		}
	}

	public function downloadPdf($fecIni,$fecFin){
		$data['dataTraslado'] = $this->ReporteTraslado_Model->getTraslados($fecIni,$fecFin);
		if(COUNT($data['dataTraslado'])>0) {
			$data['fecIni'] = $fecIni;
			$data['fecFin'] = $fecFin;
			$this->load->view("Reportes/PDF_ReporteTraslado", $data);
		}
	}

	public function downloadExcel($fecIni,$fecFin){
		$resTraslados = $this->ReporteTraslado_Model->getTraslados($fecIni,$fecFin);
		if(COUNT($resTraslados)>0){
			//Cargamos la librería de excel.
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setCellValue("A1", 'TRASLADOS PRESUPUESTARIOS DEL: '.$fecIni.' AL: '.$fecFin);
			$this->excel->getActiveSheet()->setTitle('TRASLADOS PRESUPUESTARIOS');
			$this->excel->setActiveSheetIndex(0)->mergeCells('A1:H1');
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
			$this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloReporte);
			$this->excel->setActiveSheetIndex(0)->mergeCells('A1:H1');
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
			//Le aplicamos negrita a los títulos de la cabecera.
			$this->excel->getActiveSheet()->getStyle("A{$contador}:H{$contador}")->getFont()->setBold(true);
			//Le aplicamos color a los titulos.
			$this->excel->getActiveSheet()->getStyle("A{$contador}:H{$contador}")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('70AD47');
			//Seteamos los nombres de las columnas
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'FECHA_PROCESO');
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'MES_Y_AÑO');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'CÓDIGO_DE_CUENTA_CONTABLE');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'NOMBRE_CUENTA_CONTABLE');
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'NOMBRE_DE_AGENCIA');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'DESCRIPCIÓN');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'MONTO_SALIDA');
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'MONTO_ENTRADA');
			foreach ($resTraslados as $d) {
				//Incrementamos una fila más, para ir a la siguiente.
				$contador++;
				//Informacion de las filas de la consulta.
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $d->fechaProceso);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $d->mesAnio);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $d->ccodcta);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $d->nombreCuenta);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", $d->nombreAgencia);
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", $d->descripcion);
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", $d->montoSalida);
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $d->montoEntrada);
			}
			//Le ponemos un nombre al archivo que se va a generar.
			$archivo = "TrasladoPresupuestario.xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $archivo . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$dataBitacora = array(
					"idAccion" => 15,
					"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó reporte Traslados Presupuestarios Del: ".$fecIni." Al: ".$fecFin." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
					"usuario" => $_SESSION['usuario'],
					"dirIp"=>$_SERVER['REMOTE_ADDR'],
					"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
			);
			$this->Bitacora_Model->insertAccion($dataBitacora);
			//Hacemos una salida al navegador con el archivo Excel.
			$objWriter->save('php://output');
		}
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'25');
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

<?php


class FacturasGeneradas extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("FacturasGeneradas_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 03,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Facturas Generadas.",
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
		$this->load->view("Reportes/FacturasGeneradas");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Reportes/end_FacturasGeneradas");
	}

	public function getFacturas(){
		$fechaInicio = date("d/m/Y",strtotime($this->input->post("FechaInicio")));
		$fechaFin = date("d/m/Y",strtotime($this->input->post("FechaFin")));
		$res = $this->FacturasGeneradas_Model->getFacturas($fechaInicio, $fechaFin);
		if (COUNT($res) > 0){
			//Cargamos la librería de excel.
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setCellValue("A1", 'FACTURAS GENERADAS DEL '.$fechaInicio.' AL '.$fechaFin.'.');
			$this->excel->getActiveSheet()->setTitle('FACTURAS GENERADAS');
			$this->excel->setActiveSheetIndex(0)->mergeCells('A1:N1');
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
			$this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($estiloTituloReporte);
			$this->excel->setActiveSheetIndex(0)->mergeCells('A1:N1');
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
			//Le aplicamos negrita a los títulos de la cabecera.
			$this->excel->getActiveSheet()->getStyle("A{$contador}:N{$contador}")->getFont()->setBold(true);
			//Le aplicamos color a los titulos.
			$this->excel->getActiveSheet()->getStyle("A{$contador}:N{$contador}")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('70AD47');
			//Seteamos los nombres de las columnas
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'DUI');
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'NIT');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'NOMBRES');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'APELLIDOS');
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'FECHA DE EMISIÓN');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'CORRELATIVO TEMPORAL');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'CORRELATIVO DEFINITIVO');
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'TIPO');
			$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'COMPRA DE');
			$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'GASTO');
			$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'ISR');
			$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'MONTO LIQUIDO');
			$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'ESTADO');
			$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'USUARIO');
			foreach ($res as $d) {
				//Incrementamos una fila más, para ir a la siguiente.
				$contador++;
				//Informacion de las filas de la consulta.
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $d->dui);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $d->nit);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $d->nombre);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $d->apellido);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", $d->fecCrea);
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", $d->corTemp);
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", $d->corAsig);
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $d->Tipo);
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", $d->detalle);
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", $d->gasto);
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", $d->isr);
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", $d->monto);
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", $d->Estados);
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", $d->usuCrea);
			}
			//Le ponemos un nombre al archivo que se va a generar.
			$archivo = "FacturasGeneradas.xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $archivo . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$dataBitacora = array(
				"idAccion" => 15,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó reporte de Facturas Generadas de la semana del ".date("d/m/Y",strtotime($fechaInicio))." al ".date("d/m/Y",strtotime($fechaFin))." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
			);
			$this->Bitacora_Model->insertAccion($dataBitacora);
			//Hacemos una salida al navegador con el archivo Excel.
			$objWriter->save('php://output');
		}
		else{
			echo '
				<script>alert("NO HAY DATOS PARA MOSTRAR");</script>
				';
			echo "<script>window.close();</script>";
		}
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'13');
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

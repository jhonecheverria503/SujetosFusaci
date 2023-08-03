<?php


class EjecucionPresupuestaria extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("EjecucionPresupuestaria_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 22,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Ejecución Presupuestario.",
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
		$this->load->view("EjecucionPresupuestaria/EjecucionPresupuestaria");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("EjecucionPresupuestaria/end_EjecucionPresupuestaria");
	}

	public function getParameters(){
		$post = $this->input->post();;
		$this->downloadExcel($post['txtFecIni'],$post['txtFecFin']);
	}

	public function downloadExcel($fecIni,$fecFin){
		$mesIni = date("m",strtotime($fecIni));
		$mesFin = date("m",strtotime($fecFin));
		$resEjecucion = $this->EjecucionPresupuestaria_Model->getPresupuesto(date("Y",strtotime($fecFin)));
		if(COUNT($resEjecucion)>0){
			//Cargamos la librería de excel.
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setCellValue("A1", 'EJECUCIÓN PRESUPUESTARIA DEL: '.$fecIni.' AL: '.$fecFin);
			$this->excel->getActiveSheet()->setTitle('EJECUCIÓN PRESUPUESTARIA');
			$this->excel->setActiveSheetIndex(0)->mergeCells('A1:AZ1');
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
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					)
			);
			$style = array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
					)
			);
			$this->excel->getDefaultStyle()->applyFromArray($style);
			$this->excel->getActiveSheet()->getStyle('A1:AZ1')->applyFromArray($estiloTituloReporte);
			$this->excel->setActiveSheetIndex(0)->mergeCells('A1:AZ1');
			//Contador de filas
			$contador = 2;
			$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
			$this->excel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);
			//Le aplicamos negrita a los títulos de la cabecera.
			$this->excel->getActiveSheet()->getStyle("A{$contador}:AZ{$contador}")->getFont()->setBold(true);
			//Le aplicamos color a los titulos.
			$this->excel->getActiveSheet()->getStyle("A{$contador}:AZ{$contador}")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('70AD47');
			//Seteamos los nombres de las columnas
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'CÓDIGO_DE_CUENTA_CONTABLE');
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'NOMBRE_CUENTA_CONTABLE');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'CÓDIGO_DE_AGENCIA');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'NOMBRE_DE_AGENCIA');
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'ENERO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'ENERO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'ENERO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'ENERO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'FEBRERO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'FEBRERO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'FEBRERO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'FEBRERO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'MARZO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'MARZO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("O{$contador}", 'MARZO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("P{$contador}", 'MARZO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("Q{$contador}", 'ABRIL_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("R{$contador}", 'ABRIL_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("S{$contador}", 'ABRIL_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("T{$contador}", 'ABRIL_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("U{$contador}", 'MAYO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("V{$contador}", 'MAYO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("W{$contador}", 'MAYO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("X{$contador}", 'MAYO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("Y{$contador}", 'JUNIO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("Z{$contador}", 'JUNIO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AA{$contador}", 'JUNIO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AB{$contador}", 'JUNIO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("AC{$contador}", 'JULIO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("AD{$contador}", 'JULIO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AE{$contador}", 'JULIO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AF{$contador}", 'JULIO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("AG{$contador}", 'AGOSTO_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("AH{$contador}", 'AGOSTO_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AI{$contador}", 'AGOSTO_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AJ{$contador}", 'AGOSTO_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("AK{$contador}", 'SEPTIEMBRE_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("AL{$contador}", 'SEPTIEMBRE_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AM{$contador}", 'SEPTIEMBRE_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AN{$contador}", 'SEPTIEMBRE_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("AO{$contador}", 'OCTUBRE_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("AP{$contador}", 'OCTUBRE_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AQ{$contador}", 'OCTUBRE_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AR{$contador}", 'OCTUBRE_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("AS{$contador}", 'NOVIEMBRE_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("AT{$contador}", 'NOVIEMBRE_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AU{$contador}", 'NOVIEMBRE_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AV{$contador}", 'NOVIEMBRE_CUMPLIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("AW{$contador}", 'DICIEMBRE_PRESUPUESTO');
			$this->excel->getActiveSheet()->setCellValue("AX{$contador}", 'DICIEMBRE_CONTABILIDAD');
			$this->excel->getActiveSheet()->setCellValue("AY{$contador}", 'DICIEMBRE_DIFERENCIA');
			$this->excel->getActiveSheet()->setCellValue("AZ{$contador}", 'DICIEMBRE_CUMPLIMIENTO');
			///////////////////////////////////////////////////Ocultamiento de columnas/////////////////////////////////
			if($mesIni>1){
				$this->excel->getActiveSheet()->getColumnDimension('E')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setVisible(false);
			}
			elseif($mesFin<1){
				$this->excel->getActiveSheet()->getColumnDimension('E')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setVisible(false);
			}
			if($mesIni>2){
				$this->excel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('L')->setVisible(false);
			}
			elseif($mesFin<2){
				$this->excel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('L')->setVisible(false);
			}
			if($mesIni>3){
				$this->excel->getActiveSheet()->getColumnDimension('M')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('N')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('O')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('P')->setVisible(false);
			}elseif($mesFin<3){
				$this->excel->getActiveSheet()->getColumnDimension('M')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('N')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('O')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('P')->setVisible(false);
			}
			if($mesIni>4){
				$this->excel->getActiveSheet()->getColumnDimension('Q')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('R')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('S')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('T')->setVisible(false);
			}
			elseif($mesFin<4){
				$this->excel->getActiveSheet()->getColumnDimension('Q')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('R')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('S')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('T')->setVisible(false);
			}
			if($mesIni>5){
				$this->excel->getActiveSheet()->getColumnDimension('U')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('V')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('W')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('X')->setVisible(false);
			}
			elseif($mesFin<5){
				$this->excel->getActiveSheet()->getColumnDimension('U')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('V')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('W')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('X')->setVisible(false);
			}
			if($mesIni>6){
				$this->excel->getActiveSheet()->getColumnDimension('Y')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('Z')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AA')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AB')->setVisible(false);
			}
			elseif($mesFin<6){
				$this->excel->getActiveSheet()->getColumnDimension('Y')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('Z')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AA')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AB')->setVisible(false);
			}
			if($mesIni>7){
				$this->excel->getActiveSheet()->getColumnDimension('AC')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AD')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AE')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AF')->setVisible(false);
			}
			elseif($mesFin<7){
				$this->excel->getActiveSheet()->getColumnDimension('AC')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AD')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AE')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AF')->setVisible(false);
			}
			if($mesIni>8){
				$this->excel->getActiveSheet()->getColumnDimension('AG')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AH')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AI')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AJ')->setVisible(false);
			}
			elseif($mesFin<8){
				$this->excel->getActiveSheet()->getColumnDimension('AG')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AH')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AI')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AJ')->setVisible(false);
			}
			if($mesIni>9){
				$this->excel->getActiveSheet()->getColumnDimension('AK')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AL')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AM')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AN')->setVisible(false);
			}
			elseif($mesFin<9){
				$this->excel->getActiveSheet()->getColumnDimension('AK')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AL')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AM')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AN')->setVisible(false);
			}
			if($mesIni>10){
				$this->excel->getActiveSheet()->getColumnDimension('AO')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AP')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AQ')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AR')->setVisible(false);
			}
			elseif($mesFin<10){
				$this->excel->getActiveSheet()->getColumnDimension('AO')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AP')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AQ')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AR')->setVisible(false);
			}
			if($mesIni>11){
				$this->excel->getActiveSheet()->getColumnDimension('AS')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AT')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AU')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AV')->setVisible(false);
			}
			elseif($mesFin<11){
				$this->excel->getActiveSheet()->getColumnDimension('AS')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AT')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AU')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AV')->setVisible(false);
			}
			if($mesIni>12){
				$this->excel->getActiveSheet()->getColumnDimension('AW')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AX')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AY')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AZ')->setVisible(false);
			}
			elseif($mesFin<12){
				$this->excel->getActiveSheet()->getColumnDimension('AW')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AX')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AY')->setVisible(false);
				$this->excel->getActiveSheet()->getColumnDimension('AZ')->setVisible(false);
			}
			foreach ($resEjecucion as $d) {
				//Incrementamos una fila más, para ir a la siguiente.
				$contador++;
				//Informacion de las filas de la consulta.
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $d->ccodcta);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $d->nombCcodcta);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $d->ccodofi);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $d->nombCcodofi);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", "$ ".number_format($d->enero, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'01');
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", "$ ".$this->getDiferencia($montoContable,$d->enero));
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $this->getCumplimiento($montoContable,$d->enero)." %");
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", "$ ".number_format($d->febrero, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'02');
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", "$ ".$this->getDiferencia($montoContable,$d->febrero));
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", $this->getCumplimiento($montoContable,$d->febrero)." %");
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", "$ ".number_format($d->marzo, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'03');
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("O{$contador}", "$ ".$this->getDiferencia($montoContable,$d->marzo));
				$this->excel->getActiveSheet()->setCellValue("P{$contador}", $this->getCumplimiento($montoContable,$d->marzo)." %");
				$this->excel->getActiveSheet()->setCellValue("Q{$contador}", "$ ".number_format($d->abril, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'04');
				$this->excel->getActiveSheet()->setCellValue("R{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("S{$contador}", "$ ".$this->getDiferencia($montoContable,$d->abril));
				$this->excel->getActiveSheet()->setCellValue("T{$contador}", $this->getCumplimiento($montoContable,$d->abril)." %");
				$this->excel->getActiveSheet()->setCellValue("U{$contador}", "$ ".number_format($d->mayo, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'05');
				$this->excel->getActiveSheet()->setCellValue("V{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("W{$contador}", "$ ".$this->getDiferencia($montoContable,$d->mayo));
				$this->excel->getActiveSheet()->setCellValue("X{$contador}", $this->getCumplimiento($montoContable,$d->mayo)." %");
				$this->excel->getActiveSheet()->setCellValue("Y{$contador}", "$ ".number_format($d->junio, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'06');
				$this->excel->getActiveSheet()->setCellValue("Z{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AA{$contador}", "$ ".$this->getDiferencia($montoContable,$d->junio));
				$this->excel->getActiveSheet()->setCellValue("AB{$contador}", $this->getCumplimiento($montoContable,$d->junio)." %");
				$this->excel->getActiveSheet()->setCellValue("AC{$contador}", "$ ".number_format($d->julio, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'07');
				$this->excel->getActiveSheet()->setCellValue("AD{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AE{$contador}", "$ ".$this->getDiferencia($montoContable,$d->julio));
				$this->excel->getActiveSheet()->setCellValue("AF{$contador}", $this->getCumplimiento($montoContable,$d->julio)." %");
				$this->excel->getActiveSheet()->setCellValue("AG{$contador}", "$ ".number_format($d->agosto, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'08');
				$this->excel->getActiveSheet()->setCellValue("AH{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AI{$contador}", "$ ".$this->getDiferencia($montoContable,$d->agosto));
				$this->excel->getActiveSheet()->setCellValue("AJ{$contador}", $this->getCumplimiento($montoContable,$d->agosto)." %");
				$this->excel->getActiveSheet()->setCellValue("AK{$contador}", "$ ".number_format($d->septiembre, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'09');
				$this->excel->getActiveSheet()->setCellValue("AL{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AM{$contador}", "$ ".$this->getDiferencia($montoContable,$d->septiembre));
				$this->excel->getActiveSheet()->setCellValue("AN{$contador}", $this->getCumplimiento($montoContable,$d->septiembre)." %");
				$this->excel->getActiveSheet()->setCellValue("AO{$contador}", "$ ".number_format($d->octubre, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'10');
				$this->excel->getActiveSheet()->setCellValue("AP{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AQ{$contador}", "$ ".$this->getDiferencia($montoContable,$d->octubre));
				$this->excel->getActiveSheet()->setCellValue("AR{$contador}", $this->getCumplimiento($montoContable,$d->octubre)." %");
				$this->excel->getActiveSheet()->setCellValue("AS{$contador}", "$ ".number_format($d->noviembre, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'11');
				$this->excel->getActiveSheet()->setCellValue("AT{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AU{$contador}", "$ ".$this->getDiferencia($montoContable,$d->noviembre));
				$this->excel->getActiveSheet()->setCellValue("AV{$contador}", $this->getCumplimiento($montoContable,$d->noviembre)." %");
				$this->excel->getActiveSheet()->setCellValue("AW{$contador}", "$ ".number_format($d->diciembre, 2));
				$montoContable = $this->getMontoContable($fecIni,$fecFin,$d->ccodcta,$d->ccodofi,'12');
				$this->excel->getActiveSheet()->setCellValue("AX{$contador}", "$ ".number_format($montoContable,2));
				$this->excel->getActiveSheet()->setCellValue("AY{$contador}", "$ ".$this->getDiferencia($montoContable,$d->diciembre));
				$this->excel->getActiveSheet()->setCellValue("AZ{$contador}", $this->getCumplimiento($montoContable,$d->diciembre)." %");
			}
			//Le ponemos un nombre al archivo que se va a generar.
			$archivo = "EjecucionPresupuestaria.xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $archivo . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$dataBitacora = array(
					"idAccion" => 15,
					"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó reporte Ejecución Presupuestaria Del: ".$fecIni." Al: ".$fecFin." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
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

	public function getMontoContable($fecIni,$fecFin,$ccodcta,$ccodofi,$mes){
		if(date("m",strtotime($fecIni))>$mes){
			$montoContable = 0;
		}
		else{
			if(date("m",strtotime($fecFin))<$mes){
				$montoContable = 0;
			}
			else{
				$resMonto = $this->EjecucionPresupuestaria_Model->getMontoContable($mes,date("Y",strtotime($fecFin)),$ccodcta,$ccodofi);
				$ndebe = floatval($resMonto[0]->ndebe);
				$nhaber = floatval($resMonto[0]->nhaber);
				if(substr($ccodcta,0,1)=='4'){
					$montoContable = (floatval($nhaber) - floatval($ndebe));
				}
				else{
					$montoContable = (floatval($ndebe) - floatval($nhaber));
				}
			}
		}
		return $montoContable;
	}

	public function getDiferencia($montoContable,$montoPresupuesto){
		$montoDiferencia = (floatval($montoContable) - floatval($montoPresupuesto));
		return number_format($montoDiferencia, 2);
	}

	public function getCumplimiento($montoContable,$montoPresupuesto){
		if($montoContable == 0 OR $montoPresupuesto == 0){
			$montoCumplimiento = 0;
		}
		else{
			$montoCumplimiento = ((floatval($montoContable) / floatval($montoPresupuesto))*100);
		}
		return number_format($montoCumplimiento,2);
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'26');
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

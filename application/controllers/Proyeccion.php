<?php


class Proyeccion extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Proyeccion_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 17,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Poryeccion Semanal.",
			"usuario" => $_SESSION['usuario'],
			"dirIp"=>$_SERVER['REMOTE_ADDR'],
			"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		//$this->Bitacora_Model->insertAccion($dataBitacora);
		$permiso["padres"]=$this->GestionPermiso_Model->getPadres($_SESSION['usuario']);
		$permiso["hijos"]=$this->GestionPermiso_Model->getHijos($_SESSION['usuario']);
		$this->load->view("layout/head");
		$this->load->view("layout/sidebar", $permiso);
		$this->load->view("layout/navbar");
		$this->load->view("Proyeccion/Proyeccion");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Proyeccion/end_Proyeccion");
	}

	public function getAgencia(){
		$Agencia = $this->Proyeccion_Model->getAgencia();
		echo '<option value="null">Seleccione...</option>';
		foreach ($Agencia as $fila) {
			?>
			<option value="<?php echo rtrim($fila->ccodofi) ?>"><?php echo $fila->cnomofi ?></option>
			<?php
		}
	}

	public function findProyeccion(){
		if($this->input->post("Agencia")=='null'){
			//$this->getConsolidado();
		}
		else{
			if (!empty($this->input->post("Agencia"))){
				$lunes = $this->Proyeccion_Model->getProxLunes();
				$domingo = $this->Proyeccion_Model->getProxDomingo();
				$result = $this->Proyeccion_Model->getProyeccion($this->input->post("Agencia"),$lunes[0]->Lunes,$domingo[0]->Domingo);
				if(!empty($result)){
					$totalDesembolso = 0;
					$totalRecuperacion = 0;
					$totalSolicitudEfectivo = 0;
					$totalDesembolsoC = 0;
	?>
				<div class="table-responsive">
					<div>
						</form>
					</div>
					<table class="table" id="proyeccionAgencia">
						<thead class="thead-light">
							<tr>
								<th scope="col">Efectivo</th>
								<th scope="col">Lunes</th>
								<th scope="col">Martes</th>
								<th scope="col">Miercoles</th>
								<th scope="col">Jueves</th>
								<th scope="col">Viernes</th>
								<th scope="col">Sabado</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Saldo Anterior</td>
							<?php foreach ($result as $datos){?>
								<td>$&nbsp;<?php echo number_format($datos->SaldoAnterior,2); ?></td>
							<?php } ?>
								<td></td>
							</tr>
							<tr>
								<td>Desembolso</td>
							<?php foreach ($result as $datos){ $totalDesembolso = $totalDesembolso + $datos->Desembolso?>
								<td>$&nbsp;<?php echo number_format($datos->Desembolso,2); ?></td>
							<?php } ?>
								<td>$&nbsp;<?php echo number_format($totalDesembolso,2); ?></td>
							</tr>
							<tr>
								<td>Recuperación</td>
								<?php foreach ($result as $datos){ $totalRecuperacion = $totalRecuperacion + $datos->Recuperacion ?>
								<td>$&nbsp;<?php echo number_format($datos->Recuperacion,2); ?></td>
								<?php } ?>
								<td>$&nbsp;<?php echo number_format($totalRecuperacion,2); ?></td>
							</tr>
							<tr>
								<td>Subtotal</td>
								<?php foreach ($result as $datos){?>
								<td>$&nbsp;<?php echo number_format($datos->Subtotal,2); ?></td>
								<?php } ?>
								<td></td>
							</tr>
							<tr>
								<td>Solicitud Efectivo</td>
								<?php foreach ($result as $datos){ $totalSolicitudEfectivo = $totalSolicitudEfectivo + $datos->SolicitudEfectivo?>
								<td>$&nbsp;<?php echo number_format($datos->SolicitudEfectivo,2); ?></td>
								<?php } ?>
								<td>$&nbsp;<?php echo number_format($totalSolicitudEfectivo,2); ?></td>
							</tr>
							<tr>
								<td>Saldo en Boveda</td>
								<?php foreach ($result as $datos){?>
								<td>$&nbsp;<?php echo number_format($datos->SaldoBoveda,2); ?></td>
								<?php } ?>
								<td></td>
							</tr>
							<tr>
								<td>Desembolso en Cheque</td>
								<?php foreach ($result as $datos){ $totalDesembolsoC = $totalDesembolsoC + $datos->DesembolsoCheque?>
								<td>$&nbsp;<?php echo number_format($datos->DesembolsoCheque,2); ?></td>
								<?php } ?>
								<td>$&nbsp;<?php echo number_format($totalDesembolsoC,2); ?></td>
							</tr>
							<tr>
								<td>Colocación Total</td>
								<?php foreach ($result as $datos){ ?>
								<td>$&nbsp;<?php echo number_format(($datos->Desembolso+$datos->DesembolsoCheque),2); ?></td>
								<?php } ?>
								<td>$&nbsp;<?php echo number_format(($totalDesembolso+$totalDesembolsoC),2); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
	<?php
				}
			}
		}
	}

	public function getConsolidado(){
		$lunes = $this->Proyeccion_Model->getProxLunes();
		$domingo = $this->Proyeccion_Model->getProxDomingo();
		$resConsolidado = $this->Proyeccion_Model->getConsolidado($lunes[0]->Lunes,$domingo[0]->Domingo);
		$totalC = 0;
		$totalS = 0;
	?>
		<div class="table-responsive">
			<div>
				</form>
			</div>
			<table class="table" id="proyeccionConsolidado">
			<thead class="thead-light">
				<tr>
					<th scope="col">AGENCIA</th>
					<th scope="col">COLOCACIÓN</th>
					<th scope="col">SOLICITUD</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($resConsolidado as $d){
				$totalC = $totalC + ($d->totalDesembolsoE+$d->totalDesembolsoC);
				$totalS = $totalS + $d->SolicitudE;
			?>
				<tr>
					<td>
						<?php echo $d->Agencia?>
					</td>
					<td>
						$&nbsp;<?php echo number_format(($d->totalDesembolsoE+$d->totalDesembolsoC),2); ?>
					</td>
					<td>
						$&nbsp;<?php echo number_format($d->SolicitudE,2); ?>
					</td>
				</tr>
			<?php } ?>
				<tr>
					<td>TOTAL</td>
					<td>$&nbsp;<?php echo number_format($totalC) ?></td>
					<td>$&nbsp;<?php echo number_format($totalS) ?></td>
				</tr>
			</tbody>
			</table>
		</div>
	<?php
	}

	public function getProyeccionSemana(){
		$lunes = $this->Proyeccion_Model->getProxLunes();
		$domingo = $this->Proyeccion_Model->getProxDomingo();
		$resSemana = $this->Proyeccion_Model->getProyeccionSemana($lunes[0]->Lunes,$domingo[0]->Domingo);
		$totalDE = 0;
		$totalDC = 0;
		$totalCT = 0;
		$totalFS = 0;
	?>
		<div class="table-responsive">
			<div>
				</form>
			</div>
			<table class="table" id="proyeccionConsolidado">
				<thead class="thead-light">
				<tr>
					<th scope="col"></th>
					<th scope="col">LUNES</th>
					<th scope="col">MARTES</th>
					<th scope="col">MIERCOLES</th>
					<th scope="col">JUEVES</th>
					<th scope="col">VIERNES</th>
					<th scope="col">SABADO</th>
					<th scope="col">TOTAL</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>EFECTIVO</td>
				<?php foreach ($resSemana as $datos){ $totalDE = $totalDE + $datos->DesembolsoE; ?>
					<td>$&nbsp;<?php echo number_format($datos->DesembolsoE,2) ?></td>
				<?php } ?>
					<td>$&nbsp;<?php echo number_format($totalDE,2)?></td>
				</tr>
				<tr>
					<td>BANCOS</td>
				<?php foreach ($resSemana as $datos){ $totalDC = $totalDC + $datos->DesembolsoC; ?>
					<td>$&nbsp;<?php echo number_format($datos->DesembolsoC,2) ?></td>
				<?php } ?>
					<td>$&nbsp;<?php echo number_format($totalDC,2)?></td>
				</tr>
				<tr>
					<td>COLOCACIÓN TOTAL</td>
				<?php foreach ($resSemana as $datos){ $totalCT = $totalCT + ($datos->DesembolsoE+$datos->DesembolsoC); ?>
					<td>$&nbsp;<?php echo number_format(($datos->DesembolsoE+$datos->DesembolsoC),2) ?></td>
				<?php } ?>
					<td>$&nbsp;<?php echo number_format($totalCT,2)?></td>
				</tr>
				<tr>
					<td>FONDOS SOLICITADOS</td>
				<?php foreach ($resSemana as $datos){ $totalFS = $totalFS + $datos->SolicitudE; ?>
					<td>$&nbsp;<?php echo number_format($datos->SolicitudE,2) ?></td>
				<?php } ?>
					<td>$&nbsp;<?php echo number_format($totalFS,2)?></td>
				</tr>
				</tbody>
			</table>
		</div>
	<?php
	}

	public function getParameters(){
		$lunes = $this->Proyeccion_Model->getProxLunes();
		$domingo = $this->Proyeccion_Model->getProxDomingo();
		$result = $this->Proyeccion_Model->getProyecciones($this->input->post("cbxAgencia"),$lunes[0]->Lunes,$domingo[0]->Domingo);
		$totalDesembolso = 0;
		$totalRecuperacion = 0;
		$totalSolicitudEfectivo = 0;
		$totalDesembolsoC = 0;
		if (COUNT($result) > 0){
			//Cargamos la librería de excel.
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setCellValue("A1", 'PROYECCIÓN SEMANAL.');
			$this->excel->getActiveSheet()->setTitle('PROYECCION');
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
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Efectivo');
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Lunes');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Martes');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Miercoles');
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Jueves');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Viernes');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Sabado');
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Total');
			$this->excel->getActiveSheet()->setCellValue("A3", "Saldo Anterior");
			$this->excel->getActiveSheet()->setCellValue("A4", "Desembolso");
			$this->excel->getActiveSheet()->setCellValue("A5", "Recuperación");
			$this->excel->getActiveSheet()->setCellValue("A6", "SubTotal");
			$this->excel->getActiveSheet()->setCellValue("A7", "Solicitud De Efectivo");
			$this->excel->getActiveSheet()->setCellValue("A8", "Saldo En Boveda");
			$this->excel->getActiveSheet()->setCellValue("A9", "Desembolso Cheque");
			$this->excel->getActiveSheet()->setCellValue("A10", "Colocación Total");
			$arrayLetras = array("B","C","D","E","F","G","H");
			//$arrayDatos = objectToArray($result);
			$arrayDatos = json_decode(json_encode($result), true);
			var_dump($arrayDatos);
//			var_dump($result);
			for($i=0;$i<(COUNT($arrayDatos));$i++){
				for ($j=0;$j<COUNT($arrayLetras);$j++){
					printf('<br>'.$arrayLetras[$j].$i.' = '.$arrayDatos[$i]['SaldoAnterior'].'<br>');

					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "");
					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "Saldo Anterior");
					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "Saldo Anterior");
					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "Saldo Anterior");
					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "Saldo Anterior");
					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "Saldo Anterior");
					$this->excel->getActiveSheet()->setCellValue("$arrayLetras[$j]{$i}", "Saldo Anterior");
				}

			}
			die();
			//Le ponemos un nombre al archivo que se va a generar.
			$archivo = "Proyeccion.xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $archivo . '"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$dataBitacora = array(
					"idAccion" => 15,
					"descripcion" => "Usuario ".$_SESSION['usuario']." Descargó reporte de Datos F987 de  desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
					"usuario" => $_SESSION['usuario'],
					"dirIp"=>$_SERVER['REMOTE_ADDR'],
					"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
			);
			//$this->Bitacora_Model->insertAccion($dataBitacora);
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
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'28');
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

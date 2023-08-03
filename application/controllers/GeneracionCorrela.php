<?php


class GeneracionCorrela extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("GeneracionCorrela_Model");
		$this->load->model("ResolucionPapeleria_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$corTempModel = substr($_SESSION["oficina"],1,2).'-'.substr(strstr($_SESSION['Dia'],'/'),1,2).substr(strstr($_SESSION['Dia'],'/'),4,4).'-';
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 24,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Generación de Correlativos.",
			"usuario" => $_SESSION['usuario'],
			"dirIp"=>$_SERVER['REMOTE_ADDR'],
			"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$this->ObtenerPermiso();
		$permiso["padres"]=$this->GestionPermiso_Model->getPadres($_SESSION['usuario']);
		$permiso["hijos"]=$this->GestionPermiso_Model->getHijos($_SESSION['usuario']);
		$this->load->view("layout/head");
		$this->load->view("layout/sidebar", $permiso);
		$this->load->view("layout/navbar");
		$permiso["data"]=$this->GestionPermiso_Model->getPermisos($_SESSION['usuario']);
		$this->load->view("Impresion/GeneracionCorrelativo",$permiso);
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
	}



	public function AsignacionCorrelativo(){
		$dataBitacora = array(
				"idAccion" => 03,
				"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Asignacion de Correlativos.",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$this->ObtenerPermisoAsignar();
		$permiso["padres"]=$this->GestionPermiso_Model->getPadres($_SESSION['usuario']);
		$permiso["hijos"]=$this->GestionPermiso_Model->getHijos($_SESSION['usuario']);
		$this->load->view("layout/head");
		$this->load->view("layout/sidebar", $permiso);
		$this->load->view("layout/navbar");
		$this->load->view("Impresion/AsignacionCorrelativo");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Impresion/end_AsignacionCorrelativo");
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function findFactura(){
		$datos=$this->input->post();
		$Referencia=$datos["Referencia"];
		$data = $this->GeneracionCorrela_Model->getFactura($Referencia);
		if (!empty($data)){
			if(!empty($Referencia)){
				?>
				<div class="table-responsive">
				<table class="table" id="sujetoExcluido">
				<thead class="thead-light">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Cor.Temp.</th>
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
						<td id="DUI<?php echo $datos->id; ?>"><?php echo $datos->corTemp; ?></td>
						<td id="NIT<?php echo $datos->id; ?>"><?php echo $datos->nombre." ".$datos->apellido; ?></td>
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

	public function getCorr(){
		$correlativo = $this->GeneracionCorrela_Model->getResolucion();
		if(!empty($correlativo)){
			if($correlativo[0]->Corr > $correlativo[0]->CorrFin){
				echo "";
			}
			else{
				echo json_encode($correlativo);
			}
		}
		else{
			echo "";
		}
	}

	public function getData(){
		$datos=$this->input->post();
		$resComprobarModelo = $this->GeneracionCorrela_Model->comprobarModelo($datos["resolucion"]);
		if($resComprobarModelo[0]->Modelo > 0){
			$resComprobacion = $this->GeneracionCorrela_Model->comprobarCorrelativo(str_pad($datos["corr"] + 1,4,'0',STR_PAD_LEFT));
			if($resComprobacion[0]->conta > 0){
				$data['estado']=false;
				$data['descripcion']="Correlativo ya ha sido asignado";
				echo json_encode($data);
			}
			else{
				$dataUpdate = array(
						"fecCrea"=>date("d/m/Y H:m:s", strtotime($datos["fechaSujeto"])),
						"detalle"=>$datos["Detalle"],
						"tipo"=>$datos['tipo'],
						"monto"=>$datos['Monto'],
						"isr"=>$datos['Isr'],
						"gasto"=>$datos['Gasto'],
						"corAsig"=>str_pad($datos["corr"],4,'0',STR_PAD_LEFT),
						"serieAsig"=>$datos["serie"],
						"usuAsig"=>$_SESSION['usuario'],
						"fecAsig"=>date("d/m/Y H:m:s"),
						"estado"=>'2'
				);
				$where = "id = '".$datos["idFactura"]."'";
				$CorrelativoActual = str_pad($datos["corr"] + 1,4,'0',STR_PAD_LEFT);
				$Modelo = $datos["resolucion"];
				if($resComprobarModelo[0]->corFin >= $dataUpdate["corAsig"]){
					if($CorrelativoActual >= $resComprobarModelo[0]->corFin){
						$estado = '0';
					}
					else{
						$estado = '1';
					}
					$dataBitacora = array(
							"idAccion" => 15,
							"descripcion" => "Usuario ".$_SESSION['usuario']." Asignó correlativo :".$CorrelativoActual." a Factura: ".$datos["idFactura"],
							"usuario" => $_SESSION['usuario'],
							"dirIp"=>$_SERVER['REMOTE_ADDR'],
							"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
					);
					$this->Bitacora_Model->insertAccion($dataBitacora);
					$updateCorr = $this->GeneracionCorrela_Model->updateCorr($CorrelativoActual,$Modelo,$estado);
					$resUpdate = $this->GeneracionCorrela_Model->updateFactura($dataUpdate,$where);
					echo $resUpdate;
				}
				else{
					$data['estado']=false;
					$data['descripcion']="Correlativo no puede ser mayor al ultimo correlativo por asignar";
					echo json_encode($data);
				}
			}
		}
		else{
			$data['estado']=false;
			$data['descripcion']="No se reconoce serie de Correlativos o Resolución.";
			echo json_encode($data);
		}
	}

	/////////////////////////////RESOLUCION DE PAPELERIA NUEVA//////////////////////////////////////////

	public function ResolucionPapeleria(){
		$dataBitacora = array(
				"idAccion" => 03,
				"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Resolucion de Papeleria.",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		$permiso["padres"]=$this->GestionPermiso_Model->getPadres($_SESSION['usuario']);
		$permiso["hijos"]=$this->GestionPermiso_Model->getHijos($_SESSION['usuario']);
		$res["res"]=$this->ResolucionPapeleria_Model->MostrarPapeleria();
		$this->ObtenerPermisoPapeleria();
		$this->load->view("layout/head");
		$this->load->view("layout/sidebar", $permiso);
		$this->load->view("layout/navbar");
		$this->load->view("Impresion/ResolucionPapeleria",$res);
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Impresion/end_ResolucionPapeleria");
	}

	public function changeStatus(){
		$data = $this->input->post();
		$data["Estado"] = $data["Estado"]=="0" ? "1" : "0";
		$updateStatus = $this->ResolucionPapeleria_Model->updateStatus($data["ID"],$data["Estado"]);
		echo $updateStatus;
	}

	public function getParameters(){
		$data = $this->input->post();
		$data["Estado"] = isset($data["Estado"]) ? "1" : "0";
		$datosResolucion = array(
				"fecEmision"=>date("d/m/Y",strtotime($data["Fecha"])),
				"resolucion"=>$data["Resolucion"],
				"serie"=>$data["Serie"],
				"corIni"=>$data["CorIni"],
				"corFin"=>$data["CorFin"],
				"usuario"=>$_SESSION['usuario'],
				"corActual"=>$data["CorIni"],
				"estado"=>$data["Estado"],
				"fechaServ"=>date("d/m/Y H:m:s"),
		);
		$resInsert = $this->ResolucionPapeleria_Model->insertNuevaResolucion($datosResolucion);
		$dataBitacora = array(
				"idAccion" => 9,
				"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó Nueva Resolucion de Papeleria.",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		echo $resInsert;
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'9');
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
	public function ObtenerPermisoAsignar(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'16');
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
	public function ObtenerPermisoPapeleria(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'17');
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

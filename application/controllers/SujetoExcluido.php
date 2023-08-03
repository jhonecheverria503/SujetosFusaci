<?php


class SujetoExcluido extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("SujetoExcluido_Model");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 03,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Sujeto Excluido.",
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
		$this->load->view("Consultas/SujetoExcluido");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Consultas/end_SujetoExcluido");
	}

	public function findSujeto(){
		$datos=$this->input->post();
		$Referencia=$datos["Referencia"];
		$data = $this->SujetoExcluido_Model->getSujeto($Referencia);
		if (!empty($data)){
			if(!empty($Referencia)){
	?>
		<div class="table-responsive">
			<table class="table" id="sujetoExcluido">
				<thead class="thead-light">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">DUI</th>
					<th scope="col">NIT</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Telefono</th>
					<th style="display: none" scope="col">contacto</th>
					<th style="display: none" scope="col">direccion</th>
					<th style="display: none" scope="col">noCasa</th>
					<th style="display: none" scope="col">aptoLocal</th>
					<th style="display: none" scope="col">otrosDatos</th>
					<th style="display: none" scope="col">colonia</th>
					<th style="display: none" scope="col">correo</th>
					<th style="display: none" scope="col">depto</th>
					<th style="display: none" scope="col">municipio</th>
					<th style="display: none" scope="col">Estado</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($data as $datos){
						?>
						<tr>
							<td id="codigo<?php echo $datos->id; ?>"><?php echo $datos->id; ?></td>
							<td id="DUI<?php echo $datos->id; ?>"><?php echo $datos->dui; ?></td>
							<td id="NIT<?php echo $datos->id; ?>"><?php echo $datos->nit; ?></td>
							<td id="Nombre<?php echo $datos->id; ?>"><?php echo $datos->nombre; ?></td>
							<td id="Apellido<?php echo $datos->id; ?>"><?php echo $datos->apellido; ?></td>
							<td id="Telefono<?php echo $datos->id; ?>"><?php echo $datos->telefono; ?></td>
							<td style="display: none" id="Contacto<?php echo $datos->id; ?>"><?php echo $datos->contacto; ?></td>
							<td style="display: none" id="Direccion<?php echo $datos->id; ?>"><?php echo $datos->direccion; ?></td>
							<td style="display: none" id="NoCasa<?php echo $datos->id; ?>"><?php echo $datos->noCasa; ?></td>
							<td style="display: none" id="AptoLocal<?php echo $datos->id; ?>"><?php echo $datos->aptoLocal; ?></td>
							<td style="display: none" id="otrosDatos<?php echo $datos->id; ?>"><?php echo $datos->otrosDatos; ?></td>
							<td style="display: none" id="Colonia<?php echo $datos->id; ?>"><?php echo $datos->colonia; ?></td>
							<td style="display: none" id="Correo<?php echo $datos->id; ?>"><?php echo $datos->correo; ?></td>
							<td style="display: none" id="Depto<?php echo $datos->id; ?>"><?php echo rtrim($datos->depto); ?></td>
							<td style="display: none" id="Municipio<?php echo $datos->id; ?>"><?php echo rtrim($datos->municipio); ?></td>
							<td style="display: none" id="EstadoSujeto<?php echo $datos->id; ?>"><?php echo $datos->estado; ?></td>
							<td>
								<button class='btn btn-primary edit' type="submit" data-toggle="modal" value="<?php echo $datos->id; ?>" data-target="#ActualizarSujetoModal" id="prueba">
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
				<div class="form-column col-md-9 col-sm-9 col-xs-9 col-lg-9">
				</div>
				<div class="form-column col-md-3 col-sm-3 col-xs-3 col-lg-3">
					<button class='btn btn-primary' type="submit" data-toggle="modal" data-target="#sujetoExcluidoModal" id="prueba">NUEVO SUJETO EXCLUIDO</button>
				</div>
			</div>
	<?php
			}
		}
	}

	public function getSujeto(){
		$rs = $this->SujetoExcluido_Model->getSujet($this->input->post('id'));
		echo json_encode($rs);
	}

	public function getDeptos(){
		$Deptop = $this->SujetoExcluido_Model->getDeptos();
		echo '<option>Seleccione...</option>';
		foreach ($Deptop as $fila) {
	?>
		<option value="<?php echo rtrim($fila->ccodzon) ?>"><?php echo $fila->cdeszon ?></option>
	<?php
		}
	}

	public function getMunicipios(){
		$Deptos = $this->input->post('id_Depto');
		$Municipios = $this->SujetoExcluido_Model->getMunicipios($Deptos);
		echo '<option>Seleccione...</option>';
		foreach ($Municipios as $fila) {
	?>
		<option value="<?php echo rtrim($fila->ccodzon) ?>"><?php echo $fila->cdeszon ?></option>
	<?php
		}
	}

	public function getParameters(){
		$data = $this->input->post();
		$datosSujeto = array(
			"nombre"=>$data["txtNombre"],
			"apellido"=>$data["txtApellido"],
			"dui"=>$data["txtDui"],
			"nit"=>$data["txtNit"],
			"contacto"=>$data["txtContacto"],
			"direccion"=>$data["txtDirecc"],
			"noCasa"=>$data["txtNoCasa"],
			"aptoLocal"=>$data["txtAptoLocal"],
			"otrosDatos"=>$data["txtOtrosDatos"],
			"colonia"=>$data["txtColonia"],
			"correo"=>$data["txtCorreo"],
			"depto"=>$data["cbxDeptos"],
			"municipio"=>$data["cbxMunici"],
			"telefono"=>$data["txtTelefono"],
			"registroHacienda"=>'1',
			"usuCrea"=>$_SESSION['usuario'],
			"fechaCrea"=>date("d/m/Y")
		);
		$resInsert = $this->SujetoExcluido_Model->insertSujeto($datosSujeto);
		$dataBitacora = array(
				"idAccion" => 07,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Ingreso Nuevo Sujeto Excluido con DUI: ".$data["txtDui"]." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		echo $resInsert;
	}

	public function getParameterUpdate(){
		$data = $this->input->post();
		$datosSujeto = array(
				"nombre"=>$data["UNombre"],
				"apellido"=>$data["UApellido"],
				"dui"=>$data["UDui"],
				"nit"=>$data["UNit"],
				"contacto"=>$data["UContacto"],
				"direccion"=>$data["UDirecc"],
				"noCasa"=>$data["UNoCasa"],
				"aptoLocal"=>$data["UAptoLocal"],
				"otrosDatos"=>$data["txtUOtrosDatos"],
				"colonia"=>$data["UColonia"],
				"correo"=>$data["UCorreo"],
				"depto"=>$data["UcbxDeptos"],
				"municipio"=>$data["UcbxMunici"],
				"telefono"=>$data["UTelefono"],
				"estado"=>isset($data['chkEstado']) ? '1' : '0',
				"registroHacienda"=>isset($data['chkHacienda']) ? '1' : '0',
				"usuUpd"=>$_SESSION['usuario'],
				"fechaUpd"=>date("d/m/Y")
		);
		$where = "id = ".$data["idSujeto"];
		$resUpdate = $this->SujetoExcluido_Model->updateSujeto($datosSujeto,$where);
		$dataBitacora = array(
				"idAccion" => 07,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Actualizó Sujeto Excluido con DUI: ".$data["UDui"]." y ID ".$data["idSujeto"]." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		echo $resUpdate;
	}

	public function changeStatus(){
		$data = $this->input->post();
		$data["Estado"] = $data["Estado"]=="true" ? "1" : "0";
		$updateStatus = $this->SujetoExcluido_Model->updateStatus($data["ID"],$data["Estado"]);
		$dataBitacora = array(
				"idAccion" => 07,
				"descripcion" => "Usuario ".$_SESSION['usuario']." Actualizó Estado de Sujeto Excluido a estado: ".$data["Estado"]." y ID ".$data["ID"]." desde la IP ".$_SERVER['REMOTE_ADDR']." y equipo ".gethostbyaddr($_SERVER['REMOTE_ADDR']).".",
				"usuario" => $_SESSION['usuario'],
				"dirIp"=>$_SERVER['REMOTE_ADDR'],
				"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
		);
		$this->Bitacora_Model->insertAccion($dataBitacora);
		echo $updateStatus;
	}

	public function ObtenerPermiso(){
		$permiso=$this->GestionPermiso_Model->getPermiso($_SESSION['usuario'],'8');
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

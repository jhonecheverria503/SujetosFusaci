<?php

class Inactivacion extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Bitacora_Model");
		$this->load->model("GestionPermiso_Model");
		$this->load->model("Inactivacion_Model");
		//$this->ObtenerPermiso();
	}

	public function index(){
		$dataBitacora = array(
			"idAccion" => 03,
			"descripcion" => "Usuario ".$_SESSION['usuario']." ingresó al Modulo de Inactivacion de registros.",
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
		$this->load->view("Contabilidad/Inactivacion");
		$this->load->view("layout/footer");
		$this->load->view("layout/end_footer");
		$this->load->view("Contabilidad/end_Inactivacion");
	}
	public function findPartida(){
		$datos=$this->input->post();
		$Partida=$datos["Partida"];
		$data = $this->Inactivacion_Model->getPartida($Partida);
		if (!empty($data)){
			if(!empty($Partida)){
				?>
				<div class="table-responsive">
				<table class="table" id="tblPartidas">
				<thead class="thead-light">
				<tr>
					<th scope="col">N° Partida</th>
					<th scope="col">Codigo</th>
					<th scope="col">Doc</th>
					<th scope="col">Debe</th>
					<th scope="col">Haber</th>
					<th scope="col">Concepto</th>
					<th scope="col">Estado</th>
					<th scope="col">Oficina</th>
					<th scope="col" style="display: none">Row</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($data as $datos){
					?>
					<tr>
						<td id="codigo<?php echo $datos->cnumcom; ?>"><?php echo $datos->cnumcom; ?></td>
						<td id="DUI<?php echo $datos->cnumcom; ?>"><?php echo $datos->ccodcta; ?></td>
						<td id="NIT<?php echo $datos->cnumcom; ?>"><?php echo $datos->cnumdoc; ?></td>
						<td id="Nombre<?php echo $datos->cnumcom; ?>"><?php echo $datos->ndebe; ?></td>
						<td id="Apellido<?php echo $datos->cnumcom; ?>"><?php echo $datos->nhaber; ?></td>
						<td id="Telefono<?php echo $datos->cnumcom; ?>"><?php echo $datos->cconcepto; ?></td>
						<td id="Telefono<?php echo $datos->cnumcom; ?>"><?php echo $datos->Estado; ?></td>
						<td id="Telefono<?php echo $datos->cnumcom; ?>"><?php echo $datos->cnomofi; ?></td>
						<td id="Telefono<?php echo $datos->cnumcom; ?>" style="display: none"><?php echo $datos->idrow; ?></td>

						<?php
						if ($datos->Estado=="Inactivo"){

						?>
						<td>
							<button class='btn btn-success activar' type="submit" data-toggle="modal" id="<?php echo $datos->idrow;?>" >
								Activar
							</button>
						</td>
						<?php
							}
							elseif ($datos->Estado=="Activo")
							{
							?>
							<td>
								<button class='btn btn-danger inactivar' type="submit" data-toggle="modal" id="<?php echo $datos->idrow;?>" >
									Inactivar
								</button>
							</td>

							<?php
						}
							?>
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

	public function Cambiar(){
		$datos=$this->input->post();
		$Rowid=$datos["Referencia"];
		$opcion=$datos["Opcion"];

		if ($opcion=="desactivar"){
			$res=$this->Inactivacion_Model->CambiarEstado('',$Rowid);
			if ($res==1){
				$dataBitacora = array(
						"idAccion" => 17,
						"descripcion" => "Usuario ".$_SESSION['usuario']." activo un registro de la partida ".$datos["partida"]." con numero de Rowid ".$Rowid,
						"usuario" => $_SESSION['usuario'],
						"dirIp"=>$_SERVER['REMOTE_ADDR'],
						"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
				);
				$this->Bitacora_Model->insertAccion($dataBitacora);
			}
				$data = array();
				$data['estado']=true;
				$data['descripcion']="Registro actualizado";
				echo json_encode($data);
		}
		if ($opcion=="activar"){
			$res=$this->Inactivacion_Model->CambiarEstado('X',$Rowid);

			if ($res=="1"){
				$dataBitacora = array(
						"idAccion" => 18,
						"descripcion" => "Usuario ".$_SESSION['usuario']." inactivo un registro de la partida ".$datos["partida"]." con numero de Rowid ".$Rowid,
						"usuario" => $_SESSION['usuario'],
						"dirIp"=>$_SERVER['REMOTE_ADDR'],
						"nomMaquina"=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
				);
				$this->Bitacora_Model->insertAccion($dataBitacora);
			}

				$data = array();
				$data['estado']=true;
				$data['descripcion']="Registro actualizado";
				echo json_encode($data);
		}




	}
}


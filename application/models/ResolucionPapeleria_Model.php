<?php


class ResolucionPapeleria_Model extends CI_Model{
	private $tableResolucion = "resolucion";

	public function __construct(){
		parent::__construct();
	}

	public function MostrarPapeleria(){
		$this->db->select("r.id,r.fecEmision,r.resolucion,r.corIni,r.corFin,r.usuario,r.corActual,estado,r.fechaServ,(SELECT COUNT(id) FROM factura AS f WHERE f.corAsig = '' OR f.corAsig IS NULL) AS PendientesAsig");
		$this->db->from("resolucion AS r");
		$query=$this->db->get();
		return $query->result();
	}

	public function updateStatus($ID,$estado){
		$sql="UPDATE resolucion SET estado='$estado' WHERE id='$ID'";
		$this->db->query($sql);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Se realizó el cambio de estado correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al cambiar de estado";
			return json_encode($data);
		}
	}

	public function insertNuevaResolucion($data){
		$this->db->insert($this->tableResolucion,$data);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Resolución Ingresada Correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al ingresar los datos";
			return json_encode($data);
		}
	}

}

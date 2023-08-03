<?php


class SujetoExcluido_Model extends CI_Model{
	private $tableSujetoExcluido = "sujetoExcluido";

	public function __construct(){
		parent::__construct();
	}

	public function getSujeto($Referencia){
		$this->db->select("se.id,se.nombre,se.apellido,se.dui,se.nit,se.contacto,se.direccion,se.noCasa,se.aptoLocal,se.colonia,se.correo,se.depto,se.municipio,se.telefono,se.estado,se.otrosDatos");
		$this->db->from("sujetoExcluido as se");
		$this->db->like("se.dui",$Referencia,"BOTH");
		$this->db->or_like("se.nit",$Referencia,"BOTH");
		$this->db->order_by("se.fechaServ","DESC");
		$query=$this->db->get();
		return $query->result();
	}

	public function getDeptos(){
		$this->db->select("tbz.ccodzon,tbz.cdeszon");
		$this->db->from("ASEIRTM.dbo.tabtzon as tbz");
		$this->db->where("tbz.ctipzon = '1'");
		$this->db->order_by("tbz.ccodzon");
		$query=$this->db->get();
		return $query->result();
	}

	public function getSujet($Id){
		$this->db->select("se.id,se.nombre,se.apellido,se.dui,se.nit,se.contacto,se.direccion,se.noCasa,se.aptoLocal,se.colonia,se.correo,se.depto,se.municipio,
							se.telefono,se.estado,se.otrosDatos,se.registroHacienda");
		$this->db->from("sujetoExcluido as se");
		$this->db->where("se.id",$Id);
		$this->db->order_by("se.fechaServ","DESC");
		$query=$this->db->get();
		return $query->result();
	}

	public function getMunicipios($Depto){
		$this->db->select("tbz.ccodzon,tbz.cdeszon");
		$this->db->from("ASEIRTM.dbo.tabtzon as tbz");
		$this->db->where("tbz.ctipzon = '2'");
		$this->db->where("SUBSTRING(tbz.ccodzon,1,2)",$Depto);
		$this->db->order_by("tbz.ccodzon");
		$query=$this->db->get();
		return $query->result();
	}

	public function insertSujeto($data){
		$this->db->insert($this->tableSujetoExcluido,$data);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Sujeto Ingresado Correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al ingresar los datos";
			return json_encode($data);
		}
	}

	public function updateSujeto($data,$where){
		$this->db->update($this->tableSujetoExcluido,$data,$where);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Sujeto Modificado Correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al ingresar los datos";
			return json_encode($data);
		}
	}

	public function updateStatus($ID,$estado){
		$sql="UPDATE sujetoExcluido SET estado='$estado' WHERE id='$ID'";
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
}

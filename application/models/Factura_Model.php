<?php


class Factura_Model extends CI_Model{

	private $tableFactura = "factura";
	public function __construct(){
		parent::__construct();
	}

	public function getSujeto($Referencia){
		$this->db->select("se.id,se.nombre,se.apellido,se.dui,se.nit,se.contacto,se.direccion,se.noCasa,se.aptoLocal,se.otrosDatos,se.colonia,se.correo,
							(SELECT cdeszon FROM ASEIRTM.dbo.tabtzon WHERE ccodzon = se.depto AND ctipzon = '1' ) AS depto, 
							(SELECT cdeszon FROM ASEIRTM.dbo.tabtzon WHERE ccodzon = se.municipio AND ctipzon = '2') AS municipio,se.telefono");
		$this->db->from("sujetoExcluido as se");
		$this->db->like("se.dui",$Referencia,"BOTH");
		$this->db->where("estado = '1'");
		$this->db->or_like("se.nit",$Referencia,"BOTH");
		$this->db->where("estado = '1'");
		$this->db->order_by("se.fechaServ","DESC");
		$query=$this->db->get();
		return $query->result();
	}

	public function getCorrTemp(){
		$sql="SELECT TOP 1 SUBSTRING(f.corTemp,11,4) + 1 AS corTemp
				FROM factura AS f
				WHERE SUBSTRING(f.corTemp,1,2) = '".substr($_SESSION["oficina"],1,2)."' AND SUBSTRING(f.corTemp,4,2) = '".substr(strstr($_SESSION['Dia'],'/'),1,2)."' AND SUBSTRING(f.corTemp,6,4) = '".substr(strstr($_SESSION['Dia'],'/'),4,4)."'
				ORDER BY f.corTemp DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDatosSujeto($Referencia){
		$this->db->select("se.id,se.nombre,se.apellido,se.dui,se.nit,se.contacto,se.direccion,se.Telefono,se.colonia,se.correo");
		$this->db->from("sujetoExcluido as se");
		$this->db->where("se.id",$Referencia);
		$this->db->where("estado = '1'");
		$this->db->order_by("se.fechaServ","DESC");
		$query=$this->db->get();
		return $query->result();
	}

	public function insertNuevaFactura($data){
		$this->db->insert($this->tableFactura,$data);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Factura Ingresada Correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al ingresar los datos";
			return json_encode($data);
		}
	}
}

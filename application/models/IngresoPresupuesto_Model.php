<?php


class IngresoPresupuesto_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getAnios(){
		$this->db->select("DISTINCT(anio)");
		$this->db->from("presupuesto");
		$this->db->where("estado",'1');
		$query = $this->db->get();
		return $query->result();
	}

	public function getCuentas(){
		$this->db->select("c.ccodcta, c.cdescrip");
		$this->db->from("ASEIRTM.dbo.ctbmcta AS c");
		$this->db->where("c.ccodcta LIKE '4%' OR c.ccodcta LIKE '5%'");
		$query=$this->db->get();
		return $query->result();
	}

	public function getOficina(){
		$this->db->select("tof.ccodofi");
		$this->db->from("ASEIRTM.dbo.tabtofi AS tof");
		$this->db->where("tof.ccodofi!='005'");
		$this->db->where("tof.ccodofi!='009'");
		$query=$this->db->get();
		return $query->result();
	}

	public function insertPresupuesto($data) {
		$res = $this->db->insert_batch('presupuesto',$data);
		if($res){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function insertHistoricoPresupuesto($data) {
		$res = $this->db->insert_batch('historicoPresupuesto',$data);
		if($res){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}

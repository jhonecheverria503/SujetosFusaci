<?php


class Presupuesto_Model extends CI_Model{

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

	public function getPresupuesto($anio){
		$this->db->select("p.ccodcta,c.cdescrip AS nombCcodcta,p.ccodofi,t.cnomofi AS nombCcodofi,p.enero,p.febrero,p.marzo,p.abril,p.mayo,p.junio,p.julio,p.agosto,p.septiembre,p.octubre,p.noviembre,p.diciembre");
		$this->db->from("presupuesto AS p");
		$this->db->join("ASEIRTM.dbo.ctbmcta AS c "," p.ccodcta = c.ccodcta");
		$this->db->join("ASEIRTM.dbo.tabtofi AS t "," p.ccodofi = t.ccodofi");
		$this->db->where("p.anio",$anio);
		$this->db->where("p.estado = '1'");
		$query = $this->db->get();
		return $query->result();
	}

	public function getHistoricoPresupuesto($anio){
		$this->db->select("p.ccodcta,c.cdescrip AS nombCcodcta,p.ccodofi,t.cnomofi AS nombCcodofi,p.enero,p.febrero,p.marzo,p.abril,p.mayo,p.junio,p.julio,p.agosto,p.septiembre,p.octubre,p.noviembre,p.diciembre");
		$this->db->from("historicoPresupuesto AS p");
		$this->db->join("ASEIRTM.dbo.ctbmcta AS c "," p.ccodcta = c.ccodcta");
		$this->db->join("ASEIRTM.dbo.tabtofi AS t "," p.ccodofi = t.ccodofi");
		$this->db->where("p.anio",$anio);
		$this->db->where("p.estado = '1'");
		$query = $this->db->get();
		return $query->result();
	}
}

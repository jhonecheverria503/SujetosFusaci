<?php


class CargaPresupuesto_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getCuenta($ccodcta){
		$this->db->select("COUNT(c.ccodcta) as Contador");
		$this->db->from("ASEIRTM.dbo.ctbmcta AS c");
		$this->db->where("c.ccodcta",$ccodcta);
		$query=$this->db->get();
		return $query->result();
	}

	public function getOficina($oficina){
		$this->db->select("COUNT(tof.ccodofi) as Contador");
		$this->db->from("ASEIRTM.dbo.tabtofi AS tof");
		$this->db->where("tof.ccodofi",$oficina);
		$this->db->where("tof.ccodofi!='005'");
		$this->db->where("tof.ccodofi!='009'");
		$query=$this->db->get();
		return $query->result();
	}

	public function getAnio($anio){
		$this->db->select("COUNT(p.anio) as Contador");
		$this->db->from("presupuesto AS p");
		$this->db->where("p.anio",$anio);
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

	public function changeRegs($anio){
		$sql="UPDATE presupuesto SET estado = 'X' WHERE anio = '$anio'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function changeRegsHistorico($anio){
		$sql="UPDATE historicoPresupuesto SET estado = 'X' WHERE anio = '$anio'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}

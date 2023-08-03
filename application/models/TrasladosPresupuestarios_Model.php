<?php


class TrasladosPresupuestarios_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getCuentas(){
		$this->db->select("c.ccodcta, c.cdescrip");
		$this->db->from("ASEIRTM.dbo.ctbmcta AS c");
		$this->db->where("c.ccodcta LIKE '4%' OR c.ccodcta LIKE '5%'");
		$query=$this->db->get();
		return $query->result();
	}

	public function getAgencias(){
		$this->db->select("tof.ccodofi, tof.cnomofi");
		$this->db->from("ASEIRTM.dbo.tabtofi AS tof");
		$this->db->where("tof.cflag!='X'");
		$query=$this->db->get();
		return $query->result();
	}

	public function getAnios(){
		$this->db->select("DISTINCT(anio)");
		$this->db->from("presupuesto");
		$this->db->where("estado",'1');
		$query = $this->db->get();
		return $query->result();
	}

	public function validaCuenta($ccodcta,$oficina){
		$this->db->select("COUNT(p.ccodcta) as Contador");
		$this->db->from("presupuesto AS p");
		$this->db->where("p.ccodcta",$ccodcta);
		$this->db->where("p.ccodofi",$oficina);
		$query=$this->db->get();
		return $query->result();
	}

	public function validaAgencia($oficina){
		$this->db->select("COUNT(p.ccodofi) as Contador");
		$this->db->from("presupuesto AS p");
		$this->db->where("p.ccodofi",$oficina);
		$this->db->where("p.ccodofi!='005'");
		$this->db->where("p.ccodofi!='009'");
		$query=$this->db->get();
		return $query->result();
	}

	public function getCorr(){
		$sql="SELECT TOP 1 SUBSTRING(tp.correlativo,9,5) + 1 AS corr
				FROM trasladoPresupuesto AS tp
				WHERE SUBSTRING(tp.correlativo,1,2) = '".substr(strstr($_SESSION['Dia'],'/'),1,2)."' AND SUBSTRING(tp.correlativo,4,4) = '".substr(strstr($_SESSION['Dia'],'/'),4,4)."'
				ORDER BY tp.correlativo DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function insertTraslados($data) {
		$res = $this->db->insert_batch('trasladoPresupuesto',$data);
		if($res){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function salidaPresupuesto($mesLetra,$anio,$ccodofi,$ccodcta,$monto){
		$sql="UPDATE presupuesto SET $mesLetra = ($mesLetra - $monto) WHERE anio = '$anio' AND ccodcta = '$ccodcta' AND ccodofi = '$ccodofi' AND estado = '1'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function entradaPresupuesto($mesLetra,$anio,$ccodofi,$ccodcta,$monto){
		$sql="UPDATE presupuesto SET $mesLetra = ($mesLetra + $monto) WHERE anio = '$anio' AND ccodcta = '$ccodcta' AND ccodofi = '$ccodofi' AND estado = '1'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}

<?php

class Inactivacion_Model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

	public function getPartida($cnumcom){
		$this->db->limit(50);
		$this->db->select("c.cnumcom , c.ccodcta,c.cnumdoc,c.ndebe,c.nhaber,c.cconcepto,
							CASE WHEN c.cflc='X' THEN 'Inactivo'
							ELSE 'Activo' END AS 'Estado'
							,t.cnomofi,CONVERT(NVARCHAR(MAX), CONVERT(BINARY(8), RowId), 1) AS idrow");
		$this->db->from("ASEIRTM.dbo.cntamov AS c");
		$this->db->join("ASEIRTM.dbo.tabtofi AS t","c.ccodofi=t.ccodofi");
		$this->db->like("c.cnumcom",$cnumcom,"BOTH");
		$query=$this->db->get();
		return $query->result();
	}

	public function CambiarEstado($cflc,$rowid){
		$sql="UPDATE ASEIRTM.dbo.cntamov SET cflc='$cflc' WHERE RowId=$rowid";
		$this->db->query($sql);
		$res=$this->db->affected_rows();

		if ($res){
			return "1";
		}
		else{
			return "0";
		}
	}


}

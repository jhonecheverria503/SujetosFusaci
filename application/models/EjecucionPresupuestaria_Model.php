<?php


class EjecucionPresupuestaria_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getPresupuesto($anio){
		$sql="SELECT p.ccodcta, c.cdescrip AS nombCcodcta, p.ccodofi, t.cnomofi AS nombCcodofi, p.enero, p.febrero, p.marzo, p.abril, p.mayo, p.junio, p.julio, p.agosto, p.septiembre, p.octubre, p.noviembre, p.diciembre
				 FROM presupuesto AS p 
				JOIN ASEIRTM.dbo.ctbmcta AS c ON p.ccodcta = c.ccodcta 
				JOIN ASEIRTM.dbo.tabtofi AS t ON p.ccodofi = t.ccodofi 
				WHERE p.estado = '1' AND p.anio = $anio";
		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getMontoContable($mes,$anio,$ccodcta,$ccodofi){
		$sql="SELECT SUM(c.ndebe) AS ndebe, SUM(c.nhaber) AS nhaber
				 FROM ASEIRTM.dbo.diario AS d, ASEIRTM.dbo.cntamov AS c
				 WHERE c.cnumcom = d.cnumcom AND MONTH(c.dfeccnt) = '$mes' AND YEAR(c.dfeccnt) = '$anio'
				 and c.cflc = ' ' and left(c.ccodcta,'".strlen($ccodcta)."') = '$ccodcta' AND c.ccodofi = '$ccodofi'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

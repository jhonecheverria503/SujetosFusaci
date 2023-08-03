<?php


class Proyeccion_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getAgencia(){
		$this->db->select("tof.ccodofi, tof.cnomofi");
		$this->db->from("ASEIRTM.dbo.tabtofi AS tof");
		$this->db->where("tof.cflag!='X'");
		$query = $this->db->get();
		return $query->result();
	}

	public function getProxLunes(){
		$sql = "SELECT CONVERT (CHAR(50),DATEADD(wk,DATEDIFF(wk,0,GETDATE()+7),0),103) as Lunes";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getProxDomingo(){
		$sql = "SELECT CONVERT (CHAR(50),DATEADD(wk,DATEDIFF(wk,0,GETDATE()+7),6),103) as Domingo";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getProyeccion($Agencia,$lunes,$domingo){
		$sql = "SELECT pt.idProyeccionTotal,pt.Dia,pt.SaldoAnterior,pt.Desembolso,pt.DesembolsoCheque,pt.Recuperacion,pt.Subtotal,pt.SolicitudEfectivo,pt.SaldoBoveda
				FROM ASEIRTM.dbo.proyeccionTotal AS pt
				WHERE pt.FechaProyeccion BETWEEN ('$lunes') AND ('$domingo') AND pt.agencia = '$Agencia'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getConsolidado($lunes,$domingo){
		$sql = "SELECT tbo.cnomofi AS Agencia,SUM(pt.Desembolso) AS totalDesembolsoE, SUM(pt.DesembolsoCheque) AS totalDesembolsoC, SUM(pt.SolicitudEfectivo) AS SolicitudE
				FROM ASEIRTM.dbo.proyeccionTotal AS pt
				JOIN ASEIRTM.dbo.tabtofi AS tbo ON pt.agencia = tbo.ccodofi
				WHERE pt.FechaProyeccion BETWEEN ('$lunes') AND ('$domingo')
				GROUP BY tbo.cnomofi";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getProyeccionSemana($lunes,$domingo){
		$sql = "SELECT SUM(pt.Desembolso) AS DesembolsoE, SUM(pt.DesembolsoCheque) AS DesembolsoC, SUM(pt.SolicitudEfectivo) AS SolicitudE
				FROM ASEIRTM.dbo.ProyeccionTotal AS pt
				WHERE pt.FechaProyeccion BETWEEN ('$lunes') AND ('$domingo')
				GROUP BY pt.FechaProyeccion
				ORDER BY pt.FechaProyeccion";
		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getProyecciones($Agencia,$lunes,$domingo){
		$sql = "SELECT pt.SaldoAnterior,pt.Desembolso,pt.Recuperacion,pt.Subtotal,pt.SolicitudEfectivo,pt.SaldoBoveda,pt.DesembolsoCheque
				FROM ASEIRTM.dbo.proyeccionTotal AS pt
				WHERE pt.FechaProyeccion BETWEEN ('$lunes') AND ('$domingo') AND pt.agencia = '$Agencia'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

<?php


class BusquedaTraslado_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function findTraslado($datos){
		$sql="SELECT tp.correlativo, tp.descripcion,
					(SELECT SUM(tp1.monto) FROM trasladoPresupuesto AS tp1 WHERE tp1.correlativo = tp.correlativo AND tp1.tipo = 'Salida') AS Total_Salida,
					(SELECT SUM(tp1.monto) FROM trasladoPresupuesto AS tp1 WHERE tp1.correlativo = tp.correlativo AND tp1.tipo = 'Entrada') AS Total_Entrada
				FROM trasladoPresupuesto AS tp
				WHERE tp.correlativo LIKE '%$datos%' OR tp.descripcion LIKE '%$datos%'
				GROUP BY tp.correlativo,tp.descripcion";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getTraslado($post){
		$sql="SELECT tp.correlativo, tp.descripcion,tp.fechaProceso,tp.anio,tp.mes
				FROM trasladoPresupuesto AS tp
				WHERE tp.correlativo = '$post'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getSalidas($post){
		$sql="SELECT tp.ccodcta,ct.cdescrip AS Nombre_Cuenta,tp.ccodofi,tbo.cnomofi AS Agencia,tp.monto 
				FROM trasladoPresupuesto AS tp
				JOIN ASEIRTM.dbo.tabtofi AS tbo ON tp.ccodofi = tbo.ccodofi 
				JOIN ASEIRTM.dbo.ctbmcta AS ct ON tp.ccodcta = ct.ccodcta  
				WHERE tp.correlativo = '$post' AND tipo = 'Salida'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getEntradas($post){
		$sql="SELECT tp.ccodcta,ct.cdescrip AS Nombre_Cuenta,tp.ccodofi,tbo.cnomofi AS Agencia,tp.monto 
				FROM trasladoPresupuesto AS tp
				JOIN ASEIRTM.dbo.tabtofi AS tbo ON tp.ccodofi = tbo.ccodofi 
				JOIN ASEIRTM.dbo.ctbmcta AS ct ON tp.ccodcta = ct.ccodcta  
				WHERE tp.correlativo = '$post' AND tipo = 'Entrada'";
		$query = $this->db->query($sql);
		return $query->result();
	}

}

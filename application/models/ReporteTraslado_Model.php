<?php


class ReporteTraslado_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getTraslados($fecIni,$fecFin){
		$sql="SELECT tp.fechaProceso,(tp.mes + ' ' + tp.anio) AS mesAnio,tp.ccodcta,ct.cdescrip AS nombreCuenta,tbo.cnomofi AS nombreAgencia,tp.descripcion,
					montoSalida = CASE 
						WHEN tp.tipo = 'Entrada' THEN 0
						WHEN tp.tipo = 'Salida' THEN tp.monto
					END,
					montoEntrada = CASE 
						WHEN tp.tipo = 'Entrada' THEN tp.monto
						WHEN tp.tipo = 'Salida' THEN 0
					END
				FROM trasladoPresupuesto AS tp
				JOIN ASEIRTM.dbo.ctbmcta AS ct ON tp.ccodcta = ct.ccodcta
				JOIN ASEIRTM.dbo.tabtofi AS tbo ON tp.ccodofi = tbo.ccodofi
				WHERE tp.fechaProceso BETWEEN ('$fecIni') AND ('$fecFin')
				ORDER BY tp.correlativo";
		$query = $this->db->query($sql);
		return $query->result();
	}

}

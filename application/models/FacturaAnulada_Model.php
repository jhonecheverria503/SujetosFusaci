<?php


class FacturaAnulada_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getFacturas($fecIni,$fecFin){
		$sql="SELECT se.dui,se.nit,se.nombre,se.apellido,f.fecCrea,
				CASE 
					WHEN f.corTemp IS NULL THEN 'Sin Correlativo Asignado'  
					ELSE f.corTemp
				END
				AS 'corrPrel',
				CASE 
					WHEN f.corAsig IS NULL THEN 'Sin Correlativo Asignado'  
					ELSE f.corAsig
				END
				AS 'corrDefi',
				CASE 
					WHEN f.tipo = 1 THEN 'Servicio'
					ELSE 'Bien'
				END
				AS Tipo,
				CASE 
					WHEN f.estado = '1' THEN 'Sin Correlativo Asignado'
					WHEN f.estado = '2' THEN 'Correlativo Definitivo Asignado'
					WHEN f.estado = '3' THEN 'Correlativo Anulado'  
				END
				AS Estados,f.corAnul,f.motivoAnul,f.usuAnul
				FROM factura AS f
				JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.fecCrea BETWEEN ('$fecIni 00:00:00') AND ('$fecFin 23:59:59') AND f.estado = '3'
				ORDER BY f.fecCrea,se.dui";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

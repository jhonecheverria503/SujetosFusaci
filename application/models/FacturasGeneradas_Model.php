<?php


class FacturasGeneradas_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getFacturas($fecIni,$fecFin){
		$sql="SELECT se.dui,se.nit,se.nombre,se.apellido,f.fecCrea,f.corTemp,
				CASE 
					WHEN f.corAsig IS NULL THEN 'Sin Correlativo Asignado'  
					ELSE f.corAsig
				END
				AS corAsig,
				CASE 
					WHEN f.tipo = 1 THEN 'Servicio'
					ELSE 'Bien'
				END
				AS Tipo,
				f.detalle,f.gasto,f.isr,f.monto,se.direccion,se.contacto,se.noCasa,se.aptoLocal,se.colonia,se.correo,
				(SELECT cdeszon FROM ASEIRTM.dbo.tabtzon WHERE ccodzon = se.depto AND ctipzon = '1' ) AS depto, 
				(SELECT cdeszon FROM ASEIRTM.dbo.tabtzon WHERE ccodzon = se.municipio AND ctipzon = '2') AS municipio,
				se.telefono,
				CASE 
					WHEN f.estado = '1' THEN 'Sin Correlativo Asignado'
					WHEN f.estado = '2' THEN 'Correlativo Definitivo Asignado'
					WHEN f.estado = '3' THEN 'Correlativo Anulado'  
				END
				AS Estados, se.usuCrea
				FROM factura AS f
				JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.fecCrea BETWEEN ('$fecIni 00:00:00') AND ('$fecFin 23:59:59')
				ORDER BY f.fecCrea,se.dui";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

<?php


class DatosF987_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getF987($fecIni,$fecFin){
		$sql="SELECT se.dui,se.nit,se.nombre,se.apellido,f.fecCrea,f.corTemp,
				CASE 
					WHEN f.corAsig IS NULL THEN 'Sin Correlativo Asignado'  
					ELSE f.corAsig
				END
				AS corAsig,
				CASE 
					WHEN f.tipo = 2 THEN 'Servicio'
					ELSE 'Bien'
				END
				AS Tipo,
				f.detalle,f.gasto,f.isr,f.monto,se.direccion,se.contacto,se.noCasa,se.aptoLocal,se.otrosDatos,se.colonia,se.correo,
				(SELECT cdeszon FROM ASEIRTM.dbo.tabtzon WHERE ccodzon = se.depto AND ctipzon = '1' ) AS depto, 
				(SELECT cdeszon FROM ASEIRTM.dbo.tabtzon WHERE ccodzon = se.municipio AND ctipzon = '2') AS municipio,
				se.telefono, se.usuCrea
				FROM factura AS f
				JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.fecCrea BETWEEN ('$fecIni 00:00:00') AND ('$fecFin 23:59:59') AND f.estado != '3'
				ORDER BY f.fecCrea,se.dui";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

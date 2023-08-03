<?php


class ImpresionFactura_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getFacturas($Referencia){
		$sql="SELECT f.id,f.idSujeto,se.nombre,se.apellido,se.direccion,se.nit,se.dui,se.telefono,f.usuario,f.fecCrea,f.tipo,f.corTemp,f.corAsig,f.detalle,f.monto,f.isr,f.gasto,f.estado
				FROM factura AS f 
				INNER JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.corAsig LIKE '%$Referencia%'
				AND f.estado = 2";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDatosFactura($Referencia){
		$sql="SELECT f.id,f.idSujeto,se.nombre,se.apellido,se.direccion,se.aptoLocal,se.noCasa,se.colonia,se.nit,se.dui,se.telefono,f.usuario,f.fecCrea,f.tipo,f.corTemp,f.corAsig,f.detalle,f.monto,f.isr,f.gasto,f.estado
				FROM factura AS f 
				INNER JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.id = '$Referencia'";
		$query = $this->db->query($sql);
		return $query->result();
	}

}

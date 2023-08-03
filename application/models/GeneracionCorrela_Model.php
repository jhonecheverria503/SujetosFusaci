<?php


class GeneracionCorrela_Model extends CI_Model{

	private $tableFactura = "factura";
	public function __construct(){
		parent::__construct();
	}

	public function getFactura($Referencia){
		$sql="SELECT f.id,f.idSujeto,se.nombre,se.apellido,se.direccion,se.nit,se.dui,se.telefono,f.usuario,f.fecCrea,f.tipo,f.corTemp,f.detalle,f.monto,f.isr,f.gasto,f.estado
				FROM factura AS f 
				INNER JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.corTemp LIKE '%$Referencia%'
				AND f.estado = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getResolucion(){
		$sql="SELECT r.resolucion AS Resolucion, r.serie AS Serie, r.corActual AS Corr, r.corIni AS CorrIni, r.corFin AS CorrFin FROM resolucion AS r WHERE r.estado = '1' ORDER BY r.fecEmision DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getCorActual($Modelo){
		$sql="SELECT TOP 1 (SUBSTRING(f.corAsig,19,4)+1) As CorrActual FROM factura AS f WHERE SUBSTRING(f.corAsig,0,19) = '$Modelo' ORDER BY f.corAsig DESC ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function comprobarModelo($Modelo){
		$sql="SELECT COUNT(r.resolucion) AS Modelo, r.corFin FROM resolucion AS r WHERE r.estado = '1' AND r.resolucion = '$Modelo' GROUP BY r.corFin";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function comprobarCorrelativo($correlativo){
		$sql="SELECT COUNT(corAsig) as conta FROM factura AS f WHERE f.corAsig = '$correlativo'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function updateFactura($data,$where){
		$this->db->update($this->tableFactura,$data,$where);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Correlativo Asignado Correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al asignar correlativo";
			return json_encode($data);
		}
	}

	public function updateCorr($CorrelativoActual,$Modelo,$estado){
		$sql="UPDATE resolucion SET corActual='$CorrelativoActual', estado='$estado' WHERE resolucion = '$Modelo'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}

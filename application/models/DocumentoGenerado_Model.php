<?php


class DocumentoGenerado_Model extends CI_Model{

	private $tableFactura = "factura";
	public function __construct(){
		parent::__construct();
	}

	public function getFactura($Referencia,$Fecha){
		$_SESSION['idGrupo']='7';
		$sql="SELECT f.id,f.idSujeto,se.nombre,se.apellido,se.direccion,se.nit,se.dui,se.telefono,f.usuario,f.fecCrea,f.tipo,f.corTemp,f.detalle,f.monto,f.isr,f.gasto,f.estado,f.corAsig,f.corAnul
				FROM factura AS f 
				INNER JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE se.nit LIKE '%$Referencia%' AND f.fecCrea BETWEEN ('$Fecha 00:00:00') AND ('$Fecha 23:59:59')";
		if($_SESSION['oficina']!='004'){
			$sql.=" AND SUBSTRING(f.corTemp,1,2) = '".substr($_SESSION['oficina'],1,2)."'";
		}
		if($_SESSION['idGrupo']!='7' AND $_SESSION['idGrupo']!='6' AND $_SESSION['idGrupo']!='4'){
			$sql.=" AND f.usuario = '".$_SESSION['usuario']."'";
		}
		$sql.=" OR se.dui LIKE '%$Referencia%' AND  f.fecCrea BETWEEN ('$Fecha 00:00:00') AND ('$Fecha 23:59:59')";
		if($_SESSION['oficina']!='004'){
			$sql.=" AND SUBSTRING(f.corTemp,1,2) = '".substr($_SESSION['oficina'],1,2)."'";
		}
		if($_SESSION['idGrupo']!='7' AND $_SESSION['idGrupo']!='6' AND $_SESSION['idGrupo']!='4'){
			$sql.=" AND f.usuario = '".$_SESSION['usuario']."'";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDetalleFactura($idFactura){
		$sql="SELECT f.id,f.idSujeto,se.nombre,se.apellido,se.direccion,se.nit,se.dui,se.telefono,f.usuario,f.fecCrea,f.tipo,f.corTemp,f.detalle,f.monto,f.isr,f.gasto,f.estado
				FROM factura AS f 
				INNER JOIN sujetoExcluido AS se ON se.id = f.idSujeto
				WHERE f.id = '$idFactura'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDatosSujeto($Referencia){
		$this->db->select("se.id,se.nombre,se.apellido,se.dui,se.nit,se.contacto,se.direccion,se.Telefono,se.colonia,se.correo");
		$this->db->from("sujetoExcluido as se");
		$this->db->where("se.id",$Referencia);
		$this->db->order_by("se.fechaServ","DESC");
		$query=$this->db->get();
		return $query->result();
	}

	public function comprobarCorrelativo($correlativo){
		$sql="SELECT COUNT(f.corAnul) as conta FROM factura AS f WHERE f.corAnul = '$correlativo'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getCorrAnula(){
		$sql="SELECT TOP 1 SUBSTRING(f.corAnul,21,4) + 1 AS corAnula
				FROM factura AS f
				WHERE SUBSTRING(f.corAnul,1,2) = '".substr($_SESSION["oficina"],1,2)."' AND SUBSTRING(f.corAnul,14,2) = '".substr(strstr($_SESSION['Dia'],'/'),1,2)."' AND SUBSTRING(f.corAnul,16,4) = '".substr(strstr($_SESSION['Dia'],'/'),4,4)."'
				ORDER BY f.corAnul DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function updateFactura($data,$where){
		$this->db->update("factura",$data,$where);
		$res=$this->db->affected_rows();
		$data = array();
		if ($res){
			$data['estado']=true;
			$data['descripcion']="Factura Anulada Correctamente";
			return json_encode($data);
		}
		else{
			$data['estado']=false;
			$data['descripcion']="Error al anular Factura";
			return json_encode($data);
		}
	}

}

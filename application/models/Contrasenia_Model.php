<?php


class Contrasenia_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function ComprobarUser($usuario){
		$this->db->select("COUNT(e.idEmpleado) as Contador, e.idEmpleado, e.correo, e.nombre");
		$this->db->from("ASEISTAR.dbo.empleado AS e");
		$this->db->where("e.Usuario_SIM",$usuario);
		$this->db->where("e.correo IS NOT NULL");
		$this->db->or_where("e.Usuario_SIM",$usuario);
		$this->db->where("e.correo <> ''");
		$this->db->group_by(array("e.idEmpleado"));
		$this->db->group_by(array("e.correo"));
		$this->db->group_by(array("e.nombre"));
		$query=$this->db->get();
		return $query->result();
	}

	public function validaToken($token){
		$this->db->select("u.usuario, u.idUsuario, u.token, u.nombre,e.correo");
		$this->db->from("ASEIRTM.dbo.usuarios as u");
		$this->db->join("ASEISTAR.dbo.empleado AS e","u.usuario = e.Usuario_SIM");
		$this->db->where("u.token",$token);
		$this->db->group_by(array("u.idUsuario"));
		$this->db->group_by(array("u.usuario"));
		$this->db->group_by(array("u.token"));
		$this->db->group_by(array("u.nombre"));
		$this->db->group_by(array("e.correo"));
		$query=$this->db->get();
		return $query->result();
	}

	public function updateUsuario($data,$where){
		$this->db->update('ASEIRTM.dbo.usuarios',$data,$where);
		$res=$this->db->affected_rows();
		if ($res){
			return true;
		}
		else{
			return false;
		}
	}
}

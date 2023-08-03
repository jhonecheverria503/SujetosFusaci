<?php


class Reportes extends CI_Controller{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
//		$this->load->model("Factura_Model");
//		$this->load->model("Bitacora_Model");
//		$this->load->model("GestionPermiso_Model");
	}

	public function index(){
		$this->load->view("Reportes/reciboIndividual");
	}
}

<?php


class Contrasenia extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Contrasenia_Model");
		$this->load->model("Bitacora_Model");
	}

	public function index(){
		$this->load->view("Contrasenia/Recuperacion");
		$this->load->view("Contrasenia/end_Recuperacion");
	}

	public function cambioContrasena(){
		$this->load->view("Contrasenia/Cambio");
		$this->load->view("Contrasenia/end_Cambio");
	}

	public function getUsuario(){
		$array = array();
		$rs = $this->Contrasenia_Model->ComprobarUser($this->input->post('usuario'));
		if($rs[0]->Contador>0){
			$update = array(
				"token"=>$this->generate_string(50)
			);
			$where = array(
				"usuario"=>$this->input->post('usuario'),
			);
			$ru = $this->Contrasenia_Model->updateUsuario($update,$where);
			if($ru){
				$data = array(
					"nombre"=>$rs[0]->nombre,
					"codigo"=>$update['token'],
					"correo"=>$rs[0]->correo
				);
				$rc = $this->CorreoEnvia($data);
				if($rc>0){
					$array['estado']=true;
					$array['descripcion']="Codigo de restauración enviado correctamente";
					echo json_encode($array);
				}
				else{
					$array['estado']=false;
					$array['descripcion']="Error al enviar código de restauración.";
					echo json_encode($array);
				}
			}
			else{
				$array['estado']=false;
				$array['descripcion']="Error al actualizar Token.";
				echo json_encode($array);
			}
		}
		else{
			$array['estado']=false;
			$array['descripcion']="No existe el usuario o es invalido";
			echo json_encode($array);
		}
	}

	private function generate_string($strength = 16) {
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input_length = strlen($permitted_chars);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}

	public function CorreoEnvia($data){
		try {
			if (!empty($data['correo'])) {
				$this->load->library('Phpmailer_lib');
				$mail = $this->phpmailer_lib->load();
				$mail->isSMTP();
				$mail->Host     = 'smtp.gmail.com'; //gmail
				$mail->SMTPAuth = true;
				$mail->Username = 'tecnologia.asei@gmail.com';
				$mail->Password = 'knqhlgmhaanersgq';
				$mail->SMTPSecure = 'ssl';//funciona con gmail
				$mail->Port     = 465;//funciona con gmail
				$mail->setFrom('tecnologia.asei@gmail.com', 'ASEI');
				$mail->addAddress($data['correo']);
				$mail->Subject = 'Reestablecimiento de usuario';
				$mail->isHTML(TRUE);
				$vista=$this->load->view('Correo/CorreoRecuperacion', $data,TRUE);
				$mail->Body = $vista;
				if(!$mail->send()){
				}
				return 1;
			}
		}
		catch (Exception $e) {
			return 0;
		}
	}

	public function validaToken(){
		$rs = $this->Contrasenia_Model->validaToken($this->input->post('Referencia'));
		if(!empty($rs)){
			if($rs[0]->token==$this->input->post('Referencia')){
				echo json_encode($rs[0]);
			}
		}
	}

	public function getPassword(){
		$array = array();
		$data = $this->input->post();
		if($data['txtContraseña']==$data['txtContrasenaValida']){
			$update = array(
				"lactivo"=>1,
				"intentos"=>0,
				"dfecven"=>date('d/m/Y'),
				"token"=>'',
				"password"=>base64_encode(sha1(utf8_encode(strtoupper($data['txtContraseña'])), TRUE))
			);
			$where = array(
				"usuario"=>$data['txtUsuario'],
				"idUsuario"=>$data['txtIdUsuario']
			);
			$ru = $this->Contrasenia_Model->updateUsuario($update,$where);
			if($ru){
				$data = array(
					"nombre"=>$data['txtNombre'],
					"correo"=>$data['txtCorreo']
				);
				$rc = $this->CorreoConfirma($data);
				if($rc>0){
					$array['estado']=true;
					$array['descripcion']="Tu contraseña ha sido restaurada exitosamente";
					echo json_encode($array);
				}
			}
			else{
				$array['estado']=false;
				$array['descripcion']="Error al restaurar contraseña";
				echo json_encode($array);
			}
		}
		else{
			$array['estado']=false;
			$array['descripcion']="Las contraseñas no coinciden";
			echo json_encode($array);
		}
	}

	public function CorreoConfirma($data){
		try {
			if (!empty($data['correo'])) {
				$this->load->library('Phpmailer_lib');
				$mail = $this->phpmailer_lib->load();
				$mail->isSMTP();
				$mail->Host     = 'smtp.gmail.com'; //gmail
				$mail->SMTPAuth = true;
				$mail->Username = 'tecnologia.asei@gmail.com';
				$mail->Password = 'knqhlgmhaanersgq';
				$mail->SMTPSecure = 'ssl';//funciona con gmail
				$mail->Port     = 465;//funciona con gmail
				$mail->setFrom('tecnologia.asei@gmail.com', 'ASEI');
				$mail->addAddress($data['correo']);
				$mail->Subject = 'Reestablecimiento de usuario';
				$mail->isHTML(TRUE);
				$vista=$this->load->view('Correo/CorreoConfirmacion', $data,TRUE);
				$mail->Body = $vista;
				if(!$mail->send()){
				}
				return 1;
			}
		}
		catch (Exception $e) {
			return 0;
		}
	}
}

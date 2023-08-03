<?php
defined('BASEPATH') OR exit('No direct script access allowed');
If(!empty($_SESSION['usuario'])){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>Inicio</title>
		<center>
			<img src="<?php echo base_url(); ?>/resources/img/01.jpg" width="40%" height="40%" />
		</center>
		<p1></p1>
	</head>
	<body>
	</body>
	</html>
	<?php

}
else{
	?>
	<script type="text/javascript">
		window.setTimeout(function(){
			location = ('/ModuloContabilidad/index.php/Login');
		} ,20);
	</script>

	<?php
}

?>




$(document).ready(function(){
	$('#frmUser').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'Contrasenia/getUsuario',
			data: formData,
			async: false,
			cache: false,
			dataType: 'json',
			contentType: false,
			processData: false,
			type:'POST',
			showConfirmButton: false,
			success:function(data){
				if (data.estado==true) {
					Swal.fire({
						icon: 'success',
						title: '¡Bienvenido!',
						text: data.descripcion,
					});
					setTimeout( function(){
						window.location.replace("http://192.168.7.96:8080/SIF/index.php/Contrasenia/cambioContrasena");
					}, 1000 );
				}else{
					Swal.fire({
						icon: 'error',
						title: '¡Error!',
						text: data.descripcion,
					});
				}
			}
		});
	});
});

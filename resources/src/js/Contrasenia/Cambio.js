$(document).ready(function(){
	$("#txtToken").keyup(function(){
		var Referencia = document.getElementById("txtToken").value;
		if(Referencia.length==50){
			$.ajax({
				data: {Referencia:Referencia},
				url:   'validaToken',
				type:  'post',
				beforeSend: function () { },
				success:  function (output) {
					var datos =  JSON.parse(output);
					if(datos.id!=''){
						$("#btnModal").attr("disabled",false);
						$("#txtUsuario").val(datos.usuario);
						$("#txtIdUsuario").val(datos.idUsuario);
						$("#txtNombre").val(datos.nombre);
						$("#txtCorreo").val(datos.correo);
					}
				},
				error:function(){
					if(Referencia.length==50){
						$("#btnModal").attr("disabled",false);
					}
					Swal.fire({
						icon: 'error',
						title: '¡Error!',
						text: 'Error al validar el Token',
					});
				}
			});
		}
		else{
			$("#txtUsuario").val("");
			$("#txtIdUsuario").val("");
			$("#txtNombre").val("");
			$("#txtCorreo").val("");
			$("#btnModal").attr("disabled",true);
		}
	});
	$('#frmCambioContra').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'getPassword',
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
						window.location.replace("http://192.168.7.96:8080/SIF/index.php/");
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

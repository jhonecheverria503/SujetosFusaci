$(document).ready(function(){
	//Función para el buscador
	$("#txtFind").keyup(function(){
		var Referencia = document.getElementById("txtFind").value;
		$.ajax({
			data: {Referencia:Referencia},
			url:   'findSujeto',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {
				$(".result").html(response);
			},
			error:function(){
				alert("error");
			}
		});
	});
	//Traer datos de la tabla para el modal de actualización
	$(document).on('click', '.edit', function(){
		$.post("getDeptos",{
		}, function (UcbxDeptos) {
			$("#UcbxDeptos").html(UcbxDeptos);
		});
		var id=$(this).val();
		$.ajax({
			url: "getSujeto",
			type: "POST",
			data: {id:id},
		})
		.done(function (output) {
			var datos = JSON.parse(output);
			$('#ActualizarSujetoModal').modal('show');
			$('#UDui').val(datos[0].dui);
			$('#idSujeto').val(datos[0].id);
			$('#UNit').val(datos[0].nit);
			$('#UNombre').val(datos[0].nombre);
			$('#UApellido').val(datos[0].apellido);
			$('#UContacto').val(datos[0].contacto);
			$('#UDirecc').val(datos[0].direccion);
			$('#UNoCasa').val(datos[0].noCasa);
			$('#UAptoLocal').val(datos[0].aptoLocal);
			$('#txtUOtrosDatos').val(datos[0].otrosDatos);
			$('#UColonia').val(datos[0].colonia);
			$('#UCorreo').val(datos[0].correo);
			$('#UTelefono').val(datos[0].telefono);
			$.post("getMunicipios",{
				id_Depto: datos[0].depto
			}, function (Depto) {
				$("#UcbxMunici").html(Depto);
				$("#UcbxDeptos option[value='"+ datos[0].depto +"']").attr("selected",true);
				$("#UcbxMunici option[value='"+ datos[0].municipio +"']").attr("selected",true);
			});
			if(datos[0].estado=="1"){
				$("#chkEstado").prop("checked", true);
			}
			else{
				$("#chkEstado").prop("checked", false);
			}
			if(datos[0].registroHacienda=="0" || datos[0].registroHacienda==null){
				$("#chkHacienda").prop("checked", false);
			}
			else{
				$("#chkHacienda").prop("checked", true);
			}
		});
	});
	//Función para traer departamentos
	$.post("getDeptos",{
	}, function (cbxDeptos) {
		$("#cbxDeptos").html(cbxDeptos);
	});
	//Función para traer municipios por departamentos
	$("select.departamento").change(function(){
		var id_Depto = $(this).children("option:selected").val();
		$.post("getMunicipios",{
			id_Depto: id_Depto
		}, function (Depto) {
			$("#cbxMunici").html(Depto);
		});
	});
	//Envio de formularios
	$('#SujetoExcluidoForm').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		var usu = $("#txtUsuarioL").val();
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
		})
		swalWithBootstrapButtons.fire({
			title: 'Usuario : '+ usu,
			text: '¿Verificó con el proveedor que no está inscrito en Ministerio de Hacienda?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Sí, guardar',
			denyButtonText: `No, cancelar`,
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url:'getParameters',
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
							swalWithBootstrapButtons.fire(
								'Exito!',
								data.descripcion,
								'success'
							)
							setTimeout( function(){
								location.reload();
							}, 1000 );
						}else{
							swal.fire({
								title: "Error!",
								text: data.descripcion,
								timer: 1500,
								icon: 'error',
								closeOnConfirm: true,
								closeOnCancel: true
							});
						}
					}
				});
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire(
					'Cancelado',
					'OK',
					'info'
				);
				setTimeout( function(){
					location.reload();
				}, 1000);
			}
		})
	});
	//Actualizar Sujeto
	$('#ActualizaSujetoExcluidoForm').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'getParameterUpdate',
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
					swal.fire({
						title: "Exito!",
						text: data.descripcion,
						icon: 'success',
						timer: 2000,
						closeOnConfirm: true,
						closeOnCancel: true
					});
					setTimeout( function(){
						location.reload();
					}, 1000 );
				}else{
					swal.fire({
						title: "Error!",
						text: data.descripcion,
						timer: 1500,
						icon: 'error',
						closeOnConfirm: true,
						closeOnCancel: true
					});
				}
			}
		});
	});
	$("#EstadoSujeto").change(function() {
		var Estado = $('#EstadoSujeto').is(":checked");
		var ID = document.getElementById("idSujeto").value;
		console.log(Estado);
		$.ajax({
			url: 'changeStatus',
			type: 'post',
			dataType: 'json',
			data: {Estado:Estado,ID:ID},
			success: function(data) {
				if (data.estado==true) {
					swal({
						title: "Exito!",
						text: data.descripcion,
						type: 'success',
						timer: 2000,
						closeOnConfirm: true,
						closeOnCancel: true
					});
					setTimeout( function(){
						location.reload();
					}, 1000 );
				}else{
					swal({
						title: "Error!",
						text: data.descripcion,
						timer: 1500,
						type: 'error',
						closeOnConfirm: true,
						closeOnCancel: true
					});
				}
			}
		});
	});
});
//Función para validar que sean sólo numeros
function validarNumeros(e) {
	var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

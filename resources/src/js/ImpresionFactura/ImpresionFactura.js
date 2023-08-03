$(document).ready(function(){
	//Función para el buscador
	$("#txtFind").keyup(function(){
		var Referencia = document.getElementById("txtFind").value;
		$.ajax({
			data: {Referencia:Referencia},
			url:   'findFactura',
			type:  'post',
			beforeSend: function () { },
			success:  function (response) {
				$(".result").html(response);
			},
			error:function(){
				alert("error")
			}
		});
		// console.log(Fecha);
	})
	//Traer datos de la tabla para el modal de Impresion
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		$('#AnularFacturaFormModal').modal('show');
		$('#idFactura').val($('#codigo'+id).text());
		$('#Dui').val($('#Dui'+id).text());
		$('#Telefono').val($('#Telefono'+id).text());
		$('#Nit').val($('#Nit'+id).text());
		$('#Nombre').val($('#Nombre'+id).text());
		$('#Apellido').val($('#Apellido'+id).text());
		$('#Contacto').val($('#Contacto'+id).text());
		$('#Direcc').val($('#Direccion'+id).text());
		$('#Monto').val($('#Monto'+id).text());
		$('#Gasto').val($('#Gasto'+id).text());
		$('#Isr').val($('#Isr'+id).text());
		$('#Tipo').val($('#Tipo'+id).text());
		$("#Departamento").val($('#Depto'+id).text());
		$("#Municipio").val($('#Municipio'+id).text());
		$('#Detalle').val($('#Detalle'+id).text());
		$('#fechaSujeto').val($('#Fecha'+id).text());
		$('#corr').val($('#corrAsignado'+id).text());
	});
	// //Asignar Correlativo
	// $('#AnularFacturaForm').on('submit',function(e) {
	// 	e.preventDefault();
	// 	var formData = new FormData($(this)[0]);
	// 	$.ajax({
	// 		url:'getData',
	// 		data: formData,
	// 		async: false,
	// 		cache: false,
	// 		dataType: 'json',
	// 		contentType: false,
	// 		processData: false,
	// 		type:'POST',
	// 		showConfirmButton: false,
	// 		success:function(data){
	// 			if (data.estado==true) {
	// 				swal({
	// 					title: "Exito!",
	// 					text: data.descripcion,
	// 					type: 'success',
	// 					timer: 2000,
	// 					closeOnConfirm: true,
	// 					closeOnCancel: true
	// 				});
	// 				setTimeout( function(){
	// 					location.reload();
	// 				}, 1000 );
	// 			}else{
	// 				swal({
	// 					title: "Error!",
	// 					text: data.descripcion,
	// 					timer: 1500,
	// 					type: 'error',
	// 					closeOnConfirm: true,
	// 					closeOnCancel: true
	// 				});
	// 			}
	// 		}
	// 	});
	// });
});
function Aviso() {
	alert("El correlativo que se muestra es el siguiente según el orden.\nTenga en cuenta que si cambia el correlativo puede afectar en el orden de éstos.")
}

//Función para el buscador
$("#txtFind").keyup(function(){
	var Partida = document.getElementById("txtFind").value;

	if (Partida.length>=6){
		$.ajax({
			data: {Partida:Partida},
			url:   'findPartida',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {
				$(".result").html(response);
				$("#tblPartidas").DataTable({
					"ordering": true,
					"filter":false,
					"language": {
						"sProcessing":    "Procesando...",
						"sLengthMenu":    "Mostrar _MENU_ registros",
						"sZeroRecords":   "No se encontraron resultados",
						"sEmptyTable":    "Ningún dato disponible en esta tabla",
						"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
						"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":   "",
						"sSearch":        "Buscar:",
						"sUrl":           "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst":    "Primero",
							"sLast":    "Último",
							"sNext":    "Siguiente",
							"sPrevious": "Anterior"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					}
				});
			},
			error:function(){
				alert("error");
			}
		});
	}

});

$(document).on("click",".activar",  function(){
	var Referencia = $(this).attr('id');
	var opcion='desactivar';
	let obtenerDato = document.getElementsByTagName("td");
	var npatida=obtenerDato[0].innerHTML;
	swal({
			title: "Advertencia",
			text: "¿Estas seguro de inactivar este registro?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonText: "Si",
			confirmButtonColor: "#00A59D",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					async: false,
					dataType: 'json',
					data: {Referencia:Referencia,Opcion:opcion,partida:npatida},
					url: "Cambiar",
					success: function (data)
					{
						if (data.estado==true) {
							swal({
								title: "Exito!",
								text: data.descripcion,
								timer: 15000,
								type: 'success',
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
								timer: 15000,
								type: 'error',
								closeOnConfirm: true,
								closeOnCancel: true
							});
						}
					},
					error: function (xhr, status)
					{
					}
				});
			} else {
			}
		});
});


$(document).on("click",".inactivar",  function(){
	var Referencia = $(this).attr('id');
	var opcion='activar';

	let obtenerDato = document.getElementsByTagName("td");
	var npatida=obtenerDato[0].innerHTML;
	swal({
			title: "Advertencia",
			text: "¿Estas seguro de activar este registro?",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "No",
			confirmButtonText: "Si",
			confirmButtonColor: "#00A59D",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					type: 'POST',
					async: false,
					dataType: 'json',
					data: {Referencia:Referencia,Opcion:opcion,partida:npatida},
					url: "Cambiar",
					success: function (data)
					{
						if (data.estado==true) {
							swal({
								title: "Exito!",
								text: data.descripcion,
								timer: 15000,
								type: 'success',
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
								timer: 15000,
								type: 'error',
								closeOnConfirm: true,
								closeOnCancel: true
							});
						}
					},
					error: function (xhr, status)
					{
					}
				});
			} else {
			}
		});
});

function validarNumeros(e) {
	var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

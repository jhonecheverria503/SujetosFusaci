$(document).ready(function(){
	//Función para el buscador
	$("#txtFind").keyup(function(){
		var Referencia = document.getElementById("txtFind").value;
		$.ajax({
			data: {Referencia:Referencia},
			url:   'findTraslado',
			type:  'post',
			beforeSend: function () { },
			success:  function (response) {
				$(".result").html(response);
				$("#trasladoPresupuestarios").DataTable({
					"bFilter": false,
					"ordering": true,
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
				alert("Error al buscar traslado")
			}
		});
	})
	//Traer datos de la tabla para el modal de Impresion
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		$('#TrasladoPresupuestarioModal').modal('show');
		$.ajax({
			url: "getTraslado",
			type: "POST",
			data: {id:id},
		})
		.done(function (data){
			var datos =  JSON.parse(data);
			$('#txtFecProceso').val(datos[0].fechaProceso)
			$('#txtMes').val(datos[0].mes)
			$('#txtAnio').val(datos[0].anio)
			$('#txtDescripcion').val(datos[0].descripcion)
			$('#txtCorr').val(datos[0].correlativo)
			$('#totalSalida').val($('#Salida'+id).text());
			$('#totalEntrada').val($('#Entrada'+id).text());
			$.ajax({
				data: {id:id},
				url:   'getSalidas',
				type:  'post',
				beforeSend: function () { },
				success:  function (response) {
					$("#tablaS tbody").html(response);
				}
			});
			$.ajax({
				data: {id:id},
				url:   'getEntradas',
				type:  'post',
				beforeSend: function () { },
				success:  function (response) {
					$("#tablaE tbody").html(response);
				}
			});
		});
	});
});

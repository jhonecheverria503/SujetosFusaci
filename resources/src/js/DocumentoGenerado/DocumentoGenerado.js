$(document).ready(function(){
	$("#txtFind").keyup(function(){
		var Referencia = document.getElementById("txtFind").value;
		var Fecha = document.getElementById("Fecha").value
		if(Fecha==''){
			$('#txtFind').val("");
			alert("Elija una fecha de emisión primero")
		}
		else{
			$.ajax({
				data: {Referencia:Referencia,Fecha:Fecha},
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
		}
	})
	//Traer datos de la tabla para el modal de Impresion
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		$('#FacturaGeneradaModal').modal('show');
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
		if($('#Estado'+id).text() == '3'){
			$("#btnDocumentoGenerado").prop('disabled', true);
		}
	});
	$(document).on('click', '.anular', function(){
		var id=$(this).val();
		$('#AnularFacturaModal').modal('show');
		$('#txtIdFactura').val($('#codigo'+id).text());
		$.ajax({
			url: 'getCorr',
			type: 'post',
			success: function(output) {
				if (output == "") {
				} else {
					$("#txtCorrAnula").val(output);
					$("#txtCorrAnula").prop('readonly', true);
				}
			}
		});
	});
	$('#fmrAnularFactura').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'anularFactura',
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

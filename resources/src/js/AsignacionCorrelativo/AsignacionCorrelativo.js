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
	})
	//Traer datos de la tabla para el modal de Impresion
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		$('#AsignarCorrelativoModal').modal('show');
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
		$('#tipo option[value="' + $('#Tipo'+id).text() + '"]').attr('selected',true)
		$("#Departamento").val($('#Depto'+id).text());
		$("#Municipio").val($('#Municipio'+id).text());
		$('#Detalle').val($('#Detalle'+id).text());
		$('#fechaSujeto').val($('#Fecha'+id).text());
		validaTipo();
		$.ajax({
			url: 'getCorr',
			type: 'post',
			success: function(output) {
				if (output == "") {
					swal({
						title: "Advertencia",
						text: "No posee más correlativos por asignar.\nPor favor ingrese una nueva resolución",
						type: "warning",
						showCancelButton: false,
						confirmButtonText: "OK",
						confirmButtonColor: "#00A59D",
						closeOnConfirm: true
					})
					$("#corr").val("");
					$("#serie").val("");
					$("#resolucion").val("");
					$("#corr").prop('readonly', true);
				} else {
					resultObj = eval (output);
					$("#corr").val(resultObj[0].Corr);
					$("#serie").val(resultObj[0].Serie);
					$("#resolucion").val(resultObj[0].Resolucion);
					$("#corr").prop('readonly', true);
				}
			}
		});
	});
	//Asignar Correlativo
	$('#FacturaSujetoExcluidoForm').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'getData',
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
function Aviso() {
	//alert("El correlativo que se muestra es el siguiente según el orden.\nTenga en cuenta que si cambia el correlativo puede afectar en el orden de éstos.")
}
function validaTipo() {
	var tipo = document.getElementById('tipo').value;
	var montoLiquido = parseFloat(document.getElementById("Monto").value).toFixed(2);
	$("#Monto").val(montoLiquido);
	if(tipo=='1'){
		$("#Isr").val(0.00);
		calculaGasto();
	}
	else if(tipo=='2'){
		calculaISR();
	}
}
function calculaISR() {
	var montoLiquido = parseFloat(document.getElementById("Monto").value);
	var isr = ((parseFloat(montoLiquido)/0.90)*0.10).toFixed(2);
	$("#Isr").val(isr);
	calculaGasto();
}
function calculaGasto() {
	var isr = parseFloat(document.getElementById("Isr").value).toFixed(2);
	var montoLiquido = parseFloat(document.getElementById("Monto").value).toFixed(2);
	var gasto = (parseFloat(isr) + parseFloat(montoLiquido)).toFixed(2);
	$("#Gasto").val(gasto);
}

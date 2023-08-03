$(document).ready(function(){
	//Función para el buscador
	$("#txtFind").keyup(function(){
		var Referencia = document.getElementById("txtFind").value;
		$.ajax({
			data: {Referencia:Referencia},
			url:   'findSujeto',
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
	//Traer datos de la tabla para el modal de actualización
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		$('#ActualizarSujetoModal').modal('show');
		$('#UDui').val($('#DUI'+id).text());
		$('#idSujeto').val($('#codigo'+id).text());
		$('#UNit').val($('#NIT'+id).text());
		$('#UNombre').val($('#Nombre'+id).text());
		$('#UApellido').val($('#Apellido'+id).text());
		$('#UContacto').val($('#Contacto'+id).text());
		$('#UDirecc').val($('#Direccion'+id).text());
		$('#UNoCasa').val($('#NoCasa'+id).text());
		$('#UAptoLocal').val($('#AptoLocal'+id).text());
		$('#UOtrosDatos').val($('#otrosDatos'+id).text());
		$('#UColonia').val($('#Colonia'+id).text());
		$('#UCorreo').val($('#Correo'+id).text());
		$("#UDepartamento").val($('#Depto'+id).text());
		$("#UMunicipio").val($('#Municipio'+id).text());
		$('#UTelefono').val($('#Telefono'+id).text());
		$.ajax({ url: 'getCorrTemp',
			type: 'post',
			success: function(output) {
				$("#corTemp").val(output);
			}
		});
	});
});
//Función para validar que sean sólo numeros
function validarNumeros(e) {
	var key = e.keyCode || e.which,
		tecla = String.fromCharCode(key).toLowerCase(),
		letras = "0123456789",
		especiales = [8, 37, 39, 46],
		tecla_especial = false;
	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}
	if (letras.indexOf(tecla) == -1 && !tecla_especial) {
		return false;
	}
}
function validaTipo() {
	var tipo = document.getElementById('tipo').value;
	var montoLiquido = parseFloat(document.getElementById("montoLiquido").value).toFixed(2);
	$.ajax({ url: 'getCorrTemp',
		type: 'post',
		success: function(output) {
			$("#corTemp").val(output);
			// alert(output);
		}
	});
	$("#montoLiquido").val(montoLiquido);
	if(tipo=='1'){
		$("#isr").val(0.00);
		calculaGasto();
	}
	else if(tipo=='2'){
		calculaISR();
	}
}
function calculaISR() {
	var montoLiquido = parseFloat(document.getElementById("montoLiquido").value);
	var isr = ((parseFloat(montoLiquido)/0.90)*0.10).toFixed(2);
	$("#isr").val(isr);
	calculaGasto();
}
function calculaGasto() {
	var isr = parseFloat(document.getElementById("isr").value).toFixed(2);
	var montoLiquido = parseFloat(document.getElementById("montoLiquido").value).toFixed(2);
	var gasto = (parseFloat(isr) + parseFloat(montoLiquido)).toFixed(2);
	// console.log(montoLiquido);
	$("#gasto").val(gasto);
}

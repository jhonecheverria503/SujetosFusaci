$(document).ready(function(){
	$.post("getAnios",{
	}, function (anios) {
		$("#cbxAnio").html(anios);
	});
	$.ajax({ url: 'getCorr',
		type: 'post',
		success: function(output) {
			$("#txtCorr").val(output);
		}
	});
	$("#tablaS tbody tr:eq(0) .eliminar").hide();
	$("#tablaE tbody tr:eq(0) .eliminar").hide();
	$("#btnAddS").on('click', function(){
		var row = $("#tablaS tbody tr:eq(0)").clone(true).removeClass('.fila-fija');
		row.find('.monto').val('');
		row.appendTo("#tablaS tbody")
		row.find('.eliminar').css({display:""});
		$("#tablaS tbody tr:eq(0) .eliminar").hide();
	});
	$("#btnAddE").on('click', function(){
		var row = $("#tablaE tbody tr:eq(0)").clone(true).removeClass('.fila-fijaE');
		row.find('.monto').val('');
		row.appendTo("#tablaE tbody")
		row.find('.eliminar').css({display:""});
		$("#tablaE tbody tr:eq(0) .eliminar").hide();
	});
	$(".eliminar").on("click",function(){
		$("#tablaS tbody tr:eq(0) .eliminar").hide();
		var parent = $(this).closest("tr").remove();
		calculaTotalSalida();
	});
	$(".eliminar").on("click",function(){
		$("#tablaE tbody tr:eq(0) .eliminar").hide();
		var parent = $(this).closest("tr").remove();
		calculaTotalEntrada();
	});
	$.post("getCuentas",{
	}, function (cbxProveedor) {
		$(".cuenta").html(cbxProveedor);
	});
	$.post("getAgencias",{
	}, function (cbxCategorias) {
		$(".agencia").html(cbxCategorias);
	});
	$('#frmTraslado').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'getTraslado',
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
function validarNumeros(evt,input){
	// Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
	var key = window.Event ? evt.which : evt.keyCode;
	var chark = String.fromCharCode(key);
	var tempValue = input.value+chark;
	if(key >= 48 && key <= 57){
		if(filter(tempValue)=== false){
			return false;
		}else{
			return true;
		}
	}else{
		if(key == 8 || key == 13 || key == 0) {
			return true;
		}else if(key == 46){
			if(filter(tempValue)=== false){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
}
function filter(__val__){
	var preg = /^([0-9]+\.?[0-9]{0,2})$/;
	if(preg.test(__val__) === true){
		return true;
	}else{
		return false;
	}
}
function calculaTotalSalida() {
	var suma = 0;
	$('.montoS').each(function(){
		if($(this).val()==''){
			suma = (parseFloat(suma) + parseFloat(0)).toFixed(2);
		}
		else{
			suma = (parseFloat(suma) + parseFloat($(this).val())).toFixed(2);
		}
	});
	$("#totalSalida").val(suma);
	validaDiff();
}
function calculaTotalEntrada() {
	var suma = 0;
	$('.montoE').each(function(){
		if($(this).val()==''){
			suma = (parseFloat(suma) + parseFloat(0)).toFixed(2);
		}
		else{
			suma = (parseFloat(suma) + parseFloat($(this).val())).toFixed(2);
		}
	});
	$("#totalEntrada").val(suma);
	validaDiff();
}
function validaDiff() {
	var totalSalida = parseFloat($('#totalSalida').val()).toFixed(2);
	var totalEntrada = parseFloat($('#totalEntrada').val()).toFixed(2);
	if( totalSalida == totalEntrada){
		$("#lblMessage").css({'color':'gray'});
		$("#lblMessage").text("No Existen Diferencias");
		$('#btnSubmit').attr("disabled", false);
	}
	else{
		$("#lblMessage").css({'color':'red'});
		$("#lblMessage").text("Existen Diferencias");
		$('#btnSubmit').attr("disabled", true);
	}
}

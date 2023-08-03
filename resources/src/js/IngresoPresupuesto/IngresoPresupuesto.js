$(document).ready(function(){
	$.post("getAnios",{
	}, function (data) {
		$("#cbxAnio").html(data);
		$('#btnSubmit').attr("disabled", true);
	});
	$.post("getCuentas",{
	}, function (data) {
		$("#cbxCuenta").html(data);
		$(".meses").hide();
	});
	$("#cbxAnio").change(function(){
		if($(this).children("option:selected").val()=="null"){
			$('#cbxCuenta option[value="null"]').attr('selected',true)
			$(".cuenta").hide();
			$(".meses").hide();
			$('#btnSubmit').attr("disabled", true);
		}
		else{
			$(".cuenta").show();
			if($("#cbxCuenta").children("option:selected").val()!="null") {
				$(".meses").show();
				$('#btnSubmit').attr("disabled", false);
			}
		}
	});
	$("#cbxCuenta").change(function(){
		if($(this).children("option:selected").val()=="null"){
			$(".meses").hide();
			$('#btnSubmit').attr("disabled", true);
		}
		else{
			$(".meses").show();
			$('#btnSubmit').attr("disabled", false);
		}
	});
	$('#frmPresupuesto').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'getParameter',
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

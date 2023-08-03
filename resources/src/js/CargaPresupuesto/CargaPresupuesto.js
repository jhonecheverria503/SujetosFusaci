$(document).ready(function(){
	$("select.cbxAnio").change(function(){
		var anio = $(this).children("option:selected").val();
		console.log(anio)
		$.post("validaAnio",{
			anio: anio
		}, function (data) {
			if (data==true) {
				swal({
					title: "¿Quiere reemplazar el presupuesto?",
					text: "El año seleccionado ya posee un presupuesto autorizado",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "¡Reemplazar!",
					cancelButtonText: "Cancelar",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						swal("¡OK!",
							"Ingrese un nuevo presupuesto",
							"success");
					} else {
						swal("¡Ok!",
							"Por favor seleccione otro año",
							"error");
						$("#cbxAnio").val("null");
					}
				});
			}
		});
	});
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	$(document).on("click",".btnSubmit",  function(){
		$('file').val("");
	});
	//Envio de formularios
	$('#formPresupuesto').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("formPresupuesto"));
		formData.append("dato", "valor");
		$.ajax({
			url:'getFile',
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
						type: 'error',
						closeOnConfirm: true,
						closeOnCancel: true
					});
				}
			}
		});
	});
});

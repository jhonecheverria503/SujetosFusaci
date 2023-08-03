$(document).ready(function(){
	$(document).on('click', '.changeStatus', function(){
		var ID=$(this).val();
		var Estado = $('#estado'+ID).text();
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
						timer: 1500,
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
						timer: 2500,
						type: 'error',
						closeOnConfirm: true,
						closeOnCancel: true
					});
				}
			}
		});
	});
	//Envio de formularios
	$('#NuevaResolucionForm').on('submit',function(e) {
		e.preventDefault();
		var formData = new FormData($(this)[0]);
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

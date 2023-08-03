$(document).ready(function(){
	$.post("getAgencia",{
	}, function (data) {
		$("#cbxAgencia").html(data);
		$.ajax({
			data: {Agencia:"null"},
			url:   'findProyeccion',
			type:  'post',
			beforeSend: function () { },
			success:  function (response) {
				$(".result").html(response);
			},
			error:function(){
				swal({
					title: "Error!",
					text: "Error al buscar proyeccion de agencia",
					type: 'error',
					timer: 2000,
					closeOnConfirm: true,
					closeOnCancel: true
				});
			}
		});
	});
	$("select.agencia").change(function(){
		if($('#cbxAgencia').children("option:selected").val() == 'null') {
			$.ajax({
				url:   'getConsolidado',
				type:  'post',
				beforeSend: function () { },
				success:  function (data1) {
					$(".result1").html(data1);
					$.ajax({
						url:   'getProyeccionSemana',
						type:  'post',
						beforeSend: function () { },
						success:  function (data2) {
							$(".result2").html(data2);
							$(".result1").show();
							$(".result2").show();
						},
						error:function(){
							swal({
								title: "Error!",
								text: "Error al buscar proyeccion de agencia",
								type: 'error',
								timer: 2000,
								closeOnConfirm: true,
								closeOnCancel: true
							});
						}
					});
				},
				error:function(){
					swal({
						title: "Error!",
						text: "Error al buscar proyeccion de agencia",
						type: 'error',
						timer: 2000,
						closeOnConfirm: true,
						closeOnCancel: true
					});
				}
			});
		}
		$.ajax({
			data: {Agencia:$(this).children("option:selected").val()},
			url:   'findProyeccion',
			type:  'post',
			beforeSend: function () { },
			success:  function (response) {
				$(".result").html(response);
				$(".result1").hide();
				$(".result2").hide();
			},
			error:function(){
				swal({
					title: "Error!",
					text: "Error al buscar proyeccion de agencia",
					type: 'error',
					timer: 2000,
					closeOnConfirm: true,
					closeOnCancel: true
				});
			}
		});
	})
	if($('#cbxAgencia').children("option:selected").val() == 'null') {
		$.ajax({
			url:   'getConsolidado',
			type:  'post',
			beforeSend: function () { },
			success:  function (response) {
				$(".result1").show();
				$(".result1").html(response);
				$.ajax({
					url:   'getProyeccionSemana',
					type:  'post',
					beforeSend: function () { },
					success:  function (response) {
						$(".result2").html(response);
						$(".result2").show();
					},
					error:function(){
						swal({
							title: "Error!",
							text: "Error al buscar proyeccion de agencia",
							type: 'error',
							timer: 2000,
							closeOnConfirm: true,
							closeOnCancel: true
						});
					}
				});
			},
			error:function(){
				swal({
					title: "Error!",
					text: "Error al buscar proyeccion de agencia",
					type: 'error',
					timer: 2000,
					closeOnConfirm: true,
					closeOnCancel: true
				});
			}
		});
	}
});

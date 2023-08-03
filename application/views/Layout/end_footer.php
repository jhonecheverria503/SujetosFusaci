<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url("resources/vendor/jquery/jquery.min.js");?>"></script>
<script src="<?php echo base_url("resources/vendor/bootstrap/js/bootstrap.bundle.min.js");?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url("resources/vendor/jquery-easing/jquery.easing.min.js");?>"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo  base_url("resources/vendor/datatables/jquery.dataTables.js");?>"></script>
<script src="<?php echo  base_url("resources/vendor/datatables/dataTables.bootstrap4.js");?>"></script>


<!-- Custom scripts for all pages-->
<script src="<?php echo base_url("resources/js/sb-admin-2.min.js");?>"></script>
<script src="<?php echo base_url("resources/stacktable/stacktable.js");?>"></script>
<script src="<?php echo  base_url("resources/sweetalert-master/dist/sweetalert.min.js");?>"></script>
<script src="<?php echo  base_url("resources/src/js/Clock/Clock.js");?>"></script>
<script type="text/javascript">
	var t=null;
	function contadorInactividad() {
		t=setTimeout("inactividad()",300000);
	}
	window.onblur=window.onmousemove=function() {
		if(t) clearTimeout(t);
		// contadorInactividad();
	}
	function inactividad() {
		$.ajax({
			url: '<?php echo site_url("Login/logOut")?>',
			type: 'post',
			dataType: 'json'
		});
		swal({
			title: "Tiempo Agotado!",
			text: "Sesión cerrada por inactividad",
			type: 'warning',
			showCancelButton: false,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "¡OK!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm) {
				setTimeout(function () {
					location = ('<?php echo site_url("Login/logOut")?>');
				});
			}
		});
	}
</script>

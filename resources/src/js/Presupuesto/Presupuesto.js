$(document).ready(function(){
	$.post("getAnios",{
	}, function (anios) {
		$("#cbxAnio").html(anios);
	});
});

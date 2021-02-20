function spremiUdaljenosti() {
	var podaci = '';
	$("#poljaVrijednosti :input[type=number]").each(function() {
		podaci += $(this).attr("id") + '=' + $(this).val() + '&';
	});
	podaci = podaci.slice(0, -1);
	//oduzmi zadnji & iz stringa
	$.ajax({
		type : "POST",
		url : "../../../ajax/admin/postavke/udaljenosti/poPrinterima/spremiUdaljenosti.php?id=" + $("#hfPrinterIdZaSpremanjeUdaljenosti").val() + "&q=" + $("#vrstaDokumenta").val(),
		data : podaci,
		success : function(vratioServer) {
			swal({
				title : 'Traženo - učinjeno!',
				text : vratioServer,
				type : 'success',
				timer : 1500,
				showConfirmButton : false
			});
		}
	});
}

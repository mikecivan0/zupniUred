function spremi() {
	$.ajax({
		type : "POST",
		url : "../../ajax/admin/zupe/spremiPromjene.php",
		data : "id=" + $("#hfZupaId").val() + "&nazivZupe=" + $("#nazivZupe").val() + "&biskupija_id=" + $("#hfBiskupijaId").val() + "&mjesto_id=" + $("#hfMjestoId").val() + "&telefon=" + $("#telefon").val() + "&adresaUreda=" + $("#adresaUreda").val() + "&printer_id=" + $("#hfPrinterId").val(),
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
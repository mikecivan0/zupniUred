function spremi() {
	$.ajax({
		type : "POST",
		url : "../../ajax/admin/printeri/spremiPromjene.php",
		data : "id=" + $("#hfPrinterId").val() + "&nazivPrintera=" + $("#nazivPrintera").val(),
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

//kontrola za unos imena printera
$("#nazivPrintera").keyup(function() {
	if ($("#nazivPrintera").val().length < 1) {
		$(".button").attr("disabled", true);
		$("#fornazivPrintera").addClass("error");
		if ($("smallErrorNazivPrintera").length < 1) {
			$("<small id='smallErrorNazivPrintera' class='error'>Obavezno naziv printera</small>").insertAfter("#fornazivPrintera");
		}
	} else {
		makniErrore("#fornazivPrintera", "#smallErrorNazivPrintera");
	}
});

function makniErrore(selektor1, selektor2) {
	$(selektor1).removeClass("error");
	$(selektor2).remove();
	oslobodiButton();
}

function oslobodiButton() {
	if ($("small").length < 1) {
		$(".button").attr("disabled", false);
	}
}

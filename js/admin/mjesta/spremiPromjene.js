function spremi() {
	$.ajax({
		type : "POST",
		url : "../../ajax/admin/mjesta/spremiPromjene.php",
		data : "id=" + $("#hfMjestoId").val() + "&nazivMjesta=" + $("#nazivMjesta").val() + "&pbr=" + $("#pbr").val(),
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

//kontrola za unos imena mjesta
$("#nazivMjesta").keyup(function() {
	if ($("#nazivMjesta").val().length < 1) {
		$(".button").attr("disabled", true);
		$("#fornazivMjesta").addClass("error");
		if ($("smallErrorNazivMjesta").length < 1) {
			$("<small id='smallErrorNazivMjesta' class='error'>Obavezno naziv mjesta</small>").insertAfter("#fornazivMjesta");
		}
	} else {
		makniErrore("#fornazivMjesta", "#smallErrorNazivMjesta");
	}
});

//kontrola za unos poštanskog broja
$("#pbr").keyup(function() {
	if ($("#pbr").val().length != 5 || !$.isNumeric($('#pbr').val())) {
		$(".button").attr("disabled", true);
		$("#forpbr").addClass("error");
		if ($("#smallErrorPbr").length < 1) {
			$("<small id='smallErrorPbr' class='error'>Poštanski broj može sadržavati samo 5 brojeva</small>").insertAfter("#forpbr");
		}
	} else {
		makniErrore("#forpbr", "#smallErrorPbr");
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

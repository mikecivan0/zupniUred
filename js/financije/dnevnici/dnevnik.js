$(function() {
	$(".godina").click(function() {
		$(".mjeseci").slideUp();
		$(this).find("ul").slideToggle();
	});

	$("#stranica").keyup(function() {
		var path = $("#hfPath").val() + $("#stranica").val();
		$("#printIcon").attr('href', path);
	});
});

$(".obrisiTr").click(function(event) {
	event.preventDefault();
	var element = $(this);
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati ovaj unos?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			$.ajax({
				type : "POST",
				url : "../../ajax/financije/dnevnici/brisanjeUnosa.php",
				data : "id=" + element.attr("id"),
				success : function(vratioServer) {
					if (vratioServer == "Unos obrisan") {
						element.parent().parent().remove();
						swal({
							title : 'Traženo - učinjeno!',
							text : vratioServer,
							type : 'success',
							timer : 1500,
							showConfirmButton : false
						});
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
});

$("#modalSubmit").click(function() {
	var poruka = '';
	if ($("#iznos").val().length == 0) {
		poruka = "Upišite iznos";
	}
	if (isValidDate($("#datum").val()) == false) {
		poruka = "Ispravite datum";
	}

	if (poruka.length == 0) {
		$.cookie('datumNoveTransakcije', $("#datum").val());
		$.ajax({
			type : "POST",
			url : "../../ajax/financije/dnevnici/noviUnos.php",
			data : "svrha_id=" + $("#svrha_id").val() + "&iznos=" + $("#iznos").val() + "&datum=" + $("#datum").val() + "&zupa_id=" + $("#hfZupa_id").val() + "&napomena=" + $("#napomena").val(),
			success : function(vratioServer) {
				if (vratioServer == "OK") {
					var datum = $("#datum").val().split("-");
					window.location.replace(window.location.pathname + "?id=" + $("#hfZupa_id").val() + "&godina=" + datum[0] + "&mjesec=" + datum[1]);
				} else {
					swal('Greška!', vratioServer, 'error');
				}
			}
		});
	} else {
		swal('Greška!', poruka, 'error');
	}
});

function isValidDate(dateString) {
	var regEx = /^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/;
	return dateString.match(regEx) != null;
}

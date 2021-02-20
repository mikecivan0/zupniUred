function definirajBrisanje(id) {
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati ovo mjesto sa popisa filijala?',
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
				url : $("#putanjaApp").val() + "ajax/admin/filijale/brisiFilijalu.php",
				data : "id=" + id,
				success : function(vratioServer) {
					if (vratioServer == "OK") {
						$('#' + id).remove();
						swal({
							title : 'Traženo - učinjeno!',
							text : 'Filijala obrisana',
							type : 'success',
							timer : 1500,
							showConfirmButton : false
						});
					}
				}
			});
		}
	});
}

function dodaj() {
	if ($('#hfNovaFilijalaId').val().length > 0 && $('#hfZupaId').val().length > 0) {
		$.ajax({
			type : "POST",
			url : "../../ajax/admin/filijale/dodajNovuFilijalu.php",
			data : "zupa_id=" + $("#hfZupaId").val() + "&mjesto_id=" + $("#hfNovaFilijalaId").val(),
			success : function(vratioServer) {
				//dobijeni su podaci o novoj filijali pa ih dodaj u tablicu
				var filijala = $.parseJSON(vratioServer);
				$("#podaci").append("<tr id='" + filijala.id + "'>" + "<td>" + filijala.nazivMjesta + "</td>" + "<td>" + filijala.pbr + "</td>" + "<td class='center'><a class='obrisi' onclick='definirajBrisanje(" + filijala.id + ");' href='#'><img src='" + $("#putanjaApp").val() + "img/admin/bin.png' alt='bin' /></a></td></tr>");
				$("#filijala").focus();
			}
		});
		$('#hfNovaFilijalaId').val("");
		$('#filijala').val("");
	}
}

$(function() {
	$("#zupa").autocomplete({
		source : '../../ajax/admin/zupe/nadjiZupu.php?ovlasti=da',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfZupaId').val(ui.item.id);
			$('#zupa').val(ui.item.nazivZupe);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.nazivMjesta + "</a>").appendTo(ul);
	};
});

function definirajBrisanje(id) {
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati ovlast nad ovom župom?',
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
				url : $("#putanjaApp").val() + "ajax/admin/users/brisanjeOvlastiNadZupom.php",
				data : "id=" + id,
				success : function(vratioServer) {
					if (vratioServer == "OK") {
						$('#' + id).remove();
						swal({
							title : 'Traženo - učinjeno!',
							text : 'Ovlast nad ovom župom je obrisana',
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

function definirajKalkulacije(id) {
	$("#loader").show();
	$.ajax({
		type : "POST",
		url : $("#putanjaApp").val() + "ajax/admin/users/osnovneKalkulacije.php",
		data : "id=" + id,
		success : function(vratioServer) {
			$("#loader").hide();
			if(vratioServer=="Osnovne kalkulacije su učitane"){
				setTimeout(function() {
					swal({
						title : 'Traženo - učinjeno!',
						text : vratioServer,
						type : 'success',
						timer : 1500,
						showConfirmButton : false
					});
				}, 250);
			}else{
				swal({
					title : 'Obavijest!',
					text : vratioServer,
					type : 'info'
				});
			}
		}
	});

}

function dodaj() {
	if ($('#hfZupaId').val().length > 0 && $('#zupa').val().length > 0) {
		$.ajax({
			type : "POST",
			url : "../../ajax/admin/users/dodajOvlastNadZupom.php",
			data : "zupa_id=" + $("#hfZupaId").val() + "&user_id=" + $("#hfUserId").val(),
			success : function(vratioServer) {
				//dobijeni su podaci o novoj ovlasti pa ih dodaj u tablicu
				var ovlast = $.parseJSON(vratioServer);
				$("#podaci").append("<tr id='" + ovlast.ovlast_id + "'>" + "<td>" + ovlast.nazivZupe + "</td>" + "<td>" + ovlast.nazivMjesta + " " + ovlast.pbr + "</td>" + "<td>" + ovlast.adresaUreda + "</td>" + "<td class='center'><a class='kalkulacije' onclick='definirajKalkulacije(" + ovlast.id + ");' href='#'><img src='" + $("#putanjaApp").val() + "img/admin/dollar.png' alt='bin' /></a></td>" + "<td class='center'><a class='obrisi' onclick='definirajBrisanje(" + ovlast.ovlast_id + ");' href='#'><img src='" + $("#putanjaApp").val() + "img/admin/bin.png' alt='bin' /></a></td></tr>");
				$("#zupa").focus();
			}
		});
		$('#hfZupaId').val("");
		$('#zupa').val("");
	}
}

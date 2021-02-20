$(function() {
	$(".poruka").click(function(event) {
		location.href = window.location.pathname + '?poruka=' + $(this).parent().attr("id");
	});
});

$("#sve").click(function() {
	if ($("#sve").is(':checked')) {
		$("input[type=checkbox]").each(function() {
			$(this).prop("checked", true);
		});
	} else {
		$("input[type=checkbox]").each(function() {
			$(this).prop("checked", false);
		});
	}
});

$("input[type=checkbox]").click(function() {
	if ($("input:checkbox:checked").length > 0) {
		$("#brisiPoruke").show();
	} else {
		$("#brisiPoruke").hide();
	}
});


$("#brisiPoruke").on('click', function() {
	var brojPoruka = $('input:checkbox:checked').length;
	var textSwal = (brojPoruka==1) ? 'Želite li doista obrisati ovu poruku?' : 'Želite li doista obrisati sve označene poruke?'; 
	swal({
		title : 'Potvrda brisanja',
		text : textSwal,
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			var data = [];
			$(":checked").not("#sve").each(function() {
				if($.isNumeric($(this).val())){ //provjera jesu li id-i brojevi, da se ne bi dogodio inection
					data.push({id : $(this).val()});
				}				
			});
			$.ajax({
				type : "POST",
				url : "../ajax/poruke/brisi.php",
				data : "poruke=" + JSON.stringify(data),
				success : function(vratioServer) {
					if (vratioServer == "Poruke obrisane") {						
						window.location.replace("index.php");
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
}); 
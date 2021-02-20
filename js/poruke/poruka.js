//funkcija birsanja poruke kada se ušlo u samu poruku i zatražilo brisanje
$("#brisiPoruku").on('click', function() {
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati ovu poruku?',
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
				url : "../ajax/poruke/brisi.php",
				data : "poruka=" + $("#hfPoruka").val(),
				success : function(vratioServer) {
					if (vratioServer == "Poruka obrisana") {						
						window.location.replace("index.php");
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
}); 

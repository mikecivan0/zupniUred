$(function(){
	$("#deleteP").children().click(function(event){
		event.preventDefault();
		var element = $(this);
		swal({
			title : 'Potvrda brisanja',
			text : 'Želite li doista obrisati ovaj dokument?',
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
					url : "../../ajax/dokumenti/brisi.php",
					data : "id=" + $("#hfDocId").val(),
					success : function(vratioServer) {
						if(vratioServer=='OK'){							
							var prviDioPutanje = window.location.href.split("?")[0];
							window.location = prviDioPutanje + "?poruka=obrisano";
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	});
});
	

$(function() {
	definirajBrisanje();
});

function definirajBrisanje() {
	$(".obrisi").click(function(event) {
		event.preventDefault();
		var element = $(this);
		swal({
			title : 'Potvrda brisanja',
			text : 'Želite li doista obrisati ovu stavku?',
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
					url : "../../../ajax/admin/financije/svrhe/brisanjeSvrhe.php",
					data : "id=" + element.attr("id"),
					success : function(vratioServer) {
						if (vratioServer == "Stavka obrisana") {
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
}
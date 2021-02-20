function spremi() {
	if (!$("#mjesto").val()) {
		swal('Greška!', 'Obavezno upišite mjesto prebivanja', 'error');
	} else {
		$.ajax({
			type : "POST",
			url : "../../ajax/admin/osobe/spremiPromjene.php",
			data : "id=" + $("#osoba_id").val() + "&mjestoPrebivanja=" + $("#mjesto").val() + "&ime=" + $("#ime").val() + "&prezime=" + $("#prezime").val() + "&dPrezime=" + $("#dPrezime").val() + "&oib=" + $("#oib").val() + "&ulica=" + $("#ulica").val() + "&kucniBroj=" + $("#kucniBroj").val() + "&zanimanje=" + $("#zanimanje").val() + "&jmbg=" + $("#jmbg").val() + "&email=" + $("#email").val() + "&spol=" + $("#spol option:selected").val() + "&vjera=" + $("#vjera").val(),
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
}

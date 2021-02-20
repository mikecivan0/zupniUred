$(function() {
	$("#printP").children().click(function() {
		$("#zapisnik").attr('action', '../../printanje/vjencanje/zapisnik.php?vrstaDokumenta=10&stranica=' + $("#hfStranica").val());
		$('#zapisnik').submit();
	});

	$("#previewP").children().click(function() {
		$('#zapisnik').attr('action', '../../printanje/vjencanje/zapisnik.php?preview=true&vrstaDokumenta=10&stranica=' + $("#hfStranica").val());
		$('#zapisnik').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imeIPrezime").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti ime i prezime prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});

	$("a[href*='stranica']").click(function() {
		$("#hfStranica").val($(this).attr('id'));
	});
}); 
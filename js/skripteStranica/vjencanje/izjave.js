$(function() {
	$("#printP").children().click(function() {
		$("#izjave").attr('action', '../../printanje/vjencanje/izjave.php?vrstaDokumenta=7');
		$('#izjave').submit();
	});

	$("#previewP").children().click(function() {
		$('#izjave').attr('action', '../../printanje/vjencanje/izjave.php?preview=true&vrstaDokumenta=7');
		$('#izjave').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imeIPrezime1").val().length == 0 || $("#imeIPrezime2").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti imena i prezimena stranaka prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});
});

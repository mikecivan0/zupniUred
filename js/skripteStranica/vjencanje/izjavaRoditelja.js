$(function() {
	$("#printP").children().click(function() {
		$("#izjavaRoditelja").attr('action', '../../printanje/vjencanje/izjavaRoditelja.php?vrstaDokumenta=11');
		$('#izjavaRoditelja').submit();
	});

	$("#previewP").children().click(function() {
		$('#izjavaRoditelja').attr('action', '../../printanje/vjencanje/izjavaRoditelja.php?preview=true&vrstaDokumenta=11');
		$('#izjavaRoditelja').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#dijete").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti ime i prezime djeteta prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});
});

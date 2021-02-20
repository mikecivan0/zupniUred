$(function() {
	$("#printP").children().click(function() {
		$("#dopustenje").attr('action', '../../printanje/vjencanje/dopustenje.php?vrstaDokumenta=6');
		$('#dopustenje').submit();
	});

	$("#previewP").children().click(function() {
		$('#dopustenje').attr('action', '../../printanje/vjencanje/dopustenje.php?preview=true&vrstaDokumenta=6');
		$('#dopustenje').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#zarucnik").val().length == 0 || $("#zarucnica").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti imena i prezimena zaručnika prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});
});

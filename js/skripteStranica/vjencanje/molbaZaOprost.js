$(function() {
	$("#printP").children().click(function() {
		$("#molbaZaOprost").attr('action', '../../printanje/vjencanje/molbaZaOprost.php?vrstaDokumenta=9');
		$('#molbaZaOprost').submit();
	});

	$("#previewP").children().click(function() {
		$('#molbaZaOprost').attr('action', '../../printanje/vjencanje/molbaZaOprost.php?preview=true&vrstaDokumenta=9');
		$('#molbaZaOprost').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imeIPrezimeKatolik").val().length == 0 || $("#imeIPrezimeNekatolik").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti imena i prezimena zaručnika prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});
});

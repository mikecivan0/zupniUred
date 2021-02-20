$(function() {
	$("#printP").children().click(function() {
		$("#molbaZaMjesovituZenidbu").attr('action', '../../printanje/vjencanje/molbaZaMjesovituZenidbu.php?vrstaDokumenta=8');
		$('#molbaZaMjesovituZenidbu').submit();
	});

	$("#previewP").children().click(function() {
		$('#molbaZaMjesovituZenidbu').attr('action', '../../printanje/vjencanje/molbaZaMjesovituZenidbu.php?preview=true&vrstaDokumenta=8');
		$('#molbaZaMjesovituZenidbu').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imeIPrezimeOn").val().length == 0 || $("#imeIPrezimeOna").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti imena i prezimena zaručnika prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});
});

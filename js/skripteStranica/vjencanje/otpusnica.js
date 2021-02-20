$(function() {
	$("#printP").children().click(function() {
		$("#otpusnica").attr('action', '../../printanje/vjencanje/otpusnica.php?vrstaDokumenta=5&stranica=' + $("#hfStranica").val());
		$('#otpusnica').submit();
	});

	$("#previewP").children().click(function() {
		$('#otpusnica').attr('action', '../../printanje/vjencanje/otpusnica.php?preview=true&vrstaDokumenta=5&stranica=' + $("#hfStranica").val());
		$('#otpusnica').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imePrezimeOn").val().length == 0 || $("#imePrezimeOna").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti imena i prezimena zaručnika prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});

	$("a[href*='stranica']").click(function() {
		$("#hfStranica").val($(this).attr('id'));
	});

	$("input[id^='zupa']").each(function() {
		$(this).autocomplete({
			source : '../../ajax/admin/zupe/nadjiZupu.php',
			minLength : 2,
			autoFocus : true,
			focus : function(event, ui) {
				event.preventDefault();
			},
			select : function(event, ui) {
				$(this).val(ui.item.nazivZupe + ", " + ui.item.adresaUreda + ", " + ui.item.nazivMjesta);
				event.preventDefault();
			}
		}).data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + "</a>").appendTo(ul);
		};
	});

	$("#zeljenaZupaVjencanja").autocomplete({
		source : '../../ajax/admin/zupe/nadjiZupu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$(this).val(ui.item.nazivZupe + ", " + ui.item.nazivMjesta);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + "</a>").appendTo(ul);
	};

});

$(function() {
	$("#printP").children().click(function() {
		$("#navjestaj").attr('action', '../../printanje/vjencanje/navjestaj.php?vrstaDokumenta=12&dio=' + $("#hfDio").val());
		$('#navjestaj').submit();
	});

	$("#previewP").children().click(function() {
		$('#navjestaj').attr('action', '../../printanje/vjencanje/navjestaj.php?preview=true&vrstaDokumenta=12&dio=' + $("#hfDio").val());
		$('#navjestaj').submit();
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

	$("a[href*='dioStranice']").click(function() {
		$("#hfDio").val($(this).attr('id'));
	});

	$("#zupnomUredu").each(function() {
		$(this).autocomplete({
			source : '../../ajax/admin/zupe/nadjiZupu.php',
			minLength : 2,
			autoFocus : true,
			focus : function(event, ui) {
				event.preventDefault();
			},
			select : function(event, ui) {
				$(this).val(ui.item.nazivZupe + ', ' + ui.item.adresaUreda + ', ' + ui.item.nazivMjesta);
				event.preventDefault();
			}
		}).data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>").append("<a>" + item.nazivZupe + ", " + item.nazivMjesta + "</a>").appendTo(ul);
		};
	});

	$("#zupaVjencanja").each(function() {
		$(this).autocomplete({
			source : '../../ajax/admin/zupe/nadjiZupu.php?distinct=true',
			minLength : 2,
			autoFocus : true,
			focus : function(event, ui) {
				event.preventDefault();
			},
			select : function(event, ui) {
				$(this).val(ui.item.nazivZupe);
				event.preventDefault();
			}
		}).data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>").append("<a>" + item.nazivZupe + "</a>").appendTo(ul);
		};
	});
});


$(function() {
	$("#printP").children().click(function() {
		$("#obavijest").attr('action', '../../printanje/vjencanje/obavijest.php?vrstaDokumenta=13&dio=' + $("#hfDio").val());
		$('#obavijest').submit();
	});

	$("#previewP").children().click(function() {
		$('#obavijest').attr('action', '../../printanje/vjencanje/obavijest.php?preview=true&vrstaDokumenta=13&dio=' + $("#hfDio").val());
		$('#obavijest').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imeOn").val().length == 0 || $("#prezimeOn").val().length == 0 || $("#imeOna").val().length == 0 || $("#prezimeOna").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti imena i prezimena supružnika prije spremanja', 'error');
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

	$("input[id^='zupaKrstenja']").each(function() {
		$(this).autocomplete({
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
			return $("<li>").append("<a>" + item.nazivZupe + ", " + item.nazivMjesta + "</a>").appendTo(ul);
		};
	});
});


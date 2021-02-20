$(function() {
	$("#printP").children().click(function() {
		$("#pristupnica").attr('action', '../../printanje/potvrda/pristupnica.php?vrstaDokumenta=2&stranica=' + $("#hfStranica").val());
		$('#pristupnica').submit();
	});

	$("#previewP").children().click(function() {
		$('#pristupnica').attr('action', '../../printanje/potvrda/pristupnica.php?preview=true&vrstaDokumenta=2&stranica=' + $("#hfStranica").val());
		$('#pristupnica').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#potvrdjenik").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti ime i prezime potvrđenika', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});

	$("a[href*='stranica']").click(function() {
		$("#hfStranica").val($(this).attr('id'));
	});

	$("#zupaPotvrde").autocomplete({
		source : '../../ajax/admin/zupe/nadjiZupu.php',
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
		return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + "</a>").appendTo(ul);
	};
}); 
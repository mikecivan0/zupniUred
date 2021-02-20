$(function() {
	$("#printP").children().click(function() {
		$("#potvrdnica").attr('action', '../../printanje/ostalo/potvrdnica.php?vrstaDokumenta=17');
		$('#potvrdnica').submit();
	});

	$("#previewP").children().click(function() {
		$('#potvrdnica').attr('action', '../../printanje/ostalo/potvrdnica.php?preview=true&vrstaDokumenta=17');
		$('#potvrdnica').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#imePrezime").val().length == 0) {
			swal('Greška!', 'Obavezno unijeti ime i prezime prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});

	$("#zapis").autocomplete({
		source : '../../ajax/formulari/ostalo/potvrdnica.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$("#zapis").val(null);
			$("#zapis").attr('placeholder', ui.item.imeIPrezime + ", datum rođenja: " + ui.item.datumRodjenja);
			$('input [type=button]').removeAttr('checked');
			$('#zupa' + ui.item.zupa_id).prop('checked', true);
			$('#hfZupaId').val(ui.item.zupa_id);
			$('#imePrezime').val(ui.item.imeIPrezime);
			$('#rodjen').val(ui.item.datumRodjenja + ", " + ui.item.mjestoRodjenja);
			$('#krsten').val(ui.item.datumKrstenja + ", " + ui.item.mjestoKrstenja);
			$('#datumPotvrde').val(ui.item.datumPotvrde);
			$('#datumPricesti').val(ui.item.datumPricesti);
			$('#otac').val(ui.item.otac);
			$('#majka').val(ui.item.majka);
			$('#datumVjencanja').val(ui.item.datumVjencanja);
			$('#spol').val(ui.item.spol);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>matica župe: " + item.nazivZupe + ", " + item.imeIPrezime + ", datum rođenja: " + item.datumRodjenja + "</a>").appendTo(ul);
	};
}); 
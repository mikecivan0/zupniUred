$(function() {
	$("#printP").children().click(function() {
		$("#posvjedocenje").attr('action', '../../printanje/ostalo/posvjedocenje.php?vrstaDokumenta=16');
		$('#posvjedocenje').submit();
	});

	$("#previewP").children().click(function() {
		$('#posvjedocenje').attr('action', '../../printanje/ostalo/posvjedocenje.php?preview=true&vrstaDokumenta=16');
		$('#posvjedocenje').submit();
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
		source : '../../ajax/formulari/ostalo/posvjedocenje.php',
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
			$('#datumVjencanja').val(ui.item.datumVjencanja);
			$('#spol').val(ui.item.spol);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>matica župe: " + item.nazivZupe + ", " + item.imeIPrezime + ", datum rođenja: " + item.datumRodjenja + "</a>").appendTo(ul);
	};
}); 
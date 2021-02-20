$(function() {
	$("#osoba").autocomplete({
		source : '../../ajax/admin/osobe/nadjiOsobu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#osoba').val(ui.item.ime + " " + ui.item.prezime);
			$('#osoba_id').val(ui.item.id);
			$('#ime').val(ui.item.ime);
			$('#prezime').val(ui.item.prezime);
			$('#dPrezime').val(ui.item.dPrezime);
			$('#spol').val(ui.item.spol);
			$('#mjesto').val(ui.item.mjestoPrebivanja);
			$('#ulica').val(ui.item.ulica);
			$('#kucniBroj').val(ui.item.kucniBroj);
			$('#zanimanje').val(ui.item.zanimanje);
			$('#jmbg').val(ui.item.jmbg);
			$('#vjera').val(ui.item.vjera);
			$('#oib').val(ui.item.oib);
			$('#email').val(ui.item.email);
			$('#brisanje').attr('href', 'brisanje.php?id=' + ui.item.id);
			$('.podaci').show();
			$('.spremi').show();
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		if (item.mjestoPrebivanja != null) {
			var mjestoPrebivanja = item.mjestoPrebivanja;
		} else {
			var mjestoPrebivanja = 'nepoznato';
		}
		return $("<li>").append("<a>" + item.ime + " " + item.prezime + ", mjesto stanovanja: " + mjestoPrebivanja + "</a>").appendTo(ul);
	};
});


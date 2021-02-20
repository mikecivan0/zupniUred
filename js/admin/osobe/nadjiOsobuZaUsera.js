$(function() {
	$("#osoba").autocomplete({
		source : '../../ajax/admin/osobe/nadjiOsobuZaUsera.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#osoba_id').val(ui.item.id);
			$('#osoba').val(ui.item.ime + " " + ui.item.prezime + ", " + ui.item.mjestoPrebivanja + ", " + ui.item.oib);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.ime + " " + item.prezime + ", " + item.mjestoPrebivanja + "</a>").appendTo(ul);
	};
});


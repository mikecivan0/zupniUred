//autocomplete za pretragu obiteljskih listova i članova za prebacivanje
$(function() {
	$("#obiteljskiList").autocomplete({
		source : '../ajax/obiteljskiListovi/nadjiOLZaPrebacivanje.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfOlId').val(ui.item.id);
			$('#obiteljskiList').val(ui.item.prezime + ", " + ui.item.adresa);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a><b>Obiteljski list: </b> " + item.prezime + ", <b>adresa: </b> " + item.adresa + ", <b>telefon: </b> " + item.telefon + "</a>").appendTo(ul);
	};

	$("#clan").autocomplete({
		source : '../ajax/obiteljskiListovi/nadjiClanaZaPrebacivanje.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfClanId').val(ui.item.id);
			$('#clan').val(ui.item.ime + ", " + ui.item.prezime + ", " + ui.item.adresa);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a><b>Obiteljski list: </b> " + item.prezime + ", <b>ime: </b> " + item.ime + ", <b>adresa: </b> " + item.adresa + "</a>").appendTo(ul);
	};
});

$(function() {
	$("#zupa").autocomplete({
		source : '../../ajax/admin/zupe/nadjiZupu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfZupaId').val(ui.item.id);
			$('#hfMjestoId').val(ui.item.mjesto_id);
			$('#hfBiskupijaId').val(ui.item.biskupija_id);
			$('#hfPrinterId').val(ui.item.printer_id);
			$('#nazivZupe').val(ui.item.nazivZupe);
			$('#adresaUreda').val(ui.item.adresaUreda);
			$('#telefon').val(ui.item.telefon);
			$('#mjesto').val(ui.item.nazivMjesta);
			$('#printer').val(ui.item.nazivPrintera);
			$('#biskupija').val(ui.item.nazivBiskupije);
			$('#brisanje').attr('href', 'brisanje.php?id=' + ui.item.id);
			$('#gumbFilijala').attr('onclick', 'window.open("filijale.php?id=' + ui.item.id + '")');
			$('.spremi,#gumbFilijala').show();
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + "</a>").appendTo(ul);
	};
});


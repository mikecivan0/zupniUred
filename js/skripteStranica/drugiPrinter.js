$(function() {
	$("#drugiPrinter").autocomplete({
		source : '../../ajax/admin/printeri/nadjiPrinter.php?drugi=true',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$("#drugiPrinter").val(ui.item.nazivPrintera);
			$('#drugiPrinterSelect').val(ui.item.id);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		if (item.nazivBiskupije != null) {
			return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + ", printer: " + item.nazivPrintera + "</a>").appendTo(ul);
		} else {
			return $("<li>").append("<a>" + item.nazivPrintera + "</a>").appendTo(ul);
		}

	};

	$("#drugiPrinterSelect").change(function() {
		$("#izborDrugogPrintera").toggle();
	});
}); 
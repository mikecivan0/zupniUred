$(function() {
	$("#trazenaZupa").autocomplete({
		source : '../../ajax/admin/zupe/nadjiZupu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			//dodaj u polje trazene zupe
			$(this).val(ui.item.nazivZupe + ", " + ui.item.adresaUreda + ", " + ui.item.nazivMjesta + " " + ui.item.pbr);
			$('#hfZupaId').val(ui.item.id);
			$('#hfPrinterId').val(ui.item.printer_id);
			var matica = ui.item.nazivZupe + ", " + ui.item.adresaUreda + ", " + ui.item.nazivMjesta;
			$('#matica').val(ui.item.nazivZupe);
			$('#hfNadbiskupija').val(ui.item.nazivBiskupije);
			$('#hfZupa').val(matica);
			event.preventDefault();

		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + "</a>").appendTo(ul);
	};

});


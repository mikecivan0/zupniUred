$(function() {
	$("#kopirajIzZupe").autocomplete({
		source : '../../../ajax/admin/zupe/nadjiZupu.php?id=' + $('#hfPrinterIdZaSpremanjeUdaljenosti').val(),
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			if (ui.item.nazivPrintera == null)
				ui.item.nazivPrintera = 'nepoznat';
			$('#hfPrinterZaKopiranjeId').val(ui.item.printer_id);
			$('#kopirajIzZupe').val(ui.item.nazivMjesta + ", " + ui.item.nazivZupe + ", printer:" + ui.item.nazivPrintera);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		if (item.nazivPrintera == null)
			item.nazivPrintera = 'nepoznat';
		return $("<li>").append("<a>" + item.nazivBiskupije + ", " + item.nazivZupe + ", " + item.adresaUreda + ", " + item.nazivMjesta + " " + item.pbr + ", printer: " + item.nazivPrintera + "</a>").appendTo(ul);
	};

});

function kopirajIzZupe() {
	if ($('#hfPrinterZaKopiranjeId').val().length != 0) {
		$.ajax({
			type : "POST",
			url : "../../../ajax/admin/postavke/udaljenosti/poPrinterima/kopirajOdDrugih.php",
			data : "printerUKojiSeKopira=" + $('#hfPrinterIdZaSpremanjeUdaljenosti').val() + "&printerIzKojegSeKopira=" + $('#hfPrinterZaKopiranjeId').val() + "&q=" + $("#vrstaDokumenta").val(),
			success : function() {
				$("#forma").submit();
			}
		});
	} else {
		swal('Greška!', 'Odaberite župu iz koje želite kopirati podatke!', 'error');
	}
}

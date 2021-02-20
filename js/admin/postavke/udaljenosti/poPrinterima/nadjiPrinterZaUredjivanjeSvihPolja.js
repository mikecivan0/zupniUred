$(function() {
	$("#printer").autocomplete({
		source : '../../../ajax/admin/printeri/nadjiPrinter.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfPrinterIdZaSpremanjeUdaljenosti').val(ui.item.id);
			$('#printer').val(ui.item.nazivPrintera);
			$("#potvrda").show();
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivPrintera + "</a>").appendTo(ul);
	};
});


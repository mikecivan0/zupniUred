$(function() {
	$("#printer").autocomplete({
		source : '../../ajax/admin/printeri/nadjiPrinter.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfPrinterId').val(ui.item.id);
			$('#printer').val(ui.item.nazivPrintera);
			$('#nazivPrintera').val(ui.item.nazivPrintera);
			$('#brisanje').attr('href', 'brisanje.php?id=' + ui.item.id);
			$(".spremi").show();
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivPrintera + "</a>").appendTo(ul);
	};
});


$(function() {
	$("#mjesto").autocomplete({
		source : '../../ajax/admin/mjesta/nadjiMjesto.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfMjestoId').val(ui.item.id);
			$('#mjesto').val(ui.item.nazivMjesta);
			$('#nazivMjesta').val(ui.item.nazivMjesta);
			$('#pbr').val(ui.item.pbr);
			$('#brisanje').attr('href', 'brisanje.php?id=' + ui.item.id);
			$('.spremi').show();
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.pbr + " " + item.nazivMjesta + "</a>").appendTo(ul);
	};
});


$(function() {
	$("#biskupija").autocomplete({
		source : '../../ajax/admin/biskupije/nadjiBiskupiju.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfBiskupijaId').val(ui.item.id);
			$('#biskupija').val(ui.item.nazivBiskupije);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivBiskupije + "</a>").appendTo(ul);
	};
});


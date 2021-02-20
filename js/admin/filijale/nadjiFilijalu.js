$(function() {
	$("#filijala").autocomplete({
		source : '../../ajax/admin/filijale/nadjiFilijalu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#filijala').val(ui.item.nazivMjesta + " " + ui.item.pbr);
			$("#hfNovaFilijalaId").val(ui.item.id);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.nazivMjesta + " " + item.pbr + "</a>").appendTo(ul);
	};
});


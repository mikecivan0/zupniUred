$(function() {
	$("input[id^=mjesto]").each(function() {
		$(this).autocomplete({
			source : '../ajax/admin/mjesta/nadjiMjesto.php',
			minLength : 2,
			autoFocus : true,
			focus : function(event, ui) {
				event.preventDefault();
			},
			select : function(event, ui) {
				$(this).val(ui.item.pbr + " " + ui.item.nazivMjesta);
				event.preventDefault();
			}
		}).data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>").append("<a>" + item.pbr + " " + item.nazivMjesta + "</a>").appendTo(ul);
		};

	});

});


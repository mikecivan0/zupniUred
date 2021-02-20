$(function() {
	$("#target").autocomplete({
		source : '../../ajax/admin/users/nadjiUsera.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#target').val(ui.item.ime + " " + ui.item.prezime + ", " + ui.item.username);
			$('#hfUserId').val(ui.item.userId);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.ime + " " + item.prezime + ", " + item.username + "</a>").appendTo(ul);
	};
});


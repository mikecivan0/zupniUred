$(function() {
	$("#user").autocomplete({
		source : '../../ajax/admin/users/nadjiUsera.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('option').removeAttr('selected');
			$('#user').val(ui.item.ime + " " + ui.item.prezime);
			$('.podaci').show();
			$('#hfUserId').val(ui.item.userId);
			$('#username').val(ui.item.username);
			$('#istekLicence').val(ui.item.istekLicence);
			$('#brisanje').attr('href', 'brisanje.php?id=' + ui.item.userId);
			$('#razina' + ui.item.razina).prop('selected', true);
			$('#aktivan' + ui.item.aktivan).prop('selected', true);
			$('.spremi').show();

			if (ui.item.razina == 0) {
				$("#ovlastiNadZupama").show();
			} else {
				$("#ovlastiNadZupama").hide();
			}

			$('#linkOvlasti').attr('href', 'ovlastiNadZupama.php?id=' + ui.item.userId);

			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a>" + item.ime + " " + item.prezime + ", " + item.username + "</a>").appendTo(ul);
	};
});


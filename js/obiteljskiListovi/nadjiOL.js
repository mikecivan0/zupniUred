//autocomplete za pretragu obiteljskih listova
$(function() {
	$("#obiteljskiList").autocomplete({
		source : '../ajax/obiteljskiListovi/nadjiOL.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			$('#hfOlId').val(ui.item.id);
			$('#obiteljskiList').val(ui.item.prezime + ", " + ui.item.ime + ", " + ui.item.adresa);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		if (item.ime == null) {
			item.ime = "nema upisanih članova";
		}
		return $("<li>").append("<a><b>Obitelj: </b> " + item.prezime + ", <b>ime: </b> " + item.ime + ", <b>adresa: </b> " + item.adresa + "</a>").appendTo(ul);
	};
});

$("#gumbPretrage").click(function() {
	if ($("#hfOlId").val().length != 0) {
		window.location.replace('promjena.php?id=' + $("#hfOlId").val());
	}
});


$(function() {
	var prvi = $("input[type=radio]:first");
	prvi.attr('checked', 'checked');
	$('#matica').val($(prvi).attr('nazivZupe'));
	$('#hfZupaId').val($(prvi).val());
});

$(function() {
	//pri promjeni odabira popuni polja novoodabranom župom
	$("input[name='zupa']").change(function() {
		$('#hfZupaId').val($(this).val());
		$('#matica').val($(this).attr('nazivZupe'));
	});
});

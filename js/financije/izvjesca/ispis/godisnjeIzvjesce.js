$(function() {
	$("#printImg").click(function() {
		$("#forma").attr('action', '../ispis/printanjeGI.php?id=' + $("#hfZupaId").val());
		$('#forma').submit();
	});

	$("#previewImg").click(function() {
		$('#forma').attr('action', 'pregledGI.php?id=' + $("#hfZupaId").val());
		$('#forma').submit();
	});
}); 
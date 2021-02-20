$(function() {
	$("#printImg").click(function() {
		$("#forma").attr('action', '../ispis/printanjeKI.php?id=' + $("#hfZupaId").val());
		$('#forma').submit();
	});

	$("#previewImg").click(function() {
		$('#forma').attr('action', 'pregledKI.php?id=' + $("#hfZupaId").val());
		$('#forma').submit();
	});
}); 
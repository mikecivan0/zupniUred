$(function() {
swal({
		title : 'Imate nepročitanih poruka',
		text : 'Želite li pregledati poruke?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, idi na pregled poruka!',
		cancelButtonText : 'Ne, kasnije ću!',
	}).then(function(result) {
		if (result.value) {
			window.location.href = "poruke/index.php";
		}
	});
});
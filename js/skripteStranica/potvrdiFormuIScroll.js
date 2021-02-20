$(document).ready(function() {
	if ($.cookie("scroll") != null) {
		$(document).scrollTop($.cookie("scroll"));
	}

	$("input").keyup(function() {
		$("#hfScroll").val($(document).scrollTop());
	});
});

function potvrdiFormu() {

	var date = new Date();
	date.setTime(date.getTime() + (5000));
	//izbriši cookie nakon 5 sekundi poslije posta

	$.cookie("scroll", $("#hfScroll").val(), {
		expires : date
	});
	//napravi cookie da se vrati na scroll inputa koji se zadnji mijenjao

	$("form").submit();
}

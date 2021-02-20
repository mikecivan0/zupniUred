$(function() {
	setInterval(function() {
		if ($("#ikonaPoruke").attr('src').indexOf('e_mail.png') > -1) {
			var noviAttr = $("#ikonaPoruke").attr('src').replace('e_mail.png', 'e_mail_red.png');
		} else {
			var noviAttr = $("#ikonaPoruke").attr('src').replace('e_mail_red.png', 'e_mail.png');
		}
		$("#ikonaPoruke").attr('src', noviAttr);
	}, 1000);
}); 
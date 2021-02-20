function pomjeriZa(selektor) {
	var selektorGrupa = "#" + selektor + "Grupa";
	//napravi id leftGrupa ili topGrupa
	var inputId = selektor.charAt(0).toUpperCase() + selektor.slice(1).toLowerCase();
	//selektor transformiraj u firstLetterUp
	var leftGrupa = parseFloat($(selektorGrupa).val(), 10);
	//transform iz stringa u broj

	$('form :input[id*=' + inputId + ']').each(function() {//zahvati svaki input koji u id-u sadrži selektor koji je firstLetterUp
		var vrijednost = parseFloat($(this).val(), 10);
		//transform iz stringa u broj
		var novaVrijednost = leftGrupa + vrijednost;
		// izračunaj novu vrijednost
		$(this).val(Math.round(novaVrijednost * 100) / 100);
		//bez math.round radi na desetak decimala, ovako zaokružujemo na 1 decimalu
	});
	$("#obavijest").removeAttr("style");
}

function resetirajPolje(input) {
	polje = "#hf" + input.charAt(0).toUpperCase() + input.slice(1) + "Id";
	//od imena inputa kreiraj ime hf hidden Id polja koje će se resetirati
	input = "#" + input;
	//ako je zadani input prazan
	if (!$(input).val()) {
		$(polje).val("");
	}
}

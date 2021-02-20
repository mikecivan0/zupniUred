function printajIZatvori() {
	window.print();
	zatvoriProzor();
};

function zatvoriProzor() {
	setTimeout(function() {
		window.close();
	}, 200);
};
<?php


if (isset($_SESSION[$ida . "autoriziran"])) {
	$dozvola = "da";
} else {
	//provjera da li se aplikacija koristi samo za prijavljene korisnike
	$javniPristup = $postavke -> javniPristup;
	if ($javniPristup == 1) {//ako je 0 onda se aplikacija koristi samo za prijavljene korisnike, a ako je 1 onda kreiraj varijablu dozvola kao indikator
		$dozvola = "da";
	} else {
		$dozvola = "ne";
		//onemogućuje pristup stranicama ako korisnik nije prijavljen, osim za prijava.php i odjava.php
		if (strpos($_SERVER["PHP_SELF"], "auth/prijava.php") == 0) {
			header('location: ' . $putanjaApp . 'auth/prijava.php');
		}
	}
}

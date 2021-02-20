<?php
if(!isset($dozvola)||$dozvola!="da"||!isset($_POST["ime"])){
	exit;
}

$izraz = $veza -> prepare("update osobe set ime=:ime,prezime=:prezime,email=:email,
						   mjestoPrebivanja=:mjestoPrebivanja,ulica=:ulica,kucniBroj=:kucniBroj,jmbg=:jmbg,oib=:oib
						   where id=:id");
$izraz -> bindParam(":ime", $_POST["ime"]);
$izraz -> bindParam(":prezime", $_POST["prezime"]);
$izraz -> bindParam(":email", $_POST["email"]);
$izraz -> bindParam(":mjestoPrebivanja", $_POST["mjestoPrebivanja"]);
$izraz -> bindParam(":ulica", $_POST["ulica"]);
$izraz -> bindParam(":kucniBroj", $_POST["kucniBroj"]);
$izraz -> bindParam(":jmbg", $_POST["jmbg"]);
$izraz -> bindParam(":oib", $_POST["oib"]);
$izraz -> bindParam(":id", $podaci->osoba_id);
$izraz -> execute();

$_SESSION[$ida . "autoriziran"]->ime = $_POST["ime"];
$_SESSION[$ida . "autoriziran"]->prezime = $_POST["prezime"];
$porukaOSpremanju = "Podaci uspješno spremljeni";
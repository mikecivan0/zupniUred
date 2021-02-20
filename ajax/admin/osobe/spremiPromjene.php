<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';
$izraz = $veza -> prepare("update osobe set mjestoPrebivanja=:mjestoPrebivanja,ime=:ime,prezime=:prezime,dPrezime=:dPrezime,email=:email,
						   ulica=:ulica,kucniBroj=:kucniBroj,zanimanje=:zanimanje,jmbg=:jmbg,oib=:oib,vjera=:vjera,spol=:spol 
						   where id=:id;");

foreach ($_POST as $key => $value) {
	$_POST[$key] = (strlen($_POST[$key])==0) ? null : $_POST[$key];
}

$izraz -> execute($_POST);
echo "Podaci spremljeni";

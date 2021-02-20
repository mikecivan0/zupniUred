<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(!isset($_POST["javniPristup"])){
	exit;
}

$izraz = $veza -> prepare("update postavke set javniPristup=:javniPristup");
	$izraz -> execute($_POST);
	
	$javniPristup = '';//sprječava grešku uslijed slaganja radio buttona u if upitu

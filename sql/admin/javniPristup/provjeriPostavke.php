<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}


$izraz = $veza -> prepare("select javniPristup from postavke");
	$izraz -> execute();
	$javniPristup = $izraz -> fetch(PDO::FETCH_OBJ);
	
	$javniPristup = $javniPristup->javniPristup;
	
	
	
	
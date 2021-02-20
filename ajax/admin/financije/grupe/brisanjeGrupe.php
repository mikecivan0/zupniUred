<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../../config/conf.php';

$izraz = $veza->prepare("select * from svrhe where grupa_id=:id limit 1");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(empty($ima)){
		$izraz = $veza->prepare("delete from grupe where id=:id");
		$izraz->execute($_POST);
		echo "Grupa obrisana";
	}else{
		echo "Grupa ne može biti obrisana jer ju korisnici koriste. Molimo prvo obrišite pripadajuće svrhe te grupe.";
	}


<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../../config/conf.php';

$izraz = $veza->prepare("select * from stavke where izvjesce_id=:id limit 1");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(empty($ima)){
		$izraz = $veza->prepare("delete from izvjesca where id=:id");
		$izraz->execute($_POST);
		echo "Izvješće obrisano";
	}else{
		echo "Izvješće ne može biti obrisano jer ga korisnici koriste. Molimo prvo obrišite pripadajuće stavke tog izvješća ukoliko se i one ne koriste.";
	}


<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../../config/conf.php';

$izraz = $veza->prepare("select * from kalkulacije where svrha_id=:id limit 1;");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(empty($ima)){
		$izraz = $veza->prepare("delete from svrhe where id=:id");
		$izraz->execute($_POST);
		echo "Stavka obrisana";
	}else{
		echo "Stavka ne može biti obrisana jer se koristi u izračunu izvješća.";
	}


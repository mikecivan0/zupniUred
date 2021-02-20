<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../../config/conf.php';

$izraz = $veza->prepare("select * from kalkulacije where stavka_id=:id and zupa_id is null;");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(empty($ima)){
		$izraz = $veza->prepare("delete from stavke where id=:id and zupa_id is null;");
		$izraz->execute($_POST);
		echo "Stavka obrisana";
	}else{
		echo "Stavka ne može biti obrisana jer se koristi u kalkulacijama za izvješća.";
	}


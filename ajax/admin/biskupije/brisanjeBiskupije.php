<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../config/conf.php';

$izraz = $veza->prepare("select * from zupe where biskupija_id=:id limit 1");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(empty($ima)){
		$izraz = $veza->prepare("delete from biskupije where id=:id");
		$izraz->execute($_POST);
		echo "Biskupija obrisana";
	}else{
		echo "Biskupija ne može biti obrisana jer u njoj ima upisanih župa. Molimo prvo obrišite pripadajuće župe.";
	}




<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../config/conf.php';

$izraz = $veza->prepare("select id from obiteljskiListovi where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user)");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':user', $podaci->userId);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(!empty($ima)){
		$izraz = $veza->prepare("delete from clanovi where ol_id=:id");
		$izraz -> bindParam(':id', $_POST["id"]);
		$izraz->execute();
		
		$izraz = $veza->prepare("delete from obiteljskiListovi where id=:id");
		$izraz -> bindParam(':id', $_POST["id"]);
		$izraz->execute();
		echo "Obrisano";
	}else{
		echo "Ne možete obrisati obiteljski list koji ne pripada Vašoj župi.";
	}



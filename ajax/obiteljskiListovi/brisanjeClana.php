<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../config/conf.php';

$izraz = $veza->prepare("select id from clanovi where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user)");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':user', $podaci->userId);
	$izraz->execute();
	$ima =  $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(!empty($ima)){
		$izraz = $veza->prepare("delete from clanovi where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user)");
		$izraz -> bindParam(':id', $_POST["id"]);
		$izraz -> bindParam(':user', $podaci->userId);
		$izraz->execute();
		echo "Član obrisan";
	}else{
		echo "Ne možete obrisati člana koji nije u obiteljskim listovima Vaših Župa.";
	}



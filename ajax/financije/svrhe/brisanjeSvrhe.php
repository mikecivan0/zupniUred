<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../config/conf.php';
$poruka = '';
$izraz = $veza->prepare("select * from svrhe where id=:id and zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':user_id', $podaci->userId);
	$izraz->execute();
	$imaSvrhe =  $izraz -> fetch(PDO::FETCH_OBJ);
	
if(!empty($imaSvrhe)){
	$izraz = $veza->prepare("select * from svrhe s inner join transakcije t on t.svrha_id=s.id 
						where t.svrha_id=:id limit 1;");
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz->execute();
	$imaTransakcija =  $izraz -> fetch(PDO::FETCH_OBJ);
	if(!empty($imaTransakcija)){
		$poruka = "Stavka ne može biti obrisana jer se koristi u dnevnicima.";
		echo $poruka;
	}else{
		$izraz = $veza->prepare("select * from kalkulacije where svrha_id=:id limit 1;");
		$izraz -> bindParam(':id', $_POST["id"]);
		$izraz->execute();
		$imaKalkulacije =  $izraz -> fetch(PDO::FETCH_OBJ);
		if(!empty($imaKalkulacije)){
			$poruka = "Stavka ne može biti obrisana jer se koristi u kalkulacijama.";
			echo $poruka;
		}
	}
		
	if(strlen($poruka)==0){
		$izraz = $veza->prepare("delete from svrhe where id=:id;");
		$izraz->execute($_POST);
		echo "Stavka obrisana";
	}

}else{
	echo "Ne možete brisati tuđe stavke!";
}

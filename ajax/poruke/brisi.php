<?php

if(!$_POST){
	exit;
}

include_once '../../config/conf.php';

if(isset($_POST["poruke"])){
	
	//slaganje sql upita za provjeru jesu li sve poruke od istog korisnika
	$poruke = json_decode($_POST["poruke"]);
	$array = array();
	
	foreach ($poruke as $poruka) {
		array_push($array,$poruka->id);		
	}
	$in = implode(',', $array);
	
	//fiksni dio sql-a	
	$sqlDrugiDio = " where id in (" . $in .") and za=" . $podaci->userId . ";";
	
	//provjera broja poruka
	$sql = "select count(id) as ids from poruke" . $sqlDrugiDio;
	$izraz = $veza->prepare($sql);
	$izraz->execute();
	$fetch = $izraz -> fetch(PDO::FETCH_OBJ);
	$brojPoruka = $fetch->ids;
	
	if($brojPoruka==count($array)){
		//izbrisi poruke
		$sql2 = "update poruke set obrisano=1" . $sqlDrugiDio;
		$izraz = $veza->prepare($sql2);
		$izraz->execute();
		echo "Poruke obrisane";
	}else{
		echo "Ne možete brisati tuđe poruke!";
	}
	
	
	
}else{
	$izraz = $veza->prepare("select * from poruke where id=:id and za=:user_id;");
	$izraz -> bindValue(":id", $_POST["poruka"]);
	$izraz -> bindValue(":user_id", $podaci->userId);
	$izraz->execute();
	$imaPoruka = $izraz -> fetch(PDO::FETCH_OBJ);
	
	if(!empty($imaPoruka)){
		$izraz = $veza->prepare("update poruke set obrisano=1 where id=:id and za=:user_id;");
		$izraz -> bindValue(":id", $_POST["poruka"]);
		$izraz -> bindValue(":user_id", $podaci->userId);
		$izraz->execute();
		echo "Poruka obrisana";
	}else{
		echo "Ne možete brisati tuđe poruke";
	}	
}



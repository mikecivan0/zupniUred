<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	
	$izraz = $veza -> prepare("select * from zupe where mjesto_id=:id limit 20");
	$izraz -> execute($_GET);
	$zupe= $izraz -> fetchAll(PDO::FETCH_OBJ);
	/*
	if(!empty($zupe)){
		$odgovor = "Određene župe su povezane sa ovim mjestom<br />";
	}
	*/
	$izraz = $veza -> prepare("select * from filijale f inner join zupe on f.zupa_id=zupe.id where f.mjesto_id=:id limit 20");
	$izraz -> execute($_GET);
	$filijale = $izraz -> fetchAll(PDO::FETCH_OBJ);
	/*
	if(!empty($filijale)){
		$odgovor = $odgovor . "Određene filijale su povezane sa ovim mjestom<br />";
	}
	*/
	$izraz = $veza -> prepare("select * from osobe where mjesto_id=:id or mjestoRodjenja=:id limit 20");
	$izraz -> execute($_GET);
	$osobe = $izraz -> fetchAll(PDO::FETCH_OBJ);
	/*
	if(!empty($osobe)){
		$odgovor = $odgovor . "Određene osobe su povezane sa ovim mjestom<br />";
	}
		
	
	if(strlen($odgovor)>0){
		$odgovor = "Nije moguće obrisati mjesto. Razlog: <br />" . $odgovor;
	}
	*/
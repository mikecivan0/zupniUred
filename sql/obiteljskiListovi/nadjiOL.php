<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select * from obiteljskiListovi where id=:id 
						   and zupa_id in(select zupa_id from zupnici where user_id=:userId);");
$izraz -> bindParam(':id', $olId);
$izraz -> bindParam(':userId', $podaci->userId);
$izraz -> execute();
$ol = $izraz -> fetch(PDO::FETCH_OBJ);
if(!empty($ol)){
	$zupa_id = $ol -> zupa_id;
	$prezime = $ol -> prezime;
	$adresa = $ol -> adresa;
	$telefon = $ol -> telefon;
	$dosliIz = $ol -> dosliIz;
	$lukna = $ol -> lukna;
	$darovi = $ol -> darovi;
	$crkvenoKada = $ol -> crkvenoKada;
	$crkvenoGdje = $ol -> crkvenoGdje;
	$civilnoKada = $ol -> civilnoKada;
	$civilnoGdje = $ol -> civilnoGdje;
	$opaske = $ol -> opaske;
	$biljeske = $ol -> biljeske;
	
	//dohvati i razvrstaj muža, ženu, djecu i ostale članove
	$izraz = $veza -> prepare("select * from clanovi where ol_id=:id;");
	$izraz -> bindParam(':id', $olId);
	$izraz -> execute();
	$clanovi = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	$muz = new Clan; //prazne vrijednosti
	$zena = new Clan; //prazne vrijednosti
	$djeca = array();
	$ukucani = array();
	
	foreach ($clanovi as $clan) {
		switch ($clan->uloga_id) {
			case 1:
				$muz = $clan;
				break;
				
			case 2:
				$zena = $clan;
				break;
				
			case 3:
				array_push($djeca,$clan);
				break;
				
			case 4:
				array_push($ukucani,$clan);
		}
	}
}else{
	header('location: index.php');
}

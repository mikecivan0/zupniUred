<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select t.*,s.grupa_id from 
						   transakcije t inner join svrhe s on t.svrha_id=s.id 
						   where t.id=:id and t.zupa_id in (select zupa_id from zupnici where user_id=:user_id);");
$izraz -> bindParam(':id', $_GET["transakcija_id"]);
$izraz -> bindParam(':user_id', $podaci->userId);
$izraz -> execute();
$transakcija = $izraz -> fetch(PDO::FETCH_OBJ);

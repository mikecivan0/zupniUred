<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from zupe z
						   inner join mjesta m on z.mjesto_id=m.id
						   inner join biskupije b on z.biskupija_id=b.id 
						   where z.id=:id and z.id in (select zupa_id from zupnici where user_id=:user_id);");
	$izraz->bindParam(':id',$_POST["hfZupaId"]);
	$izraz->bindParam(':user_id',$podaci->userId);
	$izraz -> execute();
	$zupa = $izraz -> fetch(PDO::FETCH_OBJ);
	
	$podaciZupe = $zupa->nazivZupe . ", " . $zupa->adresaUreda . ", " . $zupa->pbr . " " . $zupa->nazivMjesta;
	$matica = $zupa->nazivZupe;
	$biskupija = $zupa->nazivBiskupije;
	$printerId = $zupa->printer_id;
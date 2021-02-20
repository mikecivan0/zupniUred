<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("select * from users where zupa_id=:id limit 20");
	$izraz -> execute($_GET);
	$users= $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	$izraz = $veza -> prepare("select * from zupljani z inner join osobe o on z.osoba_id=o.id where z.zupa_id=:id limit 20");
	$izraz -> execute($_GET);
	$zupljani = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	$izraz = $veza -> prepare("select * from filijale f inner join mjesta m on f.mjesto_id=m.id where f.zupa_id=:id limit 20");
	$izraz -> execute($_GET);
	$filijale = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
	$izraz = $veza -> prepare("select * from primljeno where zupa_id=:id limit 20");
	$izraz -> execute($_GET);
	$primljeno = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
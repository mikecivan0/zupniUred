<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("select m.nazivMjesta,m.pbr,f.id from filijale f inner join mjesta m on f.mjesto_id=m.id where f.zupa_id=:id");
	$izraz -> bindParam(":id", $_GET["id"]);
	$izraz -> execute();
	$filijale = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
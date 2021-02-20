<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select z.*,m.nazivMjesta,m.pbr from zupe z 
						   inner join zupnici zu on zu.zupa_id=z.id
						   inner join mjesta m on z.mjesto_id=m.id
						   where z.id=:id and zu.user_id=:user_id;");
$izraz -> bindParam(':id', $_GET["id"]);
$izraz -> bindParam(':user_id', $podaci -> userId);
$izraz -> execute();
$zupa = $izraz -> fetch(PDO::FETCH_OBJ);

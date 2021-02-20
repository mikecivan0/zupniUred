<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$id = $podaci -> userId;
$izraz = $veza -> prepare("select * from dokumenti where user_id=:id order by naziv;");
$izraz -> bindParam(':id', $id);
$izraz -> execute();
$dokumenti = $izraz -> fetchAll(PDO::FETCH_OBJ);

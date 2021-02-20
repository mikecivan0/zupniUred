<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select * from kalkulacije
						   where zupa_id is null
						   and id=:id;");
$izraz->bindPAram(':id', $id);
$izraz -> execute();
$kalkulacija = $izraz -> fetch(PDO::FETCH_OBJ);
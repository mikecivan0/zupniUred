<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select distinct YEAR(datum) as godina from 
						   transakcije where zupa_id=:id order by godina;");
		$izraz -> bindParam(':id', $_GET["id"]);
		$izraz -> execute();
		$godine = $izraz -> fetchAll(PDO::FETCH_OBJ);
		
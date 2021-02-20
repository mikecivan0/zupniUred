<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("select * from poruke where primatelj_id=:id and procitano=0 and obrisano=0;");
$izraz->bindParam(':id', $podaci->userId);
$izraz -> execute();
$porukeZaSwal = $izraz -> fetchAll(PDO::FETCH_OBJ);


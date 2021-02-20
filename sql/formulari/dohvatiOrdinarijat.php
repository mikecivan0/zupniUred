<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$id = $podaci -> userId;
$izraz = $veza -> prepare("select distinct b.nazivBiskupije from 
						   users u inner join zupnici z on z.user_id=u.id
						   inner join zupe zu on z.zupa_id=zu.id
						   inner join biskupije b on zu.biskupija_id=b.id
						   where u.id=:id");
$izraz -> bindParam(':id', $id);
$izraz -> execute();
$biskupija = $izraz -> fetch(PDO::FETCH_OBJ);
$ordinarijat = Alati::ordinarijat($biskupija->nazivBiskupije);

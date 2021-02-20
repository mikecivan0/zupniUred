s<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}
$izraz = $veza -> prepare("select * from users where osoba_id=:id");
$izraz -> execute($_GET);
$user = $izraz -> fetch(PDO::FETCH_OBJ);

if (!empty($user)) {
	$user_id = $user -> id;
	$izraz = $veza -> prepare("select zu.* from zupnici z inner join zupe zu on z.zupa_id=zu.id
							   where z.user_id=:id");
	$izraz -> bindParam(':id', $user_id);
	$izraz -> execute();
	$zupnik = $izraz -> fetchAll(PDO::FETCH_OBJ);
}

<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

$izraz = $veza -> prepare("update clanovi set ol_id=:ol_id,zupa_id=:zupa_id,uloga_id=:uloga_id where id=:id
						   and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
$izraz -> bindParam(':ol_id', $_POST["hfOlId"]);
$izraz -> bindParam(':zupa_id', $imaOL->zupa_id);
$izraz -> bindParam(':uloga_id', $_POST["uloga_id"]);
$izraz -> bindParam(':id', $_POST["hfClanId"]);
$izraz -> bindParam(':userId', $podaci->userId);
$izraz -> execute();





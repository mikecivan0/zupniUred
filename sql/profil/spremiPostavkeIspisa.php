<?php
if(!isset($dozvola)||$dozvola!="da"||!isset($_POST["rukopis"])){
	exit;
}

$izraz = $veza -> prepare("update users set rukopis=:rukopis where id=:id");

$izraz -> bindParam(":rukopis", $_POST["rukopis"]);
$izraz -> bindParam(":id", $podaci->userId);
$izraz -> execute();

$_SESSION[$ida . "autoriziran"]->rukopis = $_POST["rukopis"];
$porukaOSpremanju = "Podaci uspješno spremljeni";
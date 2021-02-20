<?php
if(!isset($dozvola)||$dozvola!="da"||!isset($_POST["username"])){
	exit;
}

$sql = "update users set username=:username";
if(strlen($_POST["password"])>0){
	$passwordHash = md5($_POST["password"]);
	$sql .= ",password=:password";
}
$sql .= " where id=:id";
$izraz = $veza -> prepare($sql);
if(strlen($_POST["password"])>0){
	$izraz -> bindParam(":password", $passwordHash);
}
$izraz -> bindParam(":username", $_POST["username"]);
$izraz -> bindParam(":id", $podaci->userId);
$izraz -> execute();

$_SESSION[$ida . "autoriziran"]->username = $_POST["username"];
$porukaOSpremanju = "Podaci uspješno spremljeni";
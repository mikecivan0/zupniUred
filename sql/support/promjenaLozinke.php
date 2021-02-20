<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}
$password = md5($_POST["password"]);
$izraz = $veza -> prepare("update users set password=:password where id=:id");
$izraz -> bindParam('password', $password);
$izraz -> bindParam('id', $_POST["hfUserId"]);
$izraz -> execute();
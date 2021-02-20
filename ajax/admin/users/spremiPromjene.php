<?php

if (!isset($_POST["id"])) {
	exit ;
}

include_once '../../../config/conf.php';

$izraz = $veza -> prepare("select username from users where username=:username and id!=:id");
$izraz -> bindParam(":username", $_POST["username"]);
$izraz -> bindParam(":id", $_POST["id"]);
$izraz -> execute();
$postojeci = $izraz->fetch(PDO::FETCH_OBJ);

if(!empty($postojeci)){
	echo "Korisničko ime je zauzeto.";
}else{
	$_POST["istekLicence"] = (empty($_POST["istekLicence"])) ? null : $_POST["istekLicence"];
	//kreiraj sql naredbu ovisno o dobijenim podacima
 $sql = "update users set username=:username,razina=:razina,aktivan=:aktivan,istekLicence=:istekLicence";
		if (isset($_POST["password"])) {
			$_POST["password"] = md5($_POST["password"]);
			$sql .= ",password=:password";
		}
		$sql .= " where id=:id";

		$izraz = $veza -> prepare($sql);
		$izraz -> execute($_POST);
		echo "Podaci spremljeni";
}
	
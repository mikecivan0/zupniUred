<?php
if (!isset($_GET["term"])) {
	exit ;
}

include_once '../../../config/conf.php';
$sql = "select o.ime,o.prezime,u.username,u.id as userId,u.osoba_id as osobaId,u.razina,u.aktivan,u.alias,u.istekLicence
		from osobe o inner join users u on u.osoba_id=o.id
		where o.ime like :uvjet or o.prezime like :uvjet or u.username like :uvjet 
		or concat(o.ime,' ',o.prezime) like :uvjet or concat(o.prezime,' ',o.ime) like :uvjet or u.alias like :uvjet";

//ako se traži user za posalti poruku treba spriječiti da korisnik šalje sam sebi jer se to onda gleda kao na adminovu obavijest
if (isset($_GET["not"])) {
	$sql .= " and u.id!=:not";
}

$izraz = $veza -> prepare($sql);

if (isset($_GET["term"])) {
	$uv = "%" . strtolower($_GET["term"]) . "%";
	$izraz -> bindParam(':uvjet', $uv);
} else {
	$uv = "%";
	$izraz -> bindParam(':uvjet', $uv);
}

if (isset($_GET["not"])) {
	$izraz -> bindParam(':not', $_GET["not"]);
}

$izraz -> execute();
echo json_encode($izraz -> fetchAll(PDO::FETCH_OBJ));

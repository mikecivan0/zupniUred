<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}

if (!empty($_POST["hfClanId"])) {//ako je odabran član
	$izraz = $veza -> prepare("select * from clanovi where id=:clan_id
								   and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
	$izraz -> bindParam(':clan_id', $_POST["hfClanId"]);
	$izraz -> bindParam(':userId', $podaci -> userId);
	$izraz -> execute();
	$imaClan = $izraz -> fetch(PDO::FETCH_OBJ);

	if (empty($imaClan)) {//ako je upisan tuđi član id
		$g = new stdClass();
		$g -> element = "clan";
		$g -> poruka = "Obavezno izaberite osobu iz obiteljskih listova Vaše župe";
		array_push($greske, $g);
	}
} else {//ako nije odabran član
	$g = new stdClass();
	$g -> element = "clan";
	$g -> poruka = "Obavezno izaberite osobu";
	array_push($greske, $g);
}

if (!empty($_POST["hfOlId"])) {//ako je odabran OL
	$izraz = $veza -> prepare("select * from obiteljskiListovi where id=:ol_id
								   and zupa_id in(select zupa_id from zupnici where user_id=:userId)");
	$izraz -> bindParam(':ol_id', $_POST["hfOlId"]);
	$izraz -> bindParam(':userId', $podaci -> userId);
	$izraz -> execute();
	$imaOL = $izraz -> fetch(PDO::FETCH_OBJ);

	if (empty($imaOL)) {//ako je upisan tuđi OL id
		$g = new stdClass();
		$g -> element = "obiteljskiList";
		$g -> poruka = "Obavezno izaberite obiteljski list Vaše župe";
		array_push($greske, $g);
	}
} else {//ako nije odabran OL
	$g = new stdClass();
	$g -> element = "obiteljskiList";
	$g -> poruka = "Obavezno izaberite obiteljski list";
	array_push($greske, $g);
}

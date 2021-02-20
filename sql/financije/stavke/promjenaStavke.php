<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update stavke set nazivStavke=:stavka,grupa_id=:grupa_id,izvjesce_id=:izvjesce_id where id=:id and zupa_id=:zupa_id;");
	$izraz -> bindParam(':stavka', $_POST["stavka"]);
	$izraz -> bindParam(':grupa_id', $_POST["grupa_id"]);
	$izraz -> bindParam(':izvjesce_id', $_POST["izvjesce_id"]);
	$izraz -> bindParam(':id', $_POST["id"]);
	$izraz -> bindParam(':zupa_id', $_POST["zupa_id"]);
	$izraz -> execute();
	header ('location:' . $putanjaApp . 'financije/stavke/stavke.php?id=' . $_POST["zupa_id"]);

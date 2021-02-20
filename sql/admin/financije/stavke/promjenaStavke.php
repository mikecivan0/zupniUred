<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
	$izraz = $veza -> prepare("update stavke set nazivStavke=:stavka,grupa_id=:grupa_id,izvjesce_id=:izvjesce_id where id=:id and zupa_id is null;");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/financije/stavke/stavke.php');

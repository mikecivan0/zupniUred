<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_GET)){
	$izraz = $veza -> prepare("select * from users u inner join osobe o on u.osoba_id=o.id where u.id=:id;");
	$izraz -> execute($_GET);
	$user = $izraz -> fetch(PDO::FETCH_OBJ);
}

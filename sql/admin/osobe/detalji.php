<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_GET)){
	$izraz = $veza -> prepare("select * from osobe where id=:id;");
	$izraz -> execute($_GET);
	$osoba = $izraz -> fetch(PDO::FETCH_OBJ);
}

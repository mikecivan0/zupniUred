<?php

if(!isset($_POST["id"])){
	exit;
}


include_once '../../../../config/conf.php';

		$izraz = $veza->prepare("delete from automatskiUnosi where id=:id and zupa_id is null;");
		$izraz->execute($_POST);
		echo "Automatski unos obrisan";
	
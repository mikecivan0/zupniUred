<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(!isset($_POST["inspect"])){
	exit;
}

$izraz = $veza -> prepare("update postavke set inspect=:inspect");
	$izraz -> execute($_POST);
	
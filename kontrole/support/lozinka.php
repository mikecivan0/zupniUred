<?php
if (!$_POST) {
	if (!isset($_GET["token"]) || !isset($_GET["ver"]) || !isset($_GET["email"])) {
		exit ;
	}

	$hash = md5($_GET["email"]);
	$token = md5($hash . $_GET["ver"]);

	if ($_GET["token"] != $token) {
		exit ;
	} else {
		$dozvola = 'da';
	}

}else{
	$dozvola='da';
}

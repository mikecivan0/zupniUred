<?php

if(!isset($_SESSION[$ida . "autoriziran"])||$_SESSION[$ida . "autoriziran"]->razina<3){
	session_destroy();
	header("location:" . $putanjaApp . "auth/prijava.php?error=4");
}else{
	$dozvola = "da";
}

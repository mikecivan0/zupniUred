<?php

if(!isset($_SESSION[$ida . "autoriziran"])){
	session_destroy();
	header("location:" . $putanjaApp . "auth/prijava.php?error=4");
}else{
	$dozvola = "da";
}

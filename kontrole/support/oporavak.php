<?php

if(empty($_POST["email"])){
	$error = 'crveniRub';
	$poruka = 'Obavezno email';
}else{
	$error = null;
	$poruka = null;
}
if($error==null){
	$izraz = $veza -> prepare("select u.username,u.id from users u inner join osobe o on u.osoba_id=o.id
						   where o.email=:email;");
	$izraz -> execute($_POST);
	$user = $izraz -> fetch(PDO::FETCH_OBJ);	
	if(empty($user->username)){
		$error = 'crveniRub';
		$poruka = 'Email nije povezan niti sa jednim korisnikom.';
	}else{
		$username = $user->username;
		$id = $user->id;
		$poruka = 'Poslan Vam je email sa daljnjim uputama za oporavak. Moguće je da će se poruka nalaziti u neželjenoj pošti. Hvala';		
		$error = null;
	}
}


<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

	
	
	
	if (strlen(trim($_POST["password"]))==0) {
		$g=new stdClass();
		$g->element="password";
		$g->poruka="Obavezno lozinka";
		array_push($greske,$g);
		$password='ne';
	}else{
		$password='ok';
	}
	
	if (strlen(trim($_POST["passwordAgain"]))==0) {
		$g=new stdClass();
		$g->element="passwordAgain";
		$g->poruka="Obavezno ponovno lozinka";
		array_push($greske,$g);
		$passwordAgain='ne';
	}else{
		$passwordAgain='ok';
	}

	if (($password=='ok'&&$passwordAgain=='ok')&&(strlen(trim($_POST["password"]))!=strlen(trim($_POST["passwordAgain"])))) {
		$g=new stdClass();
		$g->element="passwordAgain";
		$g->poruka="Lozinka i ponovno lozinka se ne poklapaju";
		$g->element="password";
		$g->poruka="Lozinka i ponovno lozinka se ne poklapaju";
		array_push($greske,$g);
	}
	
	if (strlen(trim($_POST["username"]))==0) {
		$g=new stdClass();
		$g->element="username";
		$g->poruka="Obavezno korisničko ime";
		array_push($greske,$g);		
		$korisnickoIme='ne';
	}else{
		$korisnickoIme='ok';
	}
	
	if($korisnickoIme=='ok'){
		$izraz = $veza -> prepare("select username from users where username=:username;");
		$izraz -> bindParam(':username', $_POST["username"]);
		$izraz -> execute();
		$user = $izraz -> fetch(PDO::FETCH_OBJ);
		
		if(!empty($user)){
			$g=new stdClass();
			$g->element="username";
			$g->poruka="Korisničko ime je zauzeto";
			array_push($greske,$g);
			}
	}
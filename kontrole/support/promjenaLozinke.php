<?php

if (strlen(trim($_POST["password"]))==0) {
		$g=new stdClass();
		$g->element="password";
		$g->poruka="Obavezno nova lozinka";
		array_push($greske,$g);
	}


if(empty($greske)){
	$poruka = 'Lozinka je uspješno promjenjena. Kliknite <a href="../auth/prijava.php">ovdje</a> da bi ste se logirali sa novim podacima.';
	$from = 'Crkveni dokumenti';

	$message = 'Vaša lozinka je uspješno promjenjena. <br /> 
				Ukoliko Vi niste mijenjali lozniku molimo kontaktirajte administratora.';

}

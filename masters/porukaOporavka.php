<?php

$from = 'support@crkveni-dokumenti.eu5.org';

$hash = md5($_POST["email"]);
$token = md5($hash . $id);
$link = 'www.' . $_SERVER["SERVER_NAME"] . '/support/lozinka.php?token=' . $token . '&email=' . $_POST["email"] . '&ver=' . $id;
$message = 'Ova poruka je generirana automatskim putem i nemojte odgovarati na nju.<br />
			Zatražen je oporavak podataka za pristup aplikaciji <b>Crkveni dokumenti</b>. Ukoliko niste zatražili oporavak zanemarite ovu poruku.<br />
			Vaše korisničko ime je <b>' . $username . '</b><br />
			Ukoliko želite promijeniti lozinku kliknite <a href="' . $link . '">ovdje</a>. Ovim putem možete promijeniti lozinku kada god poželite.';


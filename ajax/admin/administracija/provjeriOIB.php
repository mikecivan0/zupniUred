<?php
if (!$_POST) {
	exit ;
}

include_once '../../../config/conf.php';

$oib = $_POST["oib"];

if (is_numeric($oib) AND strlen($oib) === 11) {
	$a = 10;
	$i = 0;
	//ponavljaj korake za sve znamenke
	while ($i < 10) {
		$a = $a + substr($oib, $i, 1);
		//pribroji znamenku
		$a = $a % 10;
		//podjeli cjelobrojno sa brojem 10
		$a = ($a == 0) ? 10 : $a;
		//ako je ostatak 0 zamjeni sa 10
		$a *= 2;
		//međuostatak podjeli sa 2
		$a = $a % 11;
		//dobiveni umnožak podijeli sa 11
		$i++;
		//postavi na sljedeću znamenku
	}
	//kontrola
	$kontrola = 11 - $a;
	//ako je ostatak 1 kontrolna znamenka je 0
	$kontrola = ($kontrola == 10) ? 0 : $kontrola;
	//da bude jasnije
	echo ($kontrola == substr($oib, 10, 1)) ? 1 : 0;
} else {
	echo 0;
}

<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}
if(isset($_POST)){
	foreach ($_POST as $key => $value) {
		$_POST[$key] = empty($_POST[$key]) ? null : $_POST[$key];
	}
	$izraz = $veza -> prepare("insert into osobe(mjestoPrebivanja,ime,prezime,dPrezime,email,ulica,kucniBroj,zanimanje,jmbg,oib,vjera,spol) 
							   values(:mjesto,:ime,:prezime,:dPrezime,:email,:ulica,:kucniBroj,:zanimanje,:jmbg,:oib,:vjera,:spol);");
	$izraz -> execute($_POST);
	header ('location:' . $putanjaApp . 'admin/osobe/detalji.php?id=' . $veza->lastInsertId());
	print_r($_POST);
}

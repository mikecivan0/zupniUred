<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

if(isset($_POST)){
	//dohvati zadnji markStavke uvećan za 1
	$izraz = $veza -> prepare("select markStavke+1 from stavke where zupa_id is null order by markStavke desc limit 1;");	
	$izraz -> execute();
	$markStavke = $izraz->fetch(PDO::FETCH_COLUMN);
	
	
	$izraz = $veza -> prepare("insert into stavke(nazivStavke,izvjesce_id,grupa_id,markStavke) values(:stavka,:izvjesce_id,:grupa_id,:markStavke);");	
	$izraz->bindParam(':stavka', $_POST["stavka"]);
	$izraz->bindParam(':izvjesce_id', $_POST["izvjesce_id"]);
	$izraz->bindParam(':grupa_id', $_POST["grupa_id"]);
	$izraz->bindParam(':markStavke', $markStavke);
	$izraz -> execute();
	header ('location:' . $putanjaApp . 'admin/financije/stavke/stavke.php');
}

<?php
if(!isset($dozvola)||$dozvola!="da"){
	exit;
}

$izraz = $veza -> prepare("select i.nazivIzvjesca,g.nazivGrupe,st.nazivStavke,st.id
						   from izvjesca i inner join stavke st on st.izvjesce_id=i.id
						   inner join grupe g on st.grupa_id=g.id
						   where zupa_id=:zupa_id
						   order by i.id,g.id,st.nazivStavke;");
	$izraz->bindParam(':zupa_id', $_GET["id"]);
	$izraz -> execute();
	$stavke = $izraz -> fetchAll(PDO::FETCH_OBJ);
	
if(isset($_GET["kalkulacija_id"])){
	$izraz = $veza -> prepare("select stavka_id from kalkulacije where id=:id;");
	$izraz -> bindParam(":id", $_GET["kalkulacija_id"]);
	$izraz -> execute();
	$getStavka= $izraz -> fetch(PDO::FETCH_OBJ);
}
	
	$selectStavke = "<label>Stavka izvješća</label><select name='stavka_id' id='stavka_id'>";
	foreach ($stavke as $stavka) {
		$selectStavke .= "<option value='" . $stavka->id . "'";
		if(!$_POST&&isset($_GET["kalkulacija_id"])){
			$selectStavke .= ($stavka->id==$getStavka->stavka_id) ? " selected=true" : null;
		}elseif($_POST&&isset($_POST["grupa_id"])){
			$selectStavke .= ($_POST["grupa_id"]==$stavka->id) ? " selected=true" : null;
		}
		$selectStavke .= ">" . $stavka->nazivIzvjesca . ", " . $stavka->nazivGrupe . " - " . $stavka->nazivStavke . "</option>";
	}
	$selectStavke .= "</select>";

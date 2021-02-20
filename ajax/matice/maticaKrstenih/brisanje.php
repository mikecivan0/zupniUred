<?php

if (!$_POST) {
	exit ;
}

include_once '../../../config/conf.php';

if (isset($_POST["mkId"])) {
	$izraz = $veza -> prepare("select * from maticaKrstenih where id=:id 
							 and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
	$izraz -> bindValue(":id", $_POST["mkId"]);
	$izraz -> bindValue(":user_id", $podaci -> userId);
	$izraz -> execute();
	$imaMaticaKrstenih = $izraz -> fetch(PDO::FETCH_OBJ);

	if (!empty($imaMaticaKrstenih)) {
		$izraz = $veza -> prepare("select * from maticaVjencanih where (mkIdOn=:id or mkIdOna=:id) 
								 and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
		$izraz -> bindValue(":id", $_POST["mkId"]);
		$izraz -> bindValue(":user_id", $podaci -> userId);
		$izraz -> execute();
		$imaMaticaVjencanih = $izraz -> fetch(PDO::FETCH_OBJ);

		if (empty($imaMaticaVjencanih)) {
			$izraz = $veza -> prepare("select * from maticaUmrlih where mk_id=:id
									 and zupa_id in(select zupa_id from zupnici where user_id=:user_id);");
			$izraz -> bindValue(":id", $_POST["mkId"]);
			$izraz -> bindValue(":user_id", $podaci -> userId);
			$izraz -> execute();
			$imaMaticaUMrlih = $izraz -> fetch(PDO::FETCH_OBJ);
			
			if (empty($imaMaticaUMrlih)) {
				$izraz = $veza -> prepare("delete from osobe where id=:id;");
				$izraz -> bindValue(":id", $imaMaticaKrstenih -> osoba_id);
				$izraz -> execute();

				$izraz = $veza -> prepare("delete from maticaKrstenih where id=:id;");
				$izraz -> bindValue(":id", $_POST["mkId"]);
				$izraz -> execute();

				echo "Unos obrisan";
			} else {
				echo "Ne možete obrisati ovaj zapis jer je osoba povezana sa Maticom umrlih!";
			}
		} else {
			echo "Ne možete obrisati ovaj zapis jer je osoba povezana sa Maticom vjenčanih!";
		}
	} else {
		echo "Ne možete brisati zapise matica drugih župa!";
	}
} else {
	echo "Nešto ne valja!";
}

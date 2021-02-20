<?php
if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}else{
include_once '../../alati/Html.php';
include_once '../../alati/Alati.php';
include_once '../../klase/SQL.php';
include_once '../../alati/IspisFinancija.php';
include_once '../../sql/financije/dnevnici/nadjiTransakcijeZaCrveni.php';
include_once '../../sql/financije/dnevnici/stanjeSaPrethodneStraniceZaCrveni.php';
$ukupnoA = 0.00;
$ukupnoC = 0.00;
$count = 0;	
$broj = 0;
$ispisMjeseca = ltrim($_GET["mjesec"],"0");
$ispisGodine = substr($_GET["godina"], -2);
$zadnjiDanMjeseca = date('t',strtotime($_GET["godina"] . '-' . $_GET["mjesec"] . "-01"));
$brojStranice = (empty($_GET["stranica"])) ? 1 : $_GET["stranica"];
?>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<head>
		<?php include_once '../../masters/printStyle.php' ?>
	</head>
	<body style="font-family:  Arial, 'Helvetica Neue', Helvetica, sans-serif">
		<div style="width: 170mm; margin: 0 auto;">

			<?php
			echo(empty($transakcije)) ? IspisFinancija::pocetakTablice('PRIMITAK A-1', 'IZDATAK C-1') . IspisFinancija::krajTablice() : null;
			//ako nema podataka onda kreiraj početak tablice
			foreach ($transakcije as $transakcija) {
				$count++;
				$broj++;
				($transakcija -> grupa_id == 1) ? $ukupnoA += $transakcija -> iznos : $ukupnoC += $transakcija -> iznos;
				$iznos = Alati::hrIznos(number_format($transakcija -> iznos, 2));
				if ($count == 1) {
					echo '<div style="float: right; font-family: TimesNewRoman, \"Times New Roman\", Times, Baskerville, Georgia, serif;">BLAGAJNIČKI DNEVNIK</div>';
					echo '<div id="datumDnevnika" style="padding-top: 20mm; padding-bottom: 10mm; text-align: center; font-size: 20px; font-family: TimesNewRoman, \"Times New Roman\", Times, Baskerville, Georgia, serif; width: 170mm;">
									<b>Od</b>
									<span>1.' . $ispisMjeseca . '.</span>
									<b> do</b>
									<span> ' . $zadnjiDanMjeseca . '.' . $ispisMjeseca . '. </span>
									<b>20</b>
									<span>' . $ispisGodine . '.</span>
									<b> godine</b>
							  </div>';
					echo IspisFinancija::pocetakTablice('PRIMITAK A-1', 'IZDATAK C-1');
				}
				$datum = Alati::datum($transakcija -> datum);
				IspisFinancija::redUTablici($broj, $transakcija, $datum, $godinaTransakcije, $mjesecTransakcije, $iznos, $putanjaApp);
				if ($count == 24) {//ako se dođe do kraja stranice
					//konvertiranje u hrv format iznosa
					IspisFinancija::zbrajanjeNaKrajuLista(Alati::hrIznos(number_format($ukupnoA, 2)), Alati::hrIznos(number_format($ukupnoC, 2)), Alati::hrIznos(number_format($prosloStanjeA, 2)), Alati::hrIznos(number_format($prosloStanjeC, 2)), Alati::hrIznos(number_format($ukupnoA + $prosloStanjeA, 2)), Alati::hrIznos(number_format($ukupnoC + $prosloStanjeC, 2)));
					echo IspisFinancija::krajTablice();
					IspisFinancija::brojStranice($brojStranice);
					$count = 0;
					//pretakanje novih vrijednosti
					$prosloStanjeA = $ukupnoA + $prosloStanjeA;
					$prosloStanjeC = $ukupnoC + $prosloStanjeC;
					$ukupnoA = 0.00;
					$ukupnoC = 0.00;
					$brojStranice++;
				}
			}

			if ($count != 24 && $count != 0) {//ukoliko nema više redova a nije se popunio papir krairaj zbroj na kraju stranice
				$dodatniRedovi = 24 - $count;
				IspisFinancija::prazniRedoviTablice($dodatniRedovi);
				IspisFinancija::zbrajanjeNaKrajuLista(Alati::hrIznos(number_format($ukupnoA, 2)), Alati::hrIznos(number_format($ukupnoC, 2)), Alati::hrIznos(number_format($prosloStanjeA, 2)), Alati::hrIznos(number_format($prosloStanjeC, 2)), Alati::hrIznos(number_format($ukupnoA + $prosloStanjeA, 2)), Alati::hrIznos(number_format($ukupnoC + $prosloStanjeC, 2)));
				echo IspisFinancija::krajTablice();
				IspisFinancija::brojStranice($brojStranice);
			}
			?>
		</div>
		<script type="text/javascript">
			window.onload = function() {
				window.print();
			}
		</script>
	</body>
</html>
<?php } ?>


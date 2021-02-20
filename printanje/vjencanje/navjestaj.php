<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../sql/printanje/nadjiZupu.php'; //kreiraj objekt $zupa
include_once '../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php';
//kreiraj $objDokument sa podacima udaljenosti
include_once '../../sql/admin/printeri/nadjiPrinter.php';
//kreiraj objekt $printer
include_once '../../alati/Printanje.php';
include_once '../../alati/Alati.php';
//obj_ColumnToArrayToObj($objDokument,"udaljenosti"); //napravi objekt od dobivenih podataka iz stringa $objDokument>udaljenosti
//obj_ColumnToArrayToObj($zupa,"udaljenosti*"); //napravi objekt od dobivenih podataka iz stringa $zupa->udaljenosti*

//uključi alat za kreiranje pdf-a
include_once '../../alati/mpdf/mpdf.php';

//kreiraj istancu objekta
$mpdf = new mPDF('utf8', 'A4', 12, 'Arial', 20, 20, 25.4, 28, 25.4, 28);

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$navjestaj = Alati::dodajMM($objDokument,"udaljenosti");
}else{
	$navjestaj = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument, "udaljenosti"), Alati::obj_ColumnToArrayToObj($printer, "udaljenostiNavjestaj"));
}


//zadaj što da kreira
switch ($_GET["dio"]) {
	case 'gornji' :	
		$html = Printanje::polje($navjestaj -> biskupijaPosiljTop, $navjestaj -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($navjestaj -> zupaPosiljTop, $navjestaj -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($navjestaj -> brojDokumentaPosiljTop, $navjestaj -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
				Printanje::polje(Alati::prilagodiVisinu($_POST["zupnomUredu"], $navjestaj -> zupUreduPosiljTop,50), $navjestaj -> zupnomUreduLeft, $_POST["zupnomUredu"], 'f w100 sredina','',50) .
				Printanje::polje($navjestaj -> imeIPrezimeTop, $navjestaj -> onLeft, $_POST["imeIPrezimeOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> imeIPrezimeTop, $navjestaj -> onaLeft, $_POST["imeIPrezimeOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> mjIDatRodjenjaTop, $navjestaj -> onLeft, $_POST["mjIDatumRodjenjaOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> mjIDatRodjenjaTop, $navjestaj -> onaLeft, $_POST["mjIDatumRodjenjaOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> otacTop, $navjestaj -> onLeft, $_POST["otacOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> otacTop, $navjestaj -> onaLeft, $_POST["otacOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> majkaTop, $navjestaj -> onLeft, $_POST["majkaOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> majkaTop, $navjestaj -> onaLeft, $_POST["majkaOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> zanimanjeTop, $navjestaj -> onLeft, $_POST["zanimanjeOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> zanimanjeTop, $navjestaj -> onaLeft, $_POST["zanimanjeOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> vjeraTop, $navjestaj -> onLeft, $_POST["vjeraOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> vjeraTop, $navjestaj -> onaLeft, $_POST["vjeraOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> adresaTop, $navjestaj -> onLeft, $_POST["adresaOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> adresaTop, $navjestaj -> onaLeft, $_POST["adresaOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($navjestaj -> datumIZupaZenidbeTop, $navjestaj -> datumZenidbeLeft, Alati::datum($_POST["datumVjencanja"]), 'f w40 sredina','float: left;',null) .
				Printanje::polje($navjestaj -> datumIZupaZenidbeTop, $navjestaj -> zupaZenidbeLeft, $_POST["zupaVjencanja"], 'f w90 sredina','float: left;',45) .							
				Printanje::polje($navjestaj -> datumPosiljTop, $navjestaj -> datumLeft, Alati::datum($_POST["datum"]), 'f w50 broj sredina','');
		break;
		
	case 'donji' :
		$html = Printanje::polje($navjestaj -> biskupijaPrimTop, $navjestaj -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($navjestaj -> zupaPrimTop, $navjestaj -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($navjestaj -> brojDokumentaPrimTop, $navjestaj -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
				Printanje::polje(Alati::prilagodiVisinu($_POST["zupnomUredu"], $navjestaj -> zupUreduPrimTop,50), $navjestaj -> zupnomUreduLeft, $_POST["zupnomUredu"], 'f w100 sredina','',50) .									
				Printanje::polje($navjestaj -> navjestenoTop, $navjestaj -> navjestenoLeft, Alati::datum($_POST["navjesteno"]), 'f w40 broj sredina','') .
				Printanje::polje($navjestaj -> datumPrimTop, $navjestaj -> datumLeft, Alati::datum($_POST["datum"]), 'f w50 broj sredina','');
		break;	
}

if($_GET["preview"]){//ako je u GETU preview onda postavi watermark sa parametrima iz switcha u vezi položaja
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.65,array(210,296),array(1.4,0.8));
	$mpdf -> showWatermarkImage = true;
}

$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit ;

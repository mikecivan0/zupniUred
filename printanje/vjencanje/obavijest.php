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
	$obavijest = Alati::dodajMM($objDokument,"udaljenosti");
}else{
	$obavijest = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument, "udaljenosti"), Alati::obj_ColumnToArrayToObj($printer, "udaljenostiObavijest"));
}


//zadaj što da kreira
switch ($_GET["dio"]) {
	case 'gornji' :		
		$html = Printanje::polje($obavijest -> biskupijaPosiljTop, $obavijest -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($obavijest -> zupaPosiljTop, $obavijest -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($obavijest -> brojDokumentaPosiljTop, $obavijest -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
				Printanje::polje(Alati::prilagodiVisinu($_POST["zupnomUredu"], $obavijest -> zupUreduPosiljTop,55), $obavijest -> zupnomUreduLeft, $_POST["zupnomUredu"], 'f w100 sredina','',55) .
				Printanje::polje($obavijest -> datumZenidbeTop, $obavijest -> datumZenidbeLeft, Alati::datum($_POST["datumZenidbe"]), 'f w60 sredina','',null) .
				Printanje::polje($obavijest -> imeTop, $obavijest -> onLeft, $_POST["imeOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> imeTop, $obavijest -> onaLeft, $_POST["imeOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> prezimeTop, $obavijest -> onLeft, $_POST["prezimeOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> prezimeTop, $obavijest -> onaLeft, $_POST["prezimeOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> datumKrstenjaTop, $obavijest -> onLeft, Alati::datum($_POST["datumKrstenjaOn"]), 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> datumKrstenjaTop, $obavijest -> onaLeft, Alati::datum($_POST["datumKrstenjaOna"]), 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> zupaKrstenjaTop, $obavijest -> onLeft, $_POST["zupaKrstenjaOn"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> zupaKrstenjaTop, $obavijest -> onaLeft, $_POST["zupaKrstenjaOna"], 'f w60 sredina','float: left;',30) .
				Printanje::polje($obavijest -> svezStrBrTop, $obavijest -> svezOnLeft, $_POST["svezOn"], 'f w15 sredina','float: left;',null) .
				Printanje::polje($obavijest -> svezStrBrTop, $obavijest -> svezOnaLeft, $_POST["svezOna"], 'f w15 sredina','float: left;',null) .
				Printanje::polje($obavijest -> svezStrBrTop, $obavijest -> strOnLeft, $_POST["strOn"], 'f w15 sredina','float: left;',null) .
				Printanje::polje($obavijest -> svezStrBrTop, $obavijest -> strOnaLeft, $_POST["strOna"], 'f w15 sredina','float: left;',null) .
				Printanje::polje($obavijest -> svezStrBrTop, $obavijest -> brOnLeft, $_POST["brOn"], 'f w15 sredina','float: left;',null) .
				Printanje::polje($obavijest -> svezStrBrTop, $obavijest -> brOnaLeft, $_POST["brOna"], 'f w15 sredina','float: left;',null) .							
				Printanje::polje($obavijest -> datumPosiljTop, $obavijest -> datumLeft, Alati::datum($_POST["datum"]), 'f w50 broj sredina','');
		break;
		
	case 'donji' :
		$html = Printanje::polje($obavijest -> biskupijaPrimTop, $obavijest -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($obavijest -> zupaPrimTop, $obavijest -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($obavijest -> brojDokumentaPrimTop, $obavijest -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
				Printanje::polje(Alati::prilagodiVisinu($_POST["zupnomUredu"], $obavijest -> zupUreduPrimTop,55), $obavijest -> zupnomUreduLeft, $_POST["zupnomUredu"], 'f w100 sredina','',55) .									
				Printanje::polje($obavijest -> datumPrimTop, $obavijest -> datumLeft, Alati::datum($_POST["datum"]), 'f w50 broj sredina','');
		break;	
}

if($_GET["preview"]){//ako je u GETU preview onda postavi watermark sa parametrima iz switcha u vezi položaja
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.65,array(210,296), array(1.4,0.2));
	$mpdf -> showWatermarkImage = true;
}

$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit ;

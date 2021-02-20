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
	$zapisnik = Alati::dodajMM($objDokument,"udaljenosti");
}else{
	$zapisnik = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument, "udaljenosti"), Alati::obj_ColumnToArrayToObj($printer, "udaljenostiZapisnik"));
}


//zadaj što da kreira
switch ($_GET["stranica"]) {
	case '1' :		
		$polozaj = array(1.4,0.8);
		$html = Printanje::polje($zapisnik -> biskupijaTop, $zapisnik -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($zapisnik -> zupaTop, $zapisnik -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($zapisnik -> brojDokumentaTop, $zapisnik -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
				Printanje::polje($zapisnik -> imeIPrezimeTop, $zapisnik -> imeIPrezimeLeft, $_POST["imeIPrezime"], 'f w150 sredina','',null) .
				Printanje::polje($zapisnik -> datumVjeraTop, $zapisnik -> datumRodjenjaLeft, Alati::datum($_POST["datumRodjenja"]), 'f w50 sredina','float: left;',null) .
				Printanje::polje($zapisnik -> datumVjeraTop, $zapisnik -> vjeraLeft, $_POST["vjera"], 'f w80 sredina','float: left;',null) .
				Printanje::polje($zapisnik -> adresaTop, $zapisnik -> adresaLeft, $_POST["adresa"], 'f w140 sredina','',null) .
				Printanje::polje($zapisnik -> osobaTop, $zapisnik -> osobaLeft, Alati::splitOnTwo($_POST["osoba"],15)[0], 'f w40','',null) .
				Printanje::polje($zapisnik -> osoba2Top, $zapisnik -> left, Alati::splitOnTwo($_POST["osoba"],15)[1], 'f','',null) .
				Printanje::polje($zapisnik -> kadaGdjeTop, $zapisnik -> kadaGdjeLeft, Alati::splitOnTwo($_POST["kadaGdje"],18)[0], 'f w47','',null) .
				Printanje::polje($zapisnik -> kadaGdje2Top, $zapisnik -> left, Alati::splitOnTwo($_POST["kadaGdje"],18)[1], 'f','',null) .
				Printanje::polje($zapisnik -> nakanaTop, $zapisnik -> left, $_POST["nakana"], 'f','',null) .
				Printanje::polje($zapisnik -> zastoNeTop, $zapisnik -> zastoNeLeft, Alati::splitOnTwo($_POST["zastoNe"],20)[0], 'f w50','',null) .
				Printanje::polje($zapisnik -> zastoNe2Top, $zapisnik -> left, Alati::splitOnTwo($_POST["zastoNe"],20)[1], 'f','',null) .
				Printanje::polje($zapisnik -> mimoilazenjeTop, $zapisnik -> left, $_POST["mimoilazenje"], 'f','',null) .
				Printanje::polje($zapisnik -> kolikoTop, $zapisnik -> kolikoLeft, $_POST["koliko"], 'f w90 sredina','',null) .
				Printanje::polje($zapisnik -> popisDjeceTop, $zapisnik -> djecaLeft, $_POST["djeca"], 'f w25 sredina','float: left;',null) .
				Printanje::polje($zapisnik -> popisDjeceTop, $zapisnik -> popisDjeceLeft, Alati::splitOnTwo($_POST["popisDjece"],25)[0], 'f w53','',null) .
				Printanje::polje($zapisnik -> popisDjece2Top, $zapisnik -> left, Alati::splitOnTwo($_POST["popisDjece"],25)[1], 'f','',null) .				
				Printanje::polje($zapisnik -> djecaKrstenaTop, $zapisnik -> djecaKrstenaLeft, $_POST["djecaKrstena"], 'f lh9 w150 sredina','',null);
		break;

	case '2' :
		$polozaj = array(1.2,0.7);
		$html = Printanje::polje($zapisnik -> prekidVezeTop, $zapisnik -> prekidVezeLeft, Alati::splitOnTwo($_POST["prekidVeze"],25)[0], 'f','',null) .
				Printanje::polje($zapisnik -> prekidVeze2Top, $zapisnik -> left, Alati::splitOnTwo($_POST["prekidVeze"],25)[1], 'f lh9 w170','',null) .	 				
				Printanje::polje($zapisnik -> obavezeTop, $zapisnik -> obavezeLeft, $_POST['obaveze'], 'f w160 sredina','',null) . 
				Printanje::polje($zapisnik -> ispunjavanjeTop, $zapisnik -> ispunjavanjeLeft, $_POST['ispunjavanje'], 'f w130 sredina','',null) . 
				Printanje::polje($zapisnik -> obavezePremaDjeciTop, $zapisnik -> left, $_POST['obavezePremaDjeci'], 'f lh8 w170','',null) . 
				Printanje::polje($zapisnik -> dodatnoTop, $zapisnik -> left, $_POST['dodatno'], 'f lh8i5 w170','',null) . 
				Printanje::polje($zapisnik -> mjestoDatumTop, $zapisnik -> mjestoLeft, $_POST['mjesto'], 'f w70 sredina','float: left;',null) . 				
				Printanje::polje($zapisnik -> mjestoDatumTop, $zapisnik -> datumLeft, Alati::datum($_POST["datum"]), 'f','float: left;');
		break;	
}

if($_GET["preview"]){//ako je u GETU preview onda postavi watermark sa parametrima iz switcha u vezi položaja
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . 'Str' . $_GET["stranica"] . '.jpg',0.65,array(210,296),$polozaj);
	$mpdf -> showWatermarkImage = true;
}

$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit ;

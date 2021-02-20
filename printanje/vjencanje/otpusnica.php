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
	$otpusnica = Alati::dodajMM($objDokument,"udaljenosti");
}else{
	$otpusnica = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument, "udaljenosti"), Alati::obj_ColumnToArrayToObj($printer, "udaljenostiOtpusnica"));
}


//zadaj što da kreira
switch ($_GET["stranica"]) {
	case '1' :
		$polozaj = array(0,0);
		$html = Printanje::polje($otpusnica -> biskupijaTop, $otpusnica -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($otpusnica -> zupaTop, $otpusnica -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($otpusnica -> brDokIDatumTop, $otpusnica -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','float: left;',null) .
				Printanje::polje($otpusnica -> brDokIDatumTop, $otpusnica -> datumLeft, Alati::datum($_POST["datum"]), 'f w40 sredina','float: left;',null) .
				Printanje::polje($otpusnica -> imePrezimeOnTop, $otpusnica -> imePrezimeLeft, $_POST['imePrezimeOn'], 'f w145 sredina','',null) . 
				Printanje::polje($otpusnica -> sinTop, $otpusnica -> sinKciLeft, $_POST['sin'], 'f w165 sredina','',null) . 
				Printanje::polje($otpusnica -> datIMjRodjOnTop, $otpusnica -> datumRodjenjaLeft, Alati::datum($_POST["datumRodjenjaOn"]), 'f w50 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datIMjRodjOnTop, $otpusnica -> mjestoRodjenjaLeft, $_POST['mjestoRodjenjaOn'], 'f w95 sredina','float: left;',50) . 
				Printanje::polje($otpusnica -> adresaOnTop, $otpusnica -> adresaLeft, $_POST['adresaOn'], 'f w155 sredina','',null) .
				Printanje::polje($otpusnica -> zanimIVjeraOnTop, $otpusnica -> zanimanjeLeft, $_POST['zanimanjeOn'], 'f w80 sredina','float: left;',40) . 
				Printanje::polje($otpusnica -> zanimIVjeraOnTop, $otpusnica -> vjeraLeft, $_POST['vjeraOn'], 'f w65 sredina','float: left;') . 
				Printanje::polje($otpusnica -> zupaKrstenjaOnTop, $otpusnica -> zupaKrstenjaLeft, $_POST['zupaKrstenjaOn'], 'f w150 sredina','',75) . 
				Printanje::polje($otpusnica -> datIMatKrstOnTop, $otpusnica -> datumKrstenjaLeft, Alati::datum($_POST["datumKrstenjaOn"]), 'f w40 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datIMatKrstOnTop, $otpusnica -> svezLeft, $_POST["svezOn"], 'f w15 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datIMatKrstOnTop, $otpusnica -> strLeft, $_POST["strOn"], 'f w20 sredina','float: left;',null) .
				Printanje::polje($otpusnica -> datIMatKrstOnTop, $otpusnica -> brLeft, $_POST["brOn"], 'f w20 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datPotvrdeOnTop, $otpusnica -> datPotvrdeLeft, Alati::datum($_POST["datumPotvrdeOn"]), 'f broj w45 sredina','',null) .
				Printanje::polje($otpusnica -> imePrezimeOnaTop, $otpusnica -> imePrezimeLeft, $_POST['imePrezimeOna'], 'f w145 sredina','',null) . 
				Printanje::polje($otpusnica -> kciTop, $otpusnica -> sinKciLeft, $_POST['kci'], 'f w165 sredina','',null) . 
				Printanje::polje($otpusnica -> datIMjRodjOnaTop, $otpusnica -> datumRodjenjaLeft, Alati::datum($_POST["datumRodjenjaOna"]), 'f w50 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datIMjRodjOnaTop, $otpusnica -> mjestoRodjenjaLeft, $_POST['mjestoRodjenjaOna'], 'f w95 sredina','float: left;',50) . 
				Printanje::polje($otpusnica -> adresaOnaTop, $otpusnica -> adresaLeft, $_POST['adresaOna'], 'f w155 sredina','',null) .
				Printanje::polje($otpusnica -> zanimIVjeraOnaTop, $otpusnica -> zanimanjeLeft, $_POST['zanimanjeOna'], 'f w80 sredina','float: left;',40) . 
				Printanje::polje($otpusnica -> zanimIVjeraOnaTop, $otpusnica -> vjeraLeft, $_POST['vjeraOna'], 'f w65 sredina','float: left;') . 
				Printanje::polje($otpusnica -> zupaKrstenjaOnaTop, $otpusnica -> zupaKrstenjaLeft, $_POST['zupaKrstenjaOna'], 'f w150 sredina','',75) . 
				Printanje::polje($otpusnica -> datIMatKrstOnaTop, $otpusnica -> datumKrstenjaLeft, Alati::datum($_POST["datumKrstenjaOna"]), 'f w40 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datIMatKrstOnaTop, $otpusnica -> svezLeft, $_POST["svezOna"], 'f w15 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datIMatKrstOnaTop, $otpusnica -> strLeft, $_POST["strOna"], 'f w20 sredina','float: left;',null) .
				Printanje::polje($otpusnica -> datIMatKrstOnaTop, $otpusnica -> brLeft, $_POST["brOna"], 'f w20 sredina','float: left;',null) . 
				Printanje::polje($otpusnica -> datPotvrdeOnaTop, $otpusnica -> datPotvrdeLeft, Alati::datum($_POST["datumPotvrdeOna"]), 'f broj w45 sredina','',null) .
				Printanje::polje($otpusnica -> zeljenaZupaTop, $otpusnica -> zeljenaZupaLeft, $_POST["zeljenaZupaVjencanja"], 'f w90 sredina','',50);
		break;

	case '2' :
		$polozaj = array(0,0);	
		$html =	Printanje::polje($otpusnica -> zarucniciTop, $otpusnica -> zarucnikLeft, $_POST['zarucnik'], 'f w70 sredina','float: left',35) .
				Printanje::polje($otpusnica -> zarucniciTop, $otpusnica -> zarucnicaLeft, $_POST['zarucnica'], 'f w70 sredina','float: left',35) . 
				Printanje::polje($otpusnica -> vjencanjeTop, $otpusnica -> vjencanjeDatumLeft, Alati::datum($_POST["datumVjencanja"]), 'f w35 sredina','float: left',null) .
				Printanje::polje($otpusnica -> vjencanjeTop, $otpusnica -> vjencanjeCrkvaLeft, $_POST['crkvaVjencanja'], 'f w90 sredina','float: left',45) . 
				Printanje::polje($otpusnica -> zupaVjencanjaTop, $otpusnica -> zupaVjencanjaLeft, $_POST['zupaVjencanja'], 'f w160 sredina','',80) . 
				Printanje::polje($otpusnica -> sluzbenikTop, $otpusnica -> sluzbenikLeft, $_POST["sluzbenik"], 'f w140 sredina','',70) .
				Printanje::polje($otpusnica -> svjedok1Top, $otpusnica -> svjedociLeft, $_POST['svjedok1'], 'f w160 sredina','',80) . 
				Printanje::polje($otpusnica -> svjedok2Top, $otpusnica -> svjedociLeft, $_POST['svjedok2'], 'f w160 sredina','',80) . 
				Printanje::polje($otpusnica -> upisTop, $otpusnica -> upisSvezLeft, $_POST["upisSvez"], 'f w30 sredina','float: left',null) .
				Printanje::polje($otpusnica -> upisTop, $otpusnica -> upisStrLeft, $_POST['upisStr'], 'f w20 sredina','float: left',null) . 
				Printanje::polje($otpusnica -> upisTop, $otpusnica -> upisBrLeft, $_POST["upisBr"], 'f w25 sredina','float: left',null) .
				Printanje::polje($otpusnica -> upisMaticaKrstenihTop, $otpusnica -> upisMaticaKrstenihLeft, $_POST['upisMaticaKrstenih'], 'f w130 sredina','',65) . 
				Printanje::polje($otpusnica -> upisKnjigaTop, $otpusnica -> upisKnjigaLeft, $_POST['upisKnjiga'], 'f w130 sredina','',65) . 
				Printanje::polje($otpusnica -> upisKartotekaTop, $otpusnica -> upisKartotekaLeft, $_POST["upisKartoteka"], 'f w130 sredina','',65) .
				Printanje::polje($otpusnica -> poslanaObavijestOnTop, $otpusnica -> poslanaObavijestLeft, Alati::datum($_POST["poslanaObavijestOn"]), 'f broj w80 sredina','',null) . 
				Printanje::polje($otpusnica -> poslanaObavijestOnaTop, $otpusnica -> poslanaObavijestLeft, Alati::datum($_POST["poslanaObavijestOna"]), 'f broj w80 sredina','',null) .
				Printanje::polje($otpusnica -> maticniUredTop, $otpusnica -> maticniUredLeft, $_POST['maticniUred'], 'f w80 sredina','float: left',40) . 
				Printanje::polje($otpusnica -> maticniUredTop, $otpusnica -> vracenoUreduLeft, Alati::datum($_POST["vracenoUredu"]), 'f','float: left',null) .
				Printanje::polje($otpusnica -> potvrdaUpisaOnTop, $otpusnica -> potvrdaUpisaKadaLeft, Alati::datum($_POST["potvrdaUpisaOnKada"]), 'f broj w80 sredina','float: left',null) . 
				Printanje::polje($otpusnica -> potvrdaUpisaOnTop, $otpusnica -> potvrdaUpisaBrLeft, $_POST["potvrdaUpisaOnBr"], 'f broj w30 sredina','float: left',null) . 
				Printanje::polje($otpusnica -> potvrdaUpisaOnaTop, $otpusnica -> potvrdaUpisaKadaLeft, Alati::datum($_POST["potvrdaUpisaOnaKada"]), 'f broj w80 sredina','float: left',null) .
				Printanje::polje($otpusnica -> potvrdaUpisaOnaTop, $otpusnica -> potvrdaUpisaBrLeft, $_POST["potvrdaUpisaOnaBr"], 'f broj w30 sredina','float: left',null);
		break;
}

if($_GET["preview"]){//ako je u GETU preview onda postavi watermark sa parametrima iz switcha u vezi položaja
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . 'Str' . $_GET["stranica"] . '.jpg',0.65,array(210,295),$polozaj);
	$mpdf -> showWatermarkImage = true;
}

$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit ;

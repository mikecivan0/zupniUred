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
	$postupak = Alati::dodajMM($objDokument,"udaljenosti");
}else{
	$postupak = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument, "udaljenosti"), Alati::obj_ColumnToArrayToObj($printer, "udaljenostiPostupak"));
}


//zadaj što da kreira
switch ($_GET["stranica"]) {
	case '1' :
		$adresaOn = $_POST["mjestoOn"] . ", " . $_POST["ulicaOn"] . " " . $_POST["kBrOn"];
		$adresaOna = $_POST["mjestoOna"] . ", " . $_POST["ulicaOna"] . " " . $_POST["kBrOna"];
		$vjeraOn = ($_POST["vjeraOn"]=='katolik') ? 'rimokatolička' :  $_POST["vjeraOstaloOn"];
		$vjeraOna = ($_POST["vjeraOna"]=='katolik') ? 'rimokatolikčka' :  $_POST["vjeraOstaloOna"];
		$polozaj = array(1.4,0.8);
		$html = Printanje::polje($postupak -> biskupijaTop, $postupak -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
				Printanje::polje($postupak -> zupaTop, $postupak -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
				Printanje::polje($postupak -> brojDokumentaTop, $postupak -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
				Printanje::polje($postupak -> prezimenaTop, $postupak -> prezimenaLeft, $_POST["prezimena"], 'f w90 sredina prezimena','',null) .	
				Printanje::polje($postupak -> imePrezimeTop, $postupak -> onLeft, $_POST['imeIPrezimeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> imePrezimeTop, $postupak -> onaLeft, $_POST['imeIPrezimeOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> jmbgTop, $postupak -> onLeft, $_POST['jmbgOn'], 'f sredina w50','float: left;',null) . 
				Printanje::polje($postupak -> jmbgTop, $postupak -> onaLeft, $_POST['jmbgOna'], 'f sredina w50','float: left;',null) .
				Printanje::polje($postupak -> mjestoIDatumRodjenjaTop, $postupak -> onLeft, $_POST['mjestoRodjenjaOn'] . ", ". Alati::datum($_POST["datumRodjenjaOn"]), 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> mjestoIDatumRodjenjaTop, $postupak -> onaLeft, $_POST['mjestoRodjenjaOna'] . ", ". Alati::datum($_POST["datumRodjenjaOna"]), 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> otacTop, $postupak -> onLeft, $_POST['otacOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> otacTop, $postupak -> onaLeft, $_POST['otacOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> majkaTop, $postupak -> onLeft, $_POST['majkaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> majkaTop, $postupak -> onaLeft, $_POST['majkaOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> zanimanjeTop, $postupak -> onLeft, $_POST['zanimanjeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> zanimanjeTop, $postupak -> onaLeft, $_POST['zanimanjeOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> adresaTop, $postupak -> onLeft, $adresaOn, 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> adresaTop, $postupak -> onaLeft, $adresaOna, 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> zupaStanovanjaTop, $postupak -> onLeft, $_POST['zupaStanovanjaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> zupaStanovanjaTop, $postupak -> onaLeft, $_POST['zupaStanovanjaOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> vjeraTop, $postupak -> onLeft, $vjeraOn, 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> vjeraTop, $postupak -> onaLeft, $vjeraOna, 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> mjestoKrstenjaTop, $postupak -> onLeft, $_POST['mjestoKrstenjaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> mjestoKrstenjaTop, $postupak -> onaLeft, $_POST['mjestoKrstenjaOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> zupaKrstenjaTop, $postupak -> onLeft, $_POST['zupaKrstenjaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> zupaKrstenjaTop, $postupak -> onaLeft, $_POST['zupaKrstenjaOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> datumKrstenjaTop, $postupak -> onLeft, Alati::datum($_POST["datumKrstenjaOn"]), 'broj f sredina w50','float: left;',null) . 
				Printanje::polje($postupak -> datumKrstenjaTop, $postupak -> onaLeft, Alati::datum($_POST["datumKrstenjaOna"]), 'broj f sredina w50','float: left;',null) .
				Printanje::polje($postupak -> svezStrBrTop, $postupak -> svezOnLeft, $_POST["svezOn"], 'broj f w30','float: left;',null) . 
				Printanje::polje($postupak -> svezStrBrTop, $postupak -> strOnLeft, $_POST["strOn"], 'broj f w30','float: left;',null) .
				Printanje::polje($postupak -> svezStrBrTop, $postupak -> brOnLeft, $_POST["brOn"], 'broj f w30','float: left;',null) . 
				Printanje::polje($postupak -> svezStrBrTop, $postupak -> svezOnaLeft, $_POST["svezOna"], 'broj f w30','float: left;',null) .
				Printanje::polje($postupak -> svezStrBrTop, $postupak -> strOnaLeft, $_POST["strOna"], 'broj f w30','float: left;',null) . 
				Printanje::polje($postupak -> svezStrBrTop, $postupak -> brOnaLeft, $_POST["brOna"], 'broj f w30','float: left;',null) .
				Printanje::polje($postupak -> zupaPotvrdeTop, $postupak -> onLeft, $_POST['zupaPotvrdeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> zupaPotvrdeTop, $postupak -> onaLeft, $_POST['zupaPotvrdeOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> datumPotvrdeTop, $postupak -> onLeft, Alati::datum($_POST["datumPotvrdeOn"]), 'broj f sredina w50','float: left;',null) . 
				Printanje::polje($postupak -> datumPotvrdeTop, $postupak -> onaLeft, Alati::datum($_POST["datumPotvrdeOna"]), 'broj f sredina w50','float: left;',null) .
				Printanje::polje($postupak -> zupeStanovanjaTop, $postupak -> onLeft, $_POST['zupeStanovanjaOn'], 'f sredina w50','float: left; height: 19mm !important;') . 
				Printanje::polje($postupak -> zupeStanovanjaTop, $postupak -> onaLeft, $_POST['zupeStanovanjaOna'], 'f sredina w50','float: left; height: 19mm !important;');
		break;

	case '2' :
		$polozaj = array(1.2,0.4);
		$html = Printanje::polje($postupak -> prijasnjaVezaOsobaTop, $postupak -> pitanjaOnLeft, $_POST['prijasnjaVezaOsobaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> prijasnjaVezaOsobaTop, $postupak -> pitanjaOnaLeft, $_POST['prijasnjaVezaOsobaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> prijasnjaVezaVrijemeTop, $postupak -> pitanjaOnLeft, $_POST['prijasnjaVezaVrijemeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> prijasnjaVezaVrijemeTop, $postupak -> pitanjaOnaLeft, $_POST['prijasnjaVezaVrijemeOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> prekidPrijasnjeVezeTop, $postupak -> pitanjaOnLeft, $_POST['prekidPrijasnjeVezeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> prekidPrijasnjeVezeTop, $postupak -> pitanjaOnaLeft, $_POST['prekidPrijasnjeVezeOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> dokazSlobodnogStanjaTop, $postupak -> pitanjaOnLeft, $_POST['dokazSlobodnogStanjaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> dokazSlobodnogStanjaTop, $postupak -> pitanjaOnaLeft, $_POST['dokazSlobodnogStanjaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> zaprekaTop, $postupak -> pitanjaOnLeft, $_POST['zaprekaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> zaprekaTop, $postupak -> pitanjaOnaLeft, $_POST['zaprekaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> prisilaTop, $postupak -> pitanjaOnLeft, $_POST['prisilaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> prisilaTop, $postupak -> pitanjaOnaLeft, $_POST['prisilaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> poznavanjeTop, $postupak -> pitanjaOnLeft, $_POST['poznavanjeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> poznavanjeTop, $postupak -> pitanjaOnaLeft, $_POST['poznavanjeOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> poukaTop, $postupak -> pitanjaOnLeft, $_POST['poukaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> poukaTop, $postupak -> pitanjaOnaLeft, $_POST['poukaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> pripravaTop, $postupak -> pitanjaOnLeft, $_POST['pripravaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> pripravaTop, $postupak -> pitanjaOnaLeft, $_POST['pripravaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> svrhaTop, $postupak -> pitanjaOnLeft, $_POST['svrhaOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> svrhaTop, $postupak -> pitanjaOnaLeft, $_POST['svrhaOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> stavTop, $postupak -> pitanjaOnLeft, $_POST['stavOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> stavTop, $postupak -> pitanjaOnaLeft, $_POST['stavOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> dodatnoTop, $postupak -> pitanjaOnLeft, $_POST['dodatnoOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> dodatnoTop, $postupak -> pitanjaOnaLeft, $_POST['dodatnoOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> mjestoZenidbeTop, $postupak -> pitanjaOnLeft, $_POST['mjestoZenidbeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> mjestoZenidbeTop, $postupak -> pitanjaOnaLeft, $_POST['mjestoZenidbeOna'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> datumZenidbeTop, $postupak -> pitanjaOnLeft, Alati::datum($_POST["datumZenidbeOn"]), 'broj f sredina w50','float: left;') . 
				Printanje::polje($postupak -> datumZenidbeTop, $postupak -> pitanjaOnaLeft, Alati::datum($_POST["datumZenidbeOna"]), 'broj f sredina w50','float: left;') .
				Printanje::polje($postupak -> stanovanjeTop, $postupak -> pitanjaOnLeft, $_POST['stanovanjeOn'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> stanovanjeTop, $postupak -> pitanjaOnaLeft, $_POST['stanovanjeOna'], 'f sredina w50','float: left;') .
				Printanje::polje($postupak -> mjestoIDatumPitanjaTop, $postupak -> mjestoPitanjaLeft, $_POST['mjestoPitanja'], 'f sredina w50','float: left;') . 
				Printanje::polje($postupak -> mjestoIDatumPitanjaTop, $postupak -> datumPitanjaLeft, Alati::datum($_POST["datumPitanja"]), 'broj f','float: left;');
		break;

	case '3' :
		$polozaj = array(1.2,0.5);
		$html =	Printanje::polje($postupak -> navjestajGdjeTop, $postupak -> napomeneLeft, $_POST['navjestajGdje'], 'f w100','',50) . 
				Printanje::polje($postupak -> navjestajKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["navjestajKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> oprostKojaTop, $postupak -> napomeneLeft, $_POST['oprostKoja'], 'f w100','',50) . 
				Printanje::polje($postupak -> oprostDjeliteljTop, $postupak -> napomeneLeft, $_POST['oprostDjelitelj'], 'f w100','',50) . 
				Printanje::polje($postupak -> oprostKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["oprostKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> dopustenjeKojeTop, $postupak -> napomeneLeft, $_POST['dopustenjeKoje'], 'f w100','',50) . 
				Printanje::polje($postupak -> dopustenjeDjeliteljTop, $postupak -> napomeneLeft, $_POST['dopustenjeDjelitelj'], 'f w100','',50) . 
				Printanje::polje($postupak -> dopustenjeKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["dopustenjeKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> ovlastTkoTop, $postupak -> napomeneLeft, $_POST['ovlastTko'], 'f w100','',50) . 
				Printanje::polje($postupak -> ovlastKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["ovlastKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> ovlastKakoTop, $postupak -> napomeneLeft, $_POST['ovlastKako'], 'f w100','',50) . 
				Printanje::polje($postupak -> otpusnicaTkoTop, $postupak -> napomeneLeft, $_POST['otpusnicaTko'], 'f w100','',50) . 
				Printanje::polje($postupak -> otpusnicaKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["otpusnicaKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> dopustenjeVanZupeTkoTop, $postupak -> napomeneLeft, $_POST['dopustenjeIzvanZupeTko'], 'f w100','',50) . 
				Printanje::polje($postupak -> dopustenjeVanZupeKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["dopustenjeIzvanZupeKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> sklopljenGdjeTop, $postupak -> napomeneLeft, $_POST['sklopljenGdje'], 'f w100','',50) . 
				Printanje::polje($postupak -> sklopljenKadaTop, $postupak -> napomeneLeft, Alati::datum($_POST["sklopljenKada"]), 'f broj w100','',null) .
				Printanje::polje($postupak -> pregledaoTkoTop, $postupak -> napomeneLeft, $_POST['pregledaoTko'], 'f w100','',50) . 
				Printanje::polje($postupak -> pregledaoMjestoIDatumTop, $postupak -> pregledaoMjestoIDatumLeft, $_POST['pregledaoMjestoIDatum'], 'f w80','',40);
		break;

	case '4' :
		$polozaj = array(1.4,0.2);	
		$html =	Printanje::polje($postupak -> zarucniciTop, $postupak -> zarucnikLeft, $_POST['zarucnik'], 'f w70 sredina','float: left',35) .
				Printanje::polje($postupak -> zarucniciTop, $postupak -> zarucnicaLeft, $_POST['zarucnica'], 'f w70 sredina','float: left',35) . 
				Printanje::polje($postupak -> vjencanjeTop, $postupak -> vjencanjeDatumLeft, Alati::datum($_POST["vjencanjeDatum"]), 'f','float: left',null) .
				Printanje::polje($postupak -> vjencanjeTop, $postupak -> vjencanjeCrkvaLeft, $_POST['crkvaVjencanja'], 'f w90 sredina','float: left',45) . 
				Printanje::polje($postupak -> zupaVjencanjaTop, $postupak -> zupaVjencanjaLeft, $_POST['zupaVjencanja'], 'f w160 sredina','',80) . 
				Printanje::polje($postupak -> sluzbenikTop, $postupak -> sluzbenikLeft, $_POST["sluzbenik"], 'f w140 sredina','',70) .
				Printanje::polje($postupak -> svjedok1Top, $postupak -> svjedociLeft, $_POST['svjedok1'], 'f w160 sredina','',80) . 
				Printanje::polje($postupak -> svjedok2Top, $postupak -> svjedociLeft, $_POST['svjedok2'], 'f w160 sredina','',80) . 
				Printanje::polje($postupak -> upisTop, $postupak -> upisSvezLeft, $_POST["upisSvez"], 'f w30 sredina','float: left',null) .
				Printanje::polje($postupak -> upisTop, $postupak -> upisStrLeft, $_POST['upisStr'], 'f w20 sredina','float: left',null) . 
				Printanje::polje($postupak -> upisTop, $postupak -> upisBrLeft, $_POST["upisBr"], 'f w25 sredina','float: left',null) .
				Printanje::polje($postupak -> upisMaticaKrstenihTop, $postupak -> upisMaticaKrstenihLeft, $_POST['upisMaticaKrstenih'], 'f w130 sredina','',65) . 
				Printanje::polje($postupak -> upisKnjigaTop, $postupak -> upisKnjigaLeft, $_POST['upisKnjiga'], 'f w130 sredina','',65) . 
				Printanje::polje($postupak -> upisKartotekaTop, $postupak -> upisKartotekaLeft, $_POST["upisKartoteka"], 'f w130 sredina','',65) .
				Printanje::polje($postupak -> poslanaObavijestOnTop, $postupak -> poslanaObavijestLeft, Alati::datum($_POST["poslanaObavijestOn"]), 'f broj','',null) . 
				Printanje::polje($postupak -> poslanaObavijestOnaTop, $postupak -> poslanaObavijestLeft, Alati::datum($_POST["poslanaObavijestOna"]), 'f broj','',null) .
				Printanje::polje($postupak -> maticniUredTop, $postupak -> maticniUredLeft, $_POST['maticniUred'], 'f w80 sredina','float: left',40) . 
				Printanje::polje($postupak -> maticniUredTop, $postupak -> vracenoUreduLeft, Alati::datum($_POST["vracenoUredu"]), 'f','float: left',null) .
				Printanje::polje($postupak -> potvrdaUpisaOnTop, $postupak -> potvrdaUpisaKadaLeft, Alati::datum($_POST["potvrdaUpisaOnKada"]), 'f broj','float: left',null) . 
				Printanje::polje($postupak -> potvrdaUpisaOnTop, $postupak -> potvrdaUpisaBrLeft, $_POST["potvrdaUpisaOnBr"], 'f broj w30 sredina','float: left',null) . 
				Printanje::polje($postupak -> potvrdaUpisaOnaTop, $postupak -> potvrdaUpisaKadaLeft, Alati::datum($_POST["potvrdaUpisaOnaKada"]), 'f broj','float: left',null) .
				Printanje::polje($postupak -> potvrdaUpisaOnaTop, $postupak -> potvrdaUpisaBrLeft, $_POST["potvrdaUpisaOnaBr"], 'f broj w30 sredina','float: left',null);
		break;
}

if($_GET["preview"]){//ako je u GETU preview onda postavi watermark sa parametrima iz switcha u vezi položaja
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . 'Str' . $_GET["stranica"] . '.jpg',0.65,array(210,296),$polozaj);
	$mpdf -> showWatermarkImage = true;
}

$mpdf -> WriteHTML($html);
$mpdf -> Output();
exit ;

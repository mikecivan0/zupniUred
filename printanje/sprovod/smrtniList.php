<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../sql/printanje/nadjiZupu.php'; //kreiraj objekt $zupa
include_once '../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php'; //kreiraj $objDokument sa podacima udaljenosti
include_once '../../sql/admin/printeri/nadjiPrinter.php'; //kreiraj objekt $printer
include_once '../../alati/Alati.php';
include_once '../../alati/Printanje.php';
//obj_ColumnToArrayToObj($objDokument,"udaljenosti"); //napravi objekt od dobivenih podataka iz stringa $objDokument>udaljenosti
//obj_ColumnToArrayToObj($zupa,"udaljenostiKrsniList"); //napravi objekt od dobivenih podataka iz stringa $zupa->udaljenostiKrsniList

//uključi alat za kreiranje pdf-a
include_once '../../alati/mpdf/mpdf.php';
//kreiraj istancu objekta
$mpdf=new mPDF('utf8','A4',12,'Arial',20,20,25.4,28,25.4,28);


//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$smrtniList = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.65,array(210,295),array(0,0));
	$mpdf -> showWatermarkImage = true;
}else{
	$smrtniList = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiSmrtniList")); //prilagodi udaljenosti unutar objekta
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$spolLeft = ($_POST["spol"]==0) ? $smrtniList -> spolLeftZ : $smrtniList -> spolLeftM;


//zadaj što da kreira


$html = Printanje::polje($smrtniList -> biskupijaTop, $smrtniList -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($smrtniList -> zupaTop, $smrtniList -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($smrtniList -> brojDokumentaTop, $smrtniList -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($smrtniList -> maticaTop, $smrtniList -> maticaLeft, $matica, 'f','',null) .
		Printanje::polje($smrtniList -> svezakZaGodStrBrTop, $smrtniList -> svezakLeft, $_POST["svezak"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList -> svezakZaGodStrBrTop, $smrtniList -> zaGodinuLeft, $_POST["zaGodinu"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList -> svezakZaGodStrBrTop, $smrtniList -> stranicaLeft, $_POST["stranica"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList -> svezakZaGodStrBrTop, $smrtniList -> brojLeft, $_POST["broj"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList -> datumSmrtiTop, $smrtniList -> columnPodatakaLeft, Alati::datum($_POST["datumSmrti"]), 'broj f','width: 555px;',null) .
		Printanje::polje($smrtniList -> mjestoSmrtiTop, $smrtniList -> columnPodatakaLeft, $_POST["mjestoSmrti"], 'f','width: 555px;',null) .		
		Printanje::polje($smrtniList -> imeTop, $smrtniList -> columnPodatakaLeft, $_POST["ime"], 'f w90','float: left; width: 300px;',null) .
		Printanje::polje($smrtniList -> spolTop, $spolLeft, '/', 'f','float: left; font-size: 2rem;',null) .		
		Printanje::polje($smrtniList -> prezimeTop, $smrtniList -> columnPodatakaLeft, $_POST["prezime"], 'f w90','width: 555px;',null) .
		Printanje::polje($smrtniList -> mjestoRodjenjaTop, $smrtniList -> columnPodatakaLeft, $_POST["mjestoRodjenja"], 'f','width: 555px;',null) .
		Printanje::polje($smrtniList -> datumRodjenjaTop, $smrtniList -> columnPodatakaLeft, Alati::datum($_POST["datumRodjenja"]), 'broj f','',null) .
		Printanje::polje($smrtniList -> jmbgTop, $smrtniList -> columnPodatakaLeft, $_POST["jmbg"], 'broj f','width: 555px;',null) .
		Printanje::polje($smrtniList -> suprugTop, $smrtniList -> columnPodatakaLeft, $_POST["supruznik"], 'f','width: 555px;',null) .		
		Printanje::polje($smrtniList -> otacTop, $smrtniList -> columnPodatakaLeft, $_POST["otac"], 'f','width: 555px;',null) .
		Printanje::polje($smrtniList -> majkaTop, $smrtniList -> columnPodatakaLeft, $_POST["majka"], 'f','width: 555px;',null) .
		Printanje::polje($smrtniList -> prebivalisteTop, $smrtniList -> columnPodatakaLeft, $_POST["prebivaliste"], 'f','width: 555px;',null) .		
		Printanje::polje($smrtniList -> potvrdjenTop, $smrtniList -> columnPodatakaLeft, $_POST["sakramenti"], 'f','width: 555px;',null) .
		Printanje::polje($smrtniList -> mjestoIDatumPokopaTop, $smrtniList -> columnPodatakaLeft, $_POST["mjestoIDatumPokopa"], 'f','width: 555px;',null) .
		Printanje::polje($smrtniList -> sluzbenikTop, $smrtniList -> columnPodatakaLeft, $_POST["sluzbenik"], 'f','width: 555px;',null) .
		Printanje::polje($smrtniList -> zabiljeskeTop, $smrtniList -> zabiljeskeLeft, Alati::removeTags($_POST["zabiljeske"],'p'), 'z','height: 90px; width: 555px;',null) .
		Printanje::polje($smrtniList -> datumTop, $smrtniList -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
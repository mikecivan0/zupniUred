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
	$smrtniList2 = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.65,array(210,296),array(1.3,0.9));
	$mpdf -> showWatermarkImage = true;
}else{
	$smrtniList2 = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiSmrtniList2")); //prilagodi udaljenosti unutar objekta
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$spolLeft = ($_POST["spol"]==0) ? $smrtniList2 -> spolLeftZ : $smrtniList2 -> spolLeftM;


//zadaj što da kreira


$html = Printanje::polje($smrtniList2 -> biskupijaTop, $smrtniList2 -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($smrtniList2 -> zupaTop, $smrtniList2 -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($smrtniList2 -> brojDokumentaTop, $smrtniList2 -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($smrtniList2 -> maticaTop, $smrtniList2 -> maticaLeft, $matica, 'f','',null) .
		Printanje::polje($smrtniList2 -> svezakZaGodStrBrTop, $smrtniList2 -> svezakLeft, $_POST["svezak"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList2 -> svezakZaGodStrBrTop, $smrtniList2 -> zaGodinuLeft, $_POST["zaGodinu"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList2 -> svezakZaGodStrBrTop, $smrtniList2 -> stranicaLeft, $_POST["stranica"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList2 -> svezakZaGodStrBrTop, $smrtniList2 -> brojLeft, $_POST["broj"], 'broj f w20','float: left;',null) .
		Printanje::polje($smrtniList2 -> datumSmrtiTop, $smrtniList2 -> columnPodatakaLeft, Alati::datum($_POST["datumSmrti"]), 'broj f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> mjestoSmrtiTop, $smrtniList2 -> columnPodatakaLeft, $_POST["mjestoSmrti"], 'f','width: 547px;',null) .		
		Printanje::polje($smrtniList2 -> imeTop, $smrtniList2 -> columnPodatakaLeft, $_POST["ime"], 'f w90','float: left; width: 547px;',null) .
		Printanje::polje($smrtniList2 -> spolTop, $spolLeft, '/', 'f','float: left; font-size: 2rem;',null) .		
		Printanje::polje($smrtniList2 -> prezimeTop, $smrtniList2 -> columnPodatakaLeft, $_POST["prezime"], 'f w90','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> datumRodjenjaTop, $smrtniList2 -> columnPodatakaLeft, Alati::datum($_POST["datumRodjenja"]), 'broj f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> mjestoRodjenjaTop, $smrtniList2 -> columnPodatakaLeft, $_POST["mjestoRodjenja"], 'f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> jmbgTop, $smrtniList2 -> columnPodatakaLeft, $_POST["jmbg"], 'broj f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> suprugTop, $smrtniList2 -> columnPodatakaLeft, $_POST["supruznik"], 'f','width: 547px;',null) .		
		Printanje::polje($smrtniList2 -> otacTop, $smrtniList2 -> columnPodatakaLeft, $_POST["otac"], 'f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> majkaTop, $smrtniList2 -> columnPodatakaLeft, $_POST["majka"], 'f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> potvrdjenTop, $smrtniList2 -> columnPodatakaLeft, $_POST["sakramenti"], 'f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> mjestoIDatumPokopaTop, $smrtniList2 -> columnPodatakaLeft, $_POST["mjestoIDatumPokopa"], 'f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> sluzbenikTop, $smrtniList2 -> columnPodatakaLeft, $_POST["sluzbenik"], 'f','width: 547px;',null) .
		Printanje::polje($smrtniList2 -> zabiljeskeTop, $smrtniList2 -> zabiljeskeLeft, Alati::removeTags($_POST["zabiljeske"],'p'), 'z','height: 90px; width: 547px;',null) .
		Printanje::polje($smrtniList2 -> datumTop, $smrtniList2 -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
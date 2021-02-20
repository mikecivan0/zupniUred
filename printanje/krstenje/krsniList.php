<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../sql/printanje/nadjiZupu.php'; //kreiraj objekt $zupa
include_once '../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php'; //kreiraj $objDokument sa podacima udaljenosti
include_once '../../sql/admin/printeri/nadjiPrinter.php'; //kreiraj objekt $printer
include_once '../../alati/Alati.php';
include_once '../../alati/Printanje.php';
//obj_ColumnToArrayToObj($objDokument,"udaljenosti"); //napravi objekt od dobivenih podataka iz stringa $objDokument>udaljenosti
//obj_ColumnToArrayToObj($zupa,"udaljenostiKrsniList"); //napravi objekt od dobivenih podataka iz stringa $printer->udaljenostiKrsniList

//uključi alat za kreiranje pdf-a
include_once '../../alati/mpdf/mpdf.php';
//kreiraj istancu objekta
$mpdf=new mPDF('utf8','A4',12,'Arial',20,20,25.4,28,25.4,28);

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$krsniList = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,297),array(0.8,0.5));
	$mpdf -> showWatermarkImage = true;
}else{
	$krsniList = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiKrsniList")); //prilagodi udaljenosti unutar objekta	
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$spolLeft = ($_POST["spol"]==0) ? $krsniList -> spolLeftZ : $krsniList -> spolLeftM;


//zadaj što da kreira
$html = Printanje::polje($krsniList -> biskupijaTop, $krsniList -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($krsniList -> zupaTop, $krsniList -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($krsniList -> brojDokumentaTop, $krsniList -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($krsniList -> maticaTop, $krsniList -> maticaLeft, $matica, 'f','',null) .
		Printanje::polje($krsniList -> svezakZaGodStrBrTop, $krsniList -> svezakLeft, $_POST["svezak"], 'broj f w20','float: left;',null) .
		Printanje::polje($krsniList -> svezakZaGodStrBrTop, $krsniList -> zaGodinuLeft, $_POST["zaGodinu"], 'broj f w20','float: left;',null) .
		Printanje::polje($krsniList -> svezakZaGodStrBrTop, $krsniList -> stranicaLeft, $_POST["stranica"], 'broj f w20','float: left;',null) .
		Printanje::polje($krsniList -> svezakZaGodStrBrTop, $krsniList -> brojLeft, $_POST["broj"], 'broj f w20','float: left;',null) .
		Printanje::polje($krsniList -> datumKrstenjaTop, $krsniList -> columnPodatakaLeft, Alati::datum($_POST["datumKrstenja"]), 'broj f','',null) .
		Printanje::polje($krsniList -> imeTop, $krsniList -> columnPodatakaLeft, $_POST["ime"], 'f w90','float: left;',null) .
		Printanje::polje($krsniList -> spolTop, $spolLeft, '/', 'f','float: left; font-size: 2rem;',null) .
		Printanje::polje($krsniList -> prezimeTop, $krsniList -> columnPodatakaLeft, $_POST["prezime"], 'f w90','',null) .
		Printanje::polje($krsniList -> datumRodjenjaTop, $krsniList -> columnPodatakaLeft, Alati::datum($_POST["datumRodjenja"]), 'broj f','',null) .
		Printanje::polje($krsniList -> mjestoRodjenjaTop, $krsniList -> columnPodatakaLeft, $_POST["mjestoRodjenja"], 'f','',null) .
		Printanje::polje($krsniList -> jmbgTop, $krsniList -> columnPodatakaLeft, $_POST["jmbg"], 'broj f','',null) .
		Printanje::polje($krsniList -> otacTop, $krsniList -> columnPodatakaLeft, $_POST["otac"], 'f','',null) .
		Printanje::polje($krsniList -> majkaTop, $krsniList -> columnPodatakaLeft, $_POST["majka"], 'f','',null) .
		Printanje::polje($krsniList -> roditeljiVjencaniTop, $krsniList -> columnPodatakaLeft, $_POST["roditeljiVjencani"], 'f w90','',null) .
		Printanje::polje($krsniList -> prebivalisteTop, $krsniList -> columnPodatakaLeft, $_POST["prebivaliste"], 'f','',null) .
		Printanje::polje($krsniList -> kumTop, $krsniList -> columnPodatakaLeft, $_POST["kum"], 'f','',null) .
		Printanje::polje($krsniList -> krstiteljTop, $krsniList -> columnPodatakaLeft, $_POST["krstitelj"], 'f','',null) .
		Printanje::polje($krsniList -> zabiljeskeTop, $krsniList -> zabiljeskeLeft, Alati::removeTags($_POST["zabiljeske"],'p'), 'z','height: 90px; width: 555px;',null) .
		Printanje::polje($krsniList -> datumTop, $krsniList -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

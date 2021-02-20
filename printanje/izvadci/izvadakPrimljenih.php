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
	$izvadakPrimljenih = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,296),array(0.8,0.5));
	$mpdf -> showWatermarkImage = true;
}else{
	$izvadakPrimljenih = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiIzvadakPrimljenih")); //prilagodi udaljenosti unutar objekta	
}

//kako je spolLeft promjenjiv ovisno o dobijenoj vrijednosti treba ga posebno obraditi
$spolLeft = ($_POST["spol"]==0) ? $izvadakPrimljenih -> spolLeftZ : $izvadakPrimljenih -> spolLeftM;


//zadaj što da kreira
$html = Printanje::polje($izvadakPrimljenih -> biskupijaTop, $izvadakPrimljenih -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($izvadakPrimljenih -> zupaTop, $izvadakPrimljenih -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($izvadakPrimljenih -> brojDokumentaTop, $izvadakPrimljenih -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($izvadakPrimljenih -> maticaTop, $izvadakPrimljenih -> maticaLeft, $matica, 'f','',null) .
		Printanje::polje($izvadakPrimljenih -> svezakZaGodStrBrTop, $izvadakPrimljenih -> svezakLeft, $_POST["svezak"], 'broj f w20 sredina','float: left;',null) .
		Printanje::polje($izvadakPrimljenih -> svezakZaGodStrBrTop, $izvadakPrimljenih -> zaGodinuLeft, $_POST["zaGodinu"], 'broj f w20 sredina','float: left;',null) .
		Printanje::polje($izvadakPrimljenih -> svezakZaGodStrBrTop, $izvadakPrimljenih -> stranicaLeft, $_POST["stranica"], 'broj f w17 sredina','float: left;',null) .
		Printanje::polje($izvadakPrimljenih -> svezakZaGodStrBrTop, $izvadakPrimljenih -> brojLeft, $_POST["broj"], 'broj f w15 sredina','float: left;',null) .
		Printanje::polje($izvadakPrimljenih -> datumPrimanjaTop, $izvadakPrimljenih -> columnPodatakaLeft, Alati::datum($_POST["datumPrimanja"]), 'broj f','',null) .
		Printanje::polje($izvadakPrimljenih -> imePrezZanimanjeTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["imePrezimeZanimanje"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> datumRodjenjaTop, $izvadakPrimljenih -> columnPodatakaLeft, Alati::datum($_POST["datumRodjenja"]), 'broj f','float: left;',null) .
		Printanje::polje($izvadakPrimljenih -> spolTop, $spolLeft, '/', 'f','float: left; font-size: 2rem;',null) .		
		Printanje::polje($izvadakPrimljenih -> mjestoRodjenjaTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["mjestoRodjenja"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> otacTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["otac"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> majkaTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["majka"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> zajednicaTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["zajednica"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> mjestoIDatumTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["mjestoIDatum"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> svjedok1Top, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["svjedok1"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> svjedok2Top, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["svjedok2"], 'f w100','',null) .
		Printanje::polje($izvadakPrimljenih -> primateljTop, $izvadakPrimljenih -> columnPodatakaLeft, $_POST["primatelj"], 'f','',null) .
		Printanje::polje($izvadakPrimljenih -> napomeneTop, $izvadakPrimljenih -> napomeneLeft, Alati::removeTags($_POST["napomene"],'p'), 'z','height: 90px; width: 555px;',null) .
		Printanje::polje($izvadakPrimljenih -> datumTop, $izvadakPrimljenih -> datumLeft, Alati::datum($_POST["datum"]), 'broj f sredina','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

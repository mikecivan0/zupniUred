<?php
include_once '../../config/conf.php';
include_once '../../kontrole/dozvola.php';
include_once '../../sql/printanje/nadjiZupu.php'; //kreiraj objekt $zupa
include_once '../../sql/admin/udaljenosti/osnovno/nadjiUdaljenosti.php'; //kreiraj $objDokument sa podacima udaljenosti
include_once '../../sql/admin/printeri/nadjiPrinter.php'; //kreiraj objekt $printer
include_once'../../alati/Alati.php';
include_once'../../alati/Printanje.php';
//obj_ColumnToArrayToObj($objDokument,"udaljenosti"); //napravi objekt od dobivenih podataka iz stringa $objDokument>udaljenosti
//obj_ColumnToArrayToObj($zupa,"udaljenostiVjencaniList"); //napravi objekt od dobivenih podataka iz stringa $zupa->udaljenostiKrsniList

//uključi alat za kreiranje pdf-a
include_once '../../alati/mpdf/mpdf.php';
//kreiraj istancu objekta

$mpdf=new mPDF('utf8','A4',12,'Arial',20,20,25.4,28,25.4,28);

//ako treba preview tada se učitavaju položaji polja samo iz tablice dokumenti, a ako treba printati onda se zbrajaju i vrijednosti za odabrani printer
if($_GET["preview"]){
	$vjencaniList = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.55,array(210,296),array(1.4,0.5));
	$mpdf -> showWatermarkImage = true;
}else{
	$vjencaniList = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiVjencaniList")); //prilagodi udaljenosti unutar objekta
}



//zadaj što da kreira
$html = Printanje::polje($vjencaniList -> biskupijaTop, $vjencaniList -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($vjencaniList -> zupaTop, $vjencaniList -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($vjencaniList -> brojDokumentaTop, $vjencaniList -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($vjencaniList -> maticaTop, $vjencaniList -> maticaLeft, $matica, 'f','',null) .
		Printanje::polje($vjencaniList -> svezakZaGodStrBrTop, $vjencaniList -> svezakLeft, $_POST["svezak"], 'broj f w20','float: left;',null) .
		Printanje::polje($vjencaniList -> svezakZaGodStrBrTop, $vjencaniList -> zaGodinuLeft, $_POST["zaGodinu"], 'broj f w20','float: left;',null) .
		Printanje::polje($vjencaniList -> svezakZaGodStrBrTop, $vjencaniList -> stranicaLeft, $_POST["stranica"], 'broj f w20','float: left;',null) .
		Printanje::polje($vjencaniList -> svezakZaGodStrBrTop, $vjencaniList -> brojLeft, $_POST["broj"], 'broj f w20','float: left;',null) .
		Printanje::polje($vjencaniList -> datumVjencanjaTop, $vjencaniList -> columnPodatakaLeftOn, Alati::datum($_POST["datumVjencanja"]), 'broj f','',null) .
		Printanje::polje($vjencaniList -> imeTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['imeOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> imeTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['imeOna'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> prezimeTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['prezimeOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> prezimeTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['prezimeOna'], 'f w47','float: left;') .		
		Printanje::polje($vjencaniList -> mjestoRodjenjaTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['mjestoRodjenjaOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> mjestoRodjenjaTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['mjestoRodjenjaOn'], 'f w47','float: left;') .
		Printanje::polje($vjencaniList -> datumRodjenjaTop, $vjencaniList -> columnPodatakaLeftOn, Alati::datum($_POST["datumRodjenjaOn"]), 'broj f w47','float: left;',null) . 
		Printanje::polje($vjencaniList -> datumRodjenjaTop, $vjencaniList -> columnPodatakaLeftOna, Alati::datum($_POST["datumRodjenjaOna"]), 'broj f w47','float: left;',null) .		
		Printanje::polje($vjencaniList -> jmbgTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['jmbgOn'], 'f w47','float: left;',null) . 
		Printanje::polje($vjencaniList -> jmbgTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['jmbgOna'], 'f w47','float: left;',null) .
		Printanje::polje($vjencaniList -> vjeraTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['vjeraOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> vjeraTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['vjeraOna'], 'f w47','float: left;') .
		Printanje::polje($vjencaniList -> datumKrstenjaTop, $vjencaniList -> columnPodatakaLeftOn, Alati::datum($_POST["datumKrstenjaOn"]), 'broj f w47','float: left;',null) . 
		Printanje::polje($vjencaniList -> datumKrstenjaTop, $vjencaniList -> columnPodatakaLeftOna, Alati::datum($_POST["datumKrstenjaOna"]), 'broj f w47','float: left;',null) .
		Printanje::polje($vjencaniList -> zupaKrstenjaTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['zupaKrstenjaOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> zupaKrstenjaTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['zupaKrstenjaOna'], 'f w47','float: left;') .		
		Printanje::polje($vjencaniList -> otacTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['otacOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> otacTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['otacOna'], 'f w47','float: left;') .
		Printanje::polje($vjencaniList -> majkaTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['majkaOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> majkaTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['majkaOna'], 'f w47','float: left;') .		
		Printanje::polje($vjencaniList -> svjedokTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['svjedokOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> svjedokTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['svjedokOna'], 'f w47','float: left;') .
		Printanje::polje($vjencaniList -> vjencateljTop, $vjencaniList -> columnPodatakaLeftOn, $_POST['vjencateljOn'], 'f w47','float: left;') . 
		Printanje::polje($vjencaniList -> vjencateljTop, $vjencaniList -> columnPodatakaLeftOna, $_POST['vjencateljOna'], 'f w47','float: left;') .
		Printanje::polje($vjencaniList -> zabiljeskeTop, $vjencaniList -> zabiljeskeLeft, Alati::removeTags($_POST["zabiljeske"],'p'), 'z','width: 539px;',null) .
		Printanje::polje($vjencaniList -> datumTop, $vjencaniList -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

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
	$dopustenje = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,296),array(0,0.9));
	$mpdf -> showWatermarkImage = true;
}else{
	$dopustenje = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiDopustenje")); //prilagodi udaljenosti unutar objekta	
}

//potrebno razbiti string jer se možda treba ispisivati u dva reda sa različitim pozicijama pa se koristi funkcija splitOnTwo


//zadaj što da kreira
$html = Printanje::polje($dopustenje -> biskupijaTop, $dopustenje -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($dopustenje -> zupaTop, $dopustenje -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($dopustenje -> brojDokumentaTop, $dopustenje -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .
		Printanje::polje($dopustenje -> zarucnikTop, $dopustenje -> zarucnikLeft, $_POST["zarucnik"], 'f w120','',null) .
		Printanje::polje($dopustenje -> datumIMjesto1OnTop, $dopustenje -> datumRodjenjaLeft, Alati::datum($_POST["datumRodjenjaOn"]), 'f w50','float: left;',null) .
		Printanje::polje($dopustenje -> datumIMjesto1OnTop, $dopustenje -> mjesto1Left, Alati::splitOnTwo($_POST["mjestoOn"],35)[0], 'f w80 sredina','float: left;',null) .
		Printanje::polje($dopustenje -> mjesto2OnTop, $dopustenje -> mjesto2Left, Alati::splitOnTwo($_POST["mjestoOn"],35)[1], 'f w80 sredina','float: left;',null) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["ulicaOn"], $dopustenje -> mjesto2OnTop,28), $dopustenje -> ulicaLeft, $_POST["ulicaOn"], 'f w53 sredina','float: left;',29) .
		Printanje::polje($dopustenje -> mjesto2OnTop, $dopustenje -> brojLeft, $_POST["brojOn"], 'f w20 sredina','',null) .		
		Printanje::polje($dopustenje -> zarucnicaTop, $dopustenje -> zarucnicaLeft, $_POST["zarucnica"], 'f w150','',null) .
		Printanje::polje($dopustenje -> datumIMjesto1OnaTop, $dopustenje -> datumRodjenjaLeft, Alati::datum($_POST["datumRodjenjaOna"]), 'f w50','float: left;',null) .
		Printanje::polje($dopustenje -> datumIMjesto1OnaTop, $dopustenje -> mjesto1Left, Alati::splitOnTwo($_POST["mjestoOna"],35)[0], 'f w80 sredina','float: left;',null) .
		Printanje::polje($dopustenje -> mjesto2OnaTop, $dopustenje -> mjesto2Left, Alati::splitOnTwo($_POST["mjestoOna"],35)[1], 'f w80 sredina','float: left;',null) .
		Printanje::polje(Alati::prilagodiVisinu($_POST["ulicaOna"], $dopustenje -> mjesto2OnaTop,28), $dopustenje -> ulicaLeft, $_POST["ulicaOna"], 'f w53 sredina','float: left;',29) .
		Printanje::polje($dopustenje -> mjesto2OnaTop, $dopustenje -> brojLeft, $_POST["brojOna"], 'f w20 sredina','',null) .		
		Printanje::polje($dopustenje -> datumTop, $dopustenje -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

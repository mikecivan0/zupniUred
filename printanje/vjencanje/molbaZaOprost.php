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
	$molbaZaOprost = Alati::dodajMM($objDokument,"udaljenosti");
	$mpdf -> SetWatermarkImage('../../img/predlosci/' . basename($_SERVER['PHP_SELF'],'.php') . '.jpg',0.6,array(210,296),array(0.8,0.4));
	$mpdf -> showWatermarkImage = true;
}else{
	$molbaZaOprost = Alati::prilagodiUdaljenosti(Alati::obj_ColumnToArrayToObj($objDokument,"udaljenosti"), Alati::obj_ColumnToArrayToObj($printer,"udaljenostiMolbaZaOprost")); //prilagodi udaljenosti unutar objekta	
}

//zadaj što da kreira
$html = Printanje::polje($molbaZaOprost -> biskupijaTop, $molbaZaOprost -> biskupijaLeft, Alati::oduzmiZadnjuRijec($biskupija), 'f','',null) .
		Printanje::polje($molbaZaOprost -> zupaTop, $molbaZaOprost -> zupaLeft, $podaciZupe, 'f', Alati::odrediFont($podaciZupe),null) .
		Printanje::polje($molbaZaOprost -> brojDokumentaTop, $molbaZaOprost -> brojDokumentaLeft, $_POST["brojDokumenta"], 'broj f w50','',null) .		
		Printanje::polje($molbaZaOprost -> ordinarijatTop, $molbaZaOprost -> ordinarijatLeft, $_POST["ordinarijat"], 'f w75 sredina','',null) .
		Printanje::polje($molbaZaOprost -> katolikTop, $molbaZaOprost -> imeIPrezimeLeft, $_POST["imeIPrezimeKatolik"], 'f w100 sredina','',null) .
		Printanje::polje($molbaZaOprost -> nekatolikTop, $molbaZaOprost -> imeIPrezimeLeft, $_POST["imeIPrezimeNekatolik"], 'f w100 sredina','',null) .
		Printanje::polje($molbaZaOprost -> razlogTop, $molbaZaOprost -> razlogLeft, $_POST["razlog"], 'f w160 lh9','',null) .		
		Printanje::polje($molbaZaOprost -> datumTop, $molbaZaOprost -> datumLeft, Alati::datum($_POST["datum"]), 'broj f','',null);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

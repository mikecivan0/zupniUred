<?php
if(!isset($_GET["id"])){
	header('location: ../../predlosci.php');
}
include_once '../../config/conf.php';
include_once '../../kontrole/isLogged.php';
include_once '../../sql/financije/nadjiZupu.php';

if (empty($zupa)) { //ako se pokuša mijenjati get[id] na župu u kojoj se nije župnik onda ga izbaci van
	session_destroy();
	header("location: ../../auth/prijava.php");
}
$datumNoveTransakcije = (isset($_COOKIE["datumNoveTransakcije"])) ? $_COOKIE["datumNoveTransakcije"] : date("Y-m-d") ;
include_once '../../alati/Html.php';
include_once '../../alati/Alati.php';
include_once '../../klase/SQL.php';
include_once '../../alati/Financije.php';
include_once '../../sql/financije/dnevnici/nadjiGodineZaCrveni.php';
include_once '../../sql/financije/dnevnici/nadjiTransakcijeZaCrveni.php';
include_once '../../sql/financije/dnevnici/dohvatiSvrheZaCrveni.php';
include_once '../../sql/financije/dnevnici/stanjeSaPrethodneStraniceZaCrveni.php';
$title = 'Crveni blagajnički dnevnik';
$bodyClass = "papinskaZastava";
$ukupnoA = 0.00;
$ukupnoC = 0.00;
$count = 0;	
$broj = 0;
$footerScript .= '<script src="' . $putanjaApp . 'js/cookie.js"></script>
				  <script src="' . $putanjaApp . 'js/financije/dnevnici/dnevnik.js"></script>';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php'; 
?>

<div class="row mt40">
	<div class="large-1 columns large-centered">		
		<a href="#" data-reveal-id="modal">
			<img src="<?= $putanjaApp ?>img/admin/new.png" alt="nova" />		
		</a>
	</div>
</div>	
<div class="row mt40">	
	<div id="popis" class="large-2 columns">
	<?php
	 	if(!empty($godine)): ?>
				<li class="lsNone mb15 pt25"><u>Filter</u></li>
				<ul>			
					<?php
						foreach ($godine as $godina){
						$godineIMjeseci = new Financije;
						$mjeseci = $godineIMjeseci->nadjiMjeseceZaCrveni($godina);	
						?>
							<li class="godina"><a <?= Financije::daLiJeGodina('class',$godina,$godinaTransakcije) ?>><?= $godina-> godina ?></a>
								<ul class="mjeseci" <?= Financije::daLiJeGodina('style',$godina,$godinaTransakcije) ?>>
								<?php foreach ($mjeseci as $mjesec): ?>
									<li>
										<a <?= Financije::daLiJeGodinaIMjesec($godina,$mjesec,$godinaTransakcije,$mjesecTransakcije) ?> href="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&godina=" . $godina-> godina . "&mjesec=" . $mjesec->mjesec ?>">
											<?= Financije::hrvMjesec($mjesec->mjesec) ?>
										</a>
									</li>								
								<?php endforeach; ?>
								</ul>
							</li>
					<?php } ?>
				</ul>
		<?php endif; ?>
	</div>
	<div class="large-10 columns">
		<form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&godina=" . $godinaTransakcije . "&mjesec=" . $mjesecTransakcije ?>" method="POST">
		<fieldset class="panel">
			<legend style="font-weight: normal; color: red;">
				Župa <?= $zupa->nazivZupe ?> - <b><?= strtolower(Alati::hrvMjesec($mjesecTransakcije)) ?> <?= $godinaTransakcije ?>.</b> godine		
			</legend>				
				<?php	
				echo (empty($transakcije)) ? Financije::pocetakTablice('Primitak A-1','Izdatak C-1') . Financije::krajTablice() : null; //ako nema podataka onda kreiraj početak tablice		
				foreach ($transakcije as $transakcija) {
					$count++;	
					$broj++;				
					($transakcija->grupa_id==1) ? $ukupnoA+=$transakcija -> iznos : $ukupnoC+=$transakcija -> iznos;
					$iznos = Alati::hrIznos(number_format($transakcija -> iznos , 2));
					echo ($count==1) ? Financije::pocetakTablice('Primitak A-1','Izdatak C-1') : null; //ako ima podataka onda kreiraj početak tablice ako je count 1
					$datum = Alati::datum($transakcija -> datum);						
					Financije::redUTablici($broj,$transakcija,$datum,$godinaTransakcije,$mjesecTransakcije,$iznos,$putanjaApp);
					if($count==24){//ako se dođe do kraja stranice
						//konvertiranje u hrv format iznosa
						Alati::prazniRedoviTablice(6, 7);
						Financije::zbrajanjeNaKrajuLista(Alati::hrIznos(number_format($ukupnoA , 2)), Alati::hrIznos(number_format($ukupnoC , 2)),
														 Alati::hrIznos(number_format($prosloStanjeA , 2)), Alati::hrIznos(number_format($prosloStanjeC , 2)), 
														 Alati::hrIznos(number_format($ukupnoA + $prosloStanjeA , 2)), Alati::hrIznos(number_format($ukupnoC + $prosloStanjeC , 2)));
						Alati::prazniRedoviTablice(2, 7);
						echo Financije::krajTablice();
						$count = 0;
						//pretakanje novih vrijednosti
						$prosloStanjeA = $ukupnoA + $prosloStanjeA;
						$prosloStanjeC = $ukupnoC + $prosloStanjeC;
						$ukupnoA = 0.00;
						$ukupnoC = 0.00;
					}
				}

				if($count!=24&&$count!=0){//ukoliko nema više redova a nije se popunio papir krairaj zbroj na kraju stranice
					Alati::prazniRedoviTablice(6, 7);
					Financije::zbrajanjeNaKrajuLista(Alati::hrIznos(number_format($ukupnoA , 2)), Alati::hrIznos(number_format($ukupnoC , 2)), 
													 Alati::hrIznos(number_format($prosloStanjeA , 2)), Alati::hrIznos(number_format($prosloStanjeC , 2)), 
													 Alati::hrIznos(number_format($ukupnoA + $prosloStanjeA , 2)), Alati::hrIznos(number_format($ukupnoC + $prosloStanjeC , 2)));
					Alati::prazniRedoviTablice(2, 7);
					echo Financije::krajTablice();
				}
			?>
			<div id="modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
			  <h5 id="modalTitle">Novi unos</h5>
			  <div class="row">
			  			<?= Html::Input(null, 'hidden', 'hfZupa_id', 'hfZupa_id',null,null,$_GET["id"]) ?>
			  			<?= Html::Input(null, 'hidden', 'hfMjesec', 'hfMjesec',null,null,$_GET["mjesec"]) ?>
			  			<?= Html::Input(null, 'hidden', 'hfGodina', 'hfGodina',null,null,$_GET["godina"]) ?>
						
						<div class="large-4 columns">
							<?= $select ?>							
						</div>
						<div class="large-3 columns">
							<?= Html::Input('Datum', 'date', 'datum', 'datum',null,null,$datumNoveTransakcije) ?>						
						</div>
						<div class="large-2 columns">
							<?= Html::InputSaGreskom($greske, 'iznos', 'Iznos', null, 'number') ?>
						</div>
						<div class="large-3 columns">
							<?= Html::Input('Napomena', 'text', 'napomena', 'napomena') ?>						
						</div>
						<div class="large-12 columns mt15">
							<?= Html::Submit('Unos', array('button','siroko'),array('id'=>'modalSubmit')) ?>						
						</div>
					</div>
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>					
		</form>	
		<div class="large-2 columns">
			<a target="_blank" id="printIcon" href="<?= $putanjaApp  . 'financije/ispis/crveni.php?id=' . $_GET['id'] . 
							'&godina=' . $godinaTransakcije . '&mjesec=' . $mjesecTransakcije . '&stranica=' ?>">
				<img id="printImg" class="mb100 mt40" id="print" src="<?= $putanjaApp ?>img/print.ico" alt="Ispis" />
			</a>
		</div>	
		<div class="large-2 columns pt40">
			<?= Html::Input('Broj stranice', 'text', 'stranica', 'stranica') ?>
			<?= Html::Input(null, 'hidden', 'hfPath', 'hfPath',null,null,$putanjaApp  . 'financije/ispis/crveni.php?id=' . $_GET["id"] . 
							'&godina=' . $godinaTransakcije . '&mjesec=' . $mjesecTransakcije . '&stranica=',null,false) ?>
		</div>	
		<div class="large-8 columns pt40">
			<span class="red">*upišite samo broj prve stranice ukoliko je mjesec podijeljen na više stranica</span>
		</div>		
		</fieldset>	
	</div>
</div>
		<?php 			
include_once '../../masters/masterBottom.php';
?>
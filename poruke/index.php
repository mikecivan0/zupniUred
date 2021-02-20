<?php
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
if (isset($_GET["poruka"])) {
	include_once '../sql/poruke/oznaciProcitanom.php';
}
include_once '../sql/poruke/nadjiPoruke.php';
//ovdje se dobija $poruke	ili $poruka ovisno da li se ide na popis poruka ili na detalje poruke
include_once '../alati/Html.php';
include_once '../alati/Alati.php';
include_once '../alati/ListaPoruka.php';
$title = 'Poruke';
if ($podaci -> razina < 3) {
	$bodyClass = "papinskaZastava";
	$pozadina = "polja";
} else {
	$bodyClass = "matrix";
	$pozadina = "crnaPozadina";
}
if (!isset($_GET["poruka"])) {
	$brojPoruka = count($poruke);
	//potrebno odrediti broj poruka na stranici radi straničenja
}
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div id="popis" class="large-2 columns">		
		<a href="nova.php" class="crnaSlova">
			<input type="button" value="Nova poruka"/>
		</a>
		<?php if($podaci->userId==3){?>
			<a href="novaObavijest.php" class="crnaSlova">
				<input class="mt15" type="button" value="Nova obavijest"/>
			</a>
		<?php } 
		
			 if(!empty($dopisnici)): ?>
			<li class="lsNone mb15 pt25"><a href="index.php">Sve poruke</a></li>
			<u>Poruke sa:</u>
			<ul>			
				<?php
					foreach ($dopisnici as $dopisnik): 
					?>
						<li>
							<a href="<?= $_SERVER["PHP_SELF"] . "?korisnik=" . $dopisnik -> dopisnikId ?>">
								<?php echo($dopisnik -> dopisnikId == 3) ? "administrator" : ListaPoruka::skrati($dopisnik -> dopisnik); ?>
							</a>
						</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="large-10 columns">		
		<?php if(!isset($_GET["poruka"])&&!empty($poruke)){ //izlistavnje poruka ako ih ima i ako se ne traži neka specifična poruka
				$footerScript .= '<script src="' . $putanjaApp . 'js/poruke/index.js"></script>';				
				?>
			<form action="index.php" method="POST">
				<table class="siroko tablicaPoruka">
					<thead>
						<tr class="h49">
							<td class="w34"><input class="m0" type="checkbox" id="sve" /></td>
							<td class="w180"><img class="h30" id="brisiPoruke" src="<?= $putanjaApp . "img/delete_message.png" ?>" style="display: none;"/></td>
							<td>
								<?php if($brojStranica!=1): ?>
									<ul class="pagination" role="menubar" aria-label="Pagination">
									  <?= Alati::prethodnaStranica() ?>
									  <?= Alati::sljedecaStranica($brojStranica) ?>
									</ul>
								<?php endif; ?>
							</td>
							<td class="text_desno"><?= Alati::brojPoruka($ukupniBrojPoruka -> ukupno, $offset, $brojPoruka) ?></td>
						</tr>
					</thead>
					<tbody>						
							<?php
								foreach ($poruke as $poruka): 	
									$por = new ListaPoruka($poruka,$podaci);
									$primatelj = $por->primatelj();
									$posiljatelj = $por->posiljatelj();							
							?>
									<tr <?= ($poruka -> procitano == 0) ? 'class="bold"' : null ?> id="<?= $poruka -> porukaId ?>">
										<td><input id="poruka" class="m0" type="checkbox" name="poruka[]" value="<?= $poruka -> porukaId ?>"/></td>
										<td class="poruka"><?= $posiljatelj . " -> " . $primatelj ?></td>
										<td class="poruka"><?= Alati::poruka($poruka -> poruka, 60) ?></td>
										<td class="poruka text_desno"><?= Alati::datumPoruke($poruka -> datum) ?></td>
									</tr>
							<?php endforeach; ?>					
					</tbody>
				</table>
			</form>
		<?php }

				//dio kada se klikne na poruku da bi ju se pročitalo
				if(isset($_GET["poruka"])){
					$footerScript .= '<script src="' . $putanjaApp . 'js/poruke/poruka.js"></script>';
				if($podaci -> razina < 3){					$backIkona = "pe-7s-back";
					$deleteMessageIkona = $putanjaApp . "img/delete_message.png";
				}else{
					$backIkona = "pe-7s-back-white";
					$deleteMessageIkona = $putanjaApp . "img/delete_message_white.png";
				}
			?>	
				<?= Html::Input(null, 'hidden', 'hfPoruka', 'hfPoruka', null, null, $_GET["poruka"], null, false) ?>
				<div class="row">
					<div class="large-1 columns">
						<a class="<?= $backIkona ?>" href="<?= $_SERVER['HTTP_REFERER'] ?>"></a>
					</div>
					<div class="large-1 columns end">
						<img id="brisiPoruku" src="<?= $deleteMessageIkona ?>" />
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<div class="panel">
							<div class="left fs08rem">Pošiljatelj: <b><?= $poruka -> posiljatelj ?></b></div>
							<div class="right fs08rem"><?= substr($poruka -> vrijeme,0,5) ?></div>
							<hr />
							<div><?= Alati::poruka($poruka -> poruka) ?></div>
						</div>
					</div>
				</div>
					
		
		<?php } ?>
		
	</div>
</div>
<?php
include_once '../masters/masterBottom.php';
?>
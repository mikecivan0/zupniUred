<?php
if(!isset($_GET["id"])&&!$_POST){
	header("location: index.php");
}else{	
include_once '../config/conf.php';
include_once '../kontrole/isLogged.php';
$olId = (!$_POST) ? $_GET["id"] : $_POST["hfOlId"];
if($_POST){
	include_once '../kontrole/obiteljskiListovi/promjena.php';
	if(empty($greske)){
		include_once '../sql/obiteljskiListovi/spremiPromjene.php';
	}
}
include_once '../klase/obiteljskiListovi/Clan.php';
include_once '../sql/obiteljskiListovi/nadjiOL.php';
$muzDisplay = (strlen($muz->id)==0) ? array('display'=>'none') : null;
$zenaDisplay = (strlen($zena->id)==0) ? array('display'=>'none') : null;
include_once '../alati/Html.php';
$footerScript .= '<script src="' . $putanjaApp . 'js/obiteljskiListovi/promjena.js"></script>';
$title = 'Obiteljski list obitelji ' . $ol->prezime;
$bodyClass = 'papinskaZastava';
include_once '../sql/formulari/dohvatiZupe.php';
include_once '../alati/Alati.php';
include_once '../masters/masterHead.php';
include_once '../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		
		<?php if(strlen($porukaOSpremanju)>0){
		?>
		<div id="porukaSpremanja" class="large-10 large-centered columns">
			<div data-alert="" class="alert-box alert round center">
				<?php echo $porukaOSpremanju; ?>
				<a href="" class="close">×</a>
			</div>
		</div>
		<?php } ?>

		<form method="POST" action="<?= $_SERVER["PHP_SELF"] . "?id=" . $olId ?>" class="mt40">	
			<fieldset class="polja">
				<legend><?= $title ?></legend>
				 <div class="row">
	                 <div class="large-8 columns end">
	                    	<h5><u>Označite župu čije podatke želite koristiti</u></h5>
	                    	<?php    					                	
							foreach ($zupe as $zupa): ?>							
									<input type="radio" name="zupa" id="zupa<?= $zupa -> id ?>" nazivZupe="<?= $zupa -> nazivZupe ?>" 
									value="<?= $zupa -> id ?>"
									<?= ($zupa_id==$zupa->id) ? "checked=\"checked\"" : null ?> />
									<?= $zupa -> nazivZupe . ", " . $zupa -> nazivMjesta ?>
									<br>   
							<?php endforeach; ?>
	                 </div>	                
            	 </div>
            	
				 <?= Html::Input(null, 'hidden', 'hfOlId', 'hfOlId', null, null, $olId, null, false) ?>
				 <?= Html::Input(null, 'hidden', 'ulogaId', 'ulogaId', null, null, null, null, false) ?> <!--za dodavanje novog člana-->
				
				<div class="row mt40 mb40">
					<div class="large-12 columns">
						<ul class="tabs" data-tab>
						  <li class="tab-title active"><a href="#osnovniPodaci">Osnovni podaci</a></li>
						  <li class="tab-title"><a href="#muzIZena">Muž i žena</a></li>
						  <li class="tab-title"><a href="#djeca">Djeca</a></li>
						  <li class="tab-title"><a href="#rodjaciIUkucani">Rođaci i ukućani</a></li>
						  <li class="tab-title"><a href="#biljeske">Bilješke</a></li>
						  <li class="tab-title"><a href="#luknaIDarovi">Lukna i darovi</a></li>
						</ul>
					</div>
				</div>
				<div class="tabs-content">
  					<div class="content active" id="osnovniPodaci">
				   		<?php
				   			include_once 'osnovniPodaci.php';
				   		?>
				    </div>
				    <div class="content" id="muzIZena">
						<?php
				   			include_once 'muzIZena.php';
				   		?>
				    </div>
				    <div class="content" id="djeca">
				    	<?php
				   			include_once 'djeca.php';
				   		?>				    	
				    </div>
				    <div class="content" id="rodjaciIUkucani">
						<?php
				   			include_once 'rodjaciIUkucani.php';
				   		?>	
				    </div>
				    <div class="content" id="biljeske">
						<?php
				   			Html::Textarea('Bilješke', 'biljeske', 'biljeske',array('h140','pt0'),null,$biljeske);
				   		?>
				    </div>
				     <div class="content" id="luknaIDarovi">
						<?php
				   			Html::Textarea('Lukna', 'lukna', 'lukna',array('h64','pt0'),null,$lukna);;
				   			Html::Textarea('Darovi', 'darovi', 'darovi',array('h64','pt0'),null,$darovi)
				   		?>
				    </div>
					
				 </div>
		
			 	<div class="row mb40 mt40">
					<div class="large-6 columns">
						<?= Html::Submit('Spremi', array('siroko', 'secondary', 'spremi', 'round', 'button')) ?>
					</div>
					<div class="large-6 columns">
						<?= Html::Button('Obriši obiteljski list', array('siroko', 'alert', 'spremi', 'round', 'button', 'brisanjeOL'),array("id"=>$_GET["id"])) ?>
					</div>
				</div>
			</fieldset>			
		</form>
		<?php 
			include_once 'modalNovogClana.php';
			include_once 'modalPretrazivanjaMatica.php';
		?>		
	</div>
</div>
<?php
include_once '../masters/masterBottom.php';
}
?>
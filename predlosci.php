<?php
include_once 'config/conf.php';
include_once 'kontrole/dozvola.php';
include_once 'alati/Alati.php';
$title = 'Predlošci';
$bodyClass = 'papinskaZastava';
include_once 'masters/masterHead.php';
include_once 'config/izbornik.php';
if(isset($_GET["poruke"])){ //provjeri ima li nepročitanih poruka pa ako ima izbaci swal
	include_once 'sql/poruke/provjeriPorukeZaSwal.php';
	if(!empty($porukeZaSwal)){
		$footerScript .= '<script src="' . $putanjaApp . 'js/poruke/obavijest.js"></script>';
	}	
}
?>
<div class="row">
	<?php
		if (isset($_GET["istek"])){ ?>
			<div class="large-8 large-centered mt40 columns">	
				<div data-alert="" class="alert-box alert radius center">
					<?= Alati::porukaIstekaLicence($_GET["istek"]) ?><a href="" class="close">×</a>
				</div>		
			</div>		
	<?php } ?> 
    <div class="large-12 columns plr0 mt15">
        <div class="center naslovniPanel">
           <h2 class="font">Izaberite predložak</h2>
        </div>
     </div>
</div>
      <div class="row mt15">
             <div class="large-9 large-centered columns">
                    <ul class="large-block-grid-1">		
						<?php
						   
						  //za svakisakrament nađi dostupne dokumente	
						  foreach($sakramenti as $sakrament): 
									$id=$sakrament->id;
						            $izraz = $veza->prepare("select * from vrsteDokumenata where sakrament_id=$id;");
									$izraz->execute();
									$dokumenti = $izraz->fetchAll(PDO::FETCH_OBJ);
						 ?>
						     <li class="panel">
						         <h5><u><?= $sakrament -> nazivSakramenta ?></u></h5>
						             <ul>
						                <?php 
						                    foreach ($dokumenti as $dokument): ?>
						                       <li><a href="<?= $putanjaApp . $dokument -> kontroler ?>"><?= $dokument -> nazivDokumenta ?></a></li>
						                <?php endforeach; ?>
						             </ul>
						     </li>
						   <?php endforeach; ?> 
					</ul>						
				</div>
		</div>
						    
<?php
include_once 'masters/masterBottom.php';
?>
<?php
include_once '../config/conf.php';
include_once '../kontrole/ifLogged.php'; //ako je korisnik već logiran prebaci ga na predlosci.php

if (isset($_GET["error"])){
	$_SESSION[$ida . "attempt"] = (!isset($_SESSION[$ida . "attempt"])) ? 2 : $_SESSION[$ida . "attempt"]-1;
}						
	
include_once '../alati/Html.php';
include_once '../alati/Alati.php';
$bodyClass = 'papinskaZastava';
include_once '../masters/masterHead.php';
$title = 'Prijava';
$username = (isset($_GET["username"])) ? $_GET["username"] : "";
?>
<div class="container-fluid mt80 pt80">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
				<div class="panel-body">				
					<?php if(!isset($_SESSION[$ida . "attempt"])||(isset($_SESSION[$ida . "attempt"])&&$_SESSION[$ida . "attempt"]>=1)):
							  if (isset($_GET["error"])){ ?>
								<div id="porukaGreske" class="alert alert-danger">
									<ul>								
										<?=	"<li>" . Alati::porukaPrijave($_GET["error"]) . "</li>"; ?>								
									</ul>
								</div>
							<?php } ?> 
						<form id="forma" class="form-horizontal" role="form" method="POST" action="autoriziraj.php">
							<div class="form-group">
								<label class="col-md-4 control-label">Korisničko ime</label>
								<div class="col-md-6">
									<?= Html::Input(null, 'text', 'username', 'username',array('form-control'),null,$username,array('autofocus'=>true),false) ?>
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-4 control-label">Lozinka</label>
								<div class="col-md-6 mb15">
									<?= Html::Input(null, 'password', 'password', 'password',array('form-control','mb0'),null,null,null,false) ?>
									<a target="_blank" href="../support/oporavak.php" class="fs08rem pl5">Zaboravljeno korisničko ime ili lozinka</a>
								</div>
	
							
								<div class="col-md-3 col-md-offset-6">
									<?= Html::Submit('Prijava', array('btn','btn-primary'),array('id'=>'gumb')) ?>
								</div>
							</div>				
						</form>
					<?php endif; ?>
					
					<?php if(isset($_SESSION[$ida . "attempt"])): ?>						
						<div class="mt40 objasnjenje">
							<?php 
								if($_SESSION[$ida . "attempt"]<1){
									$footerScript .= '<script src="' . $putanjaApp . 'js/admin/auth.js"></script>';
									echo '<div id="counter"></div>';
							 	}else{
									echo "Preostali broj pokušaja: " . $_SESSION[$ida . "attempt"];
							} ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>	


<?php
	include_once '../masters/masterBottom.php';
?>
<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Alati.php';
if(isset($_GET)&&isset($_GET["id"])){
	include_once '../../sql/admin/users/detalji.php';
}else{
	header('location: index.php');
}
$title = 'Detalji korisnika';
$bodyClass = 'matrix';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row mt40">
	<div class="large-12 columns">
		<fieldset class="crnaPozadina mb40">
			<legend>Detalji korisnika ***** <?= $user->username ?> *****</legend>
			<?php 
				echo "Ime i prezime: " . $user->ime . " " . $user->prezime . "<br />" . 
					 "Korisničko ime: " . $user->username . "<br />" . 
					 "Razina: " . $user->razina . "<br />" .
					 "Istek licence: " . Alati::datum($user->istekLicence) . "<br />";
			?>
		</fieldset>	
		<div class="row">
			<div class="large-6 columns">
				<a href="novi.php"><input class="button siroko" type="button" value="Novi korisnik" /></a>
			</div>
			<div class="large-6 columns">
				<a href="index.php"><input class="button siroko secondary" type="button" value="Pretraga i promjena korisnikâ" /></a>
			</div>
		</div>
		
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>
<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Brisanje korisnika';
$bodyClass = 'matrix';

if(isset($_POST["id"])){
include_once '../../sql/admin/users/obrisiUsera.php';
}

if(isset($_GET["id"])){
	
include_once '../../sql/admin/users/provjeriZaBrisanje.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-12 columns crnaPozadina">
		<?php if(!empty($ovlasti)): ?>
			<fieldset>
				<legend>Korisnik se ne može obrisati jer je povezan sa sljedećim župama:</legend>
				<ol>
				<?php foreach ($ovlasti as $ovlast) {
					echo "<li>" . $ovlast->nazivZupe . ", " . $ovlast->nazivMjesta . " " . $ovlast->pbr .  "</li>";
				} ?>
				</ol>
			</fieldset>
		<?php endif; 
			
			if(empty($ovlasti)){
				echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='POST'>";
				Html::Input(null, 'hidden', 'id', 'id',null,null,$_GET["id"],null,false);
				echo '<div class="row pt40">
						<div class="large-2 columns">
							<a  href="' . $_SERVER["HTTP_REFERER"] . '"><img src="' . $putanjaApp . 'img/admin/back.png" /></a>
						</div>
						<div class="large-6 columns">';
							Html::Submit('Obriši korisnika', array('siroko','round','alert','lh100'));
				echo 	'</div>
					 </div>
				
				</form>';
		}else{
				echo '<a class="left" href="' . $_SERVER["HTTP_REFERER"] . '"><img src="' . $putanjaApp . 'img/admin/back.png" /></a>';
			};	
			
}		
		?>
		
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>
<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Brisanje mjesta';
$bodyClass = 'matrix';
if(isset($_GET["id"])){
include_once '../../sql/admin/zupe/provjeriZaBrisanje.php';
}
if(isset($_POST["id"])){
include_once '../../sql/admin/zupe/obrisiZupu.php';
}
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-12 columns crnaPozadina">
		<?php if(!empty($users)): ?>
			<fieldset>
				<legend>Useri povezani sa ovom župom</legend>
				<ol>
				<?php foreach ($users as $user) {
					echo "<li>" . $user->username . "</li>";
				} ?>
				</ol>
			</fieldset>
		<?php endif; 
			 if(!empty($filijale)): ?>
			<fieldset>
				<legend>Sa ovom župom su povezane filijale</legend>
				<ul>
				<?php foreach ($filijale as $filijala) {
					echo "<li>" . $filijala->nazivMjesta . "</li>";
				} ?>
				</ul>
			</fieldset>
		<?php endif; 
		if(!empty($zupljani)): ?>
			<fieldset>
				<legend>Osobe povezane sa ovom župom</legend>
				<ul>
				<?php foreach ($zupljani as $osoba) {
					echo "<li>" . $osoba->ime . " " . $osoba->prezime . "</li>";
				} ?>
				</ul>
			</fieldset>
		<?php endif; 
		if(!empty($primljeno)): ?>
			<fieldset>
				<legend>Neke osobe su primile sakramente u ovoj župi</legend>				
			</fieldset>
		<?php endif; 
			if(empty($users)&&empty($filijale)&&empty($zupljani)&&empty($primljeno)){
				echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='POST'>";
						Html::Input(null, 'hidden', 'id', 'id',null,null,$_GET["id"],null,false);
				echo '<div class="row pt40">
						<div class="large-2 columns">
							<a  href="' . $_SERVER["HTTP_REFERER"] . '"><img src="' . $putanjaApp . 'img/admin/back.png" /></a>
						</div>
						<div class="large-6 columns">';
							Html::Submit('Obriši župu', array('siroko','round','alert','lh100'));
				echo 	'</div>
					 </div>
				
				</form>';
			}else{
				echo '<a class="left" href="' . $_SERVER["HTTP_REFERER"] . '"><img src="' . $putanjaApp . 'img/admin/back.png" /></a>';
			};		
		?>
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>
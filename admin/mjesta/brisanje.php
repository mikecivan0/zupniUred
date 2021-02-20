<?php
include_once '../../config/conf.php';
include_once '../../kontrole/isAdmin.php';
include_once '../../alati/Html.php';
$title = 'Brisanje mjesta';
$bodyClass = 'matrix';

if(isset($_POST["id"])){
include_once '../../sql/admin/mjesta/obrisiMjesto.php';
}

if(isset($_GET["id"])){
	
include_once '../../sql/admin/mjesta/provjeriZaBrisanje.php';
include_once '../../masters/masterHead.php';
include_once '../../config/izbornik.php';
?>
<div class="row">
	<div class="large-12 columns crnaPozadina">
		<?php
		
		if(empty($zupe)&&empty($filijale)&&empty($osobe)){
				echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='POST'>";
					  Html:: Input(null, 'hidden', 'id', 'id',null,null,$_GET["id"],null,false);
				echo '<div class="row pt40">
						<div class="large-2 columns">
							<a  href="' . $_SERVER["HTTP_REFERER"] . '"><img src="' . $putanjaApp . 'img/admin/back.png" /></a>
						</div>
						<div class="large-6 columns">';
							Html::Submit('Obriši mjesto', array('sioko', 'round', 'alert', 'lh100'));
				echo 	'</div>
					 </div>
				
				</form>';
		}else{
			//početak grida ako ima podataka
			echo '<div class="row pt40">
						<div class="large-2 columns">
							<a class="left" href="' . $_SERVER["HTTP_REFERER"] . '"><img src="' . $putanjaApp . 'img/admin/back.png" /></a>				
						</div>
						<div class="large-10 columns">';
		
			
			 if(!empty($zupe)): ?>
			<fieldset>
				<legend>Župe povezane sa ovim mjestom</legend>
				<ol>
				<?php foreach ($zupe as $zupa) {
					echo "<li>" . $zupa->nazivZupe . "</li>";
				} ?>
				</ol>
			</fieldset>
		<?php endif; 
			 if(!empty($filijale)): ?>
			<fieldset>
				<legend>Ovo mjesto je filijala u župi</legend>
				<ul>
				<?php foreach ($filijale as $filijala) {
					echo "<li>" . $filijala->nazivZupe . "</li>";
				} ?>
				</ul>
			</fieldset>
		<?php endif; 
		if(!empty($osobe)): ?>
			<fieldset>
				<legend>Osobe povezane sa ovim mjestom</legend>
				<ul>
				<?php foreach ($osobe as $osoba) {
					echo "<li>" . $osoba->ime . " " . $osoba->prezime . "</li>";
				} ?>
				</ul>
			</fieldset>
		<?php endif; 
		
	//kraj grida ako ima podataka
	echo '</div>
		</div>';
		};	
			
}		
		?>
		
	</div>
</div>

<?php
	include_once '../../masters/masterBottom.php';
?>
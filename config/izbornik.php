<?php
if (!isset($dozvola) || $dozvola != "da") {
	exit ;
}
?>

<div class="row">
  <div class="large-12 columns">
    <div class="sticky">
  <nav class="top-bar" data-topbar="" role="navigation" data-options="sticky_on: large">
  <ul class="title-area" style="line-height: 1.3;">
    <!-- Title Area -->
		<li class="name pl5">
			<?php  
				if(isset($_SESSION[$ida . "autoriziran"])){
					if($_SESSION[$ida . "autoriziran"]->razina==3){
						$home = "admin/zupe/index.php";
					}else{
						$home = "predlosci.php";
					}
				}else{
					$home = "auth/prijava.php";
				}
			?>
			 <a class="pe-7s-home" href="<?= $putanjaApp . $home ?>"></a>
		</li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>


<section class="top-bar-section">
    <ul>
    	<?php
    	
    	//funkcije za kreiranje linkova
    	function activeLink($needle,$dodatak,$naslov){    
	  global $putanjaApp; 
	  $active = "";
      if(strpos($_SERVER['PHP_SELF'],$needle)>0) $active="active";
		      echo "<li class='" . $active . "'><a href='" . $putanjaApp . $needle . '/' . $dodatak . ".php'>" . $naslov . "</a></li>";
		} 
		
		function activeLinkIndex($needle,$naslov){    
			  global $putanjaApp; 
			  $active = "";
		      if(strpos($_SERVER['PHP_SELF'],$needle)>0) $active="active";
		      echo "<li class='" . $active . "'><a href='" . $putanjaApp . $needle . "'>" . $naslov . "</a></li>";
		} 
		
		
    	//ako nije prijavljen user ili ako mu je razina manja od 3
    	if(!isset($_SESSION[$ida . "autoriziran"])||(isset($_SESSION[$ida . "autoriziran"])&&$_SESSION[$ida . "autoriziran"]->razina<3)){
    	
		if(isset($_SESSION[$ida . "autoriziran"])&&$_SESSION[$ida . "autoriziran"]->razina==0){ //nađi sve župe određenog župnika
			$izbornikUserId = $_SESSION[$ida . "autoriziran"]->userId;
			$izraz = $veza -> prepare("select z.nazivZupe,zu.zupa_id from zupnici zu inner join zupe z on zu.zupa_id=z.id where zu.user_id=:id;");
			$izraz -> bindParam(":id", $izbornikUserId);
			$izraz -> execute();
			$izborZupa = $izraz -> fetchAll(PDO::FETCH_OBJ);
		}
									
    	//nađi sakramente ?>
    	<li class="has-dropdown">
           <a href="#">Printanje dokumenata</a>
           <ul class="dropdown">
    	<?php 
    	$izraz = $veza->prepare("select * from sakramenti where id!=2;");//daj sve osim pričesti
		$izraz->execute();
		$sakramenti = $izraz->fetchAll(PDO::FETCH_OBJ);
			//za svaki sakrament nađi dostupne dokumente	
            foreach($sakramenti as $sakrament): 				
            ?>
               <li class="has-dropdown">
                 <a href="#"><?= $sakrament -> nazivSakramenta ?></a>
                     <ul class="dropdown">
                         <?php
						$sakramentId = $sakrament -> id;
						$izraz = $veza -> prepare("select * from vrsteDokumenata where sakrament_id=$sakramentId;");
						$izraz -> execute();
						$dokumenti = $izraz -> fetchAll(PDO::FETCH_OBJ);
						foreach ($dokumenti as $dokument) {
							echo "<li><a href=\"" . $putanjaApp . $dokument -> kontroler . "\">" . $dokument -> nazivDokumenta . "</a></li>";
						}
 				?>
	                 </ul>
               </li>
             <?php endforeach; ?>
			</ul>
          </li>
          <?php 
         	 if(isset($_SESSION[$ida . "autoriziran"])&&$_SESSION[$ida . "autoriziran"]->razina==0){ ?>
          <li class="has-dropdown">
           <a href="#">Matične knjige</a>           
           <ul class="dropdown">
              <li><a href="<?= $putanjaApp ?>matice/maticaKrstenih/index.php">Matica krštenih +</a></li>
      		  <li><a href="<?= $putanjaApp ?>matice/maticaVjencanih/index.php">Matica vjenčanih</a></li>
              <li><a href="<?= $putanjaApp ?>matice/maticaUmrlih/index.php">Matica umrlih</a></li>
			</ul>
          </li>
          <li class="has-dropdown">
          	<a href="<?= $putanjaApp ?>obiteljskiListovi/index.php">Obiteljski listovi</a>
          	<ul class="dropdown">
          		<li><a href="<?= $putanjaApp ?>obiteljskiListovi/prebacivanje.php">Prebacivanje članova</a></li>
          	</ul>
          </li>
          <li class='has-dropdown'>
		  <a href='#'>Financije</a>
			<ul class='dropdown'>
				<?php 
					foreach ($izborZupa as $izborZupe) { ?>
						<li class='has-dropdown'>
						<a href='#'><?= $izborZupe->nazivZupe ?></a>
							<ul class='dropdown'>
								<li class='has-dropdown'>
									<a href='#'>Blagajnički dnevnici</a>
									<ul class='dropdown'>
										<li><a href='<?= $putanjaApp ?>financije/dnevnici/crveni.php?id=<?=  $izborZupe->zupa_id ?>'>Crveni</a></li>
										<li><a href='<?= $putanjaApp ?>financije/dnevnici/plavi.php?id=<?=  $izborZupe->zupa_id ?>'>Plavi</a></li>								
									</ul>
								</li>
								<li class='has-dropdown'>
									<a href='#'>Izvješća</a>
									<ul class='dropdown'>
										<li><a href='<?= $putanjaApp ?>financije/izvjesca/kvartalnoIzvjesce.php?id=<?=  $izborZupe->zupa_id ?>'>Kvartalno izvješće</a></li>
										<li><a href='<?= $putanjaApp ?>financije/izvjesca/godisnjeIzvjesce.php?id=<?=  $izborZupe->zupa_id ?>'>Godišnje izvješće</a></li>
									</ul>
								</li>
								<li class='has-dropdown'>
									<a href='#'>Postavke</a>
									<ul class='dropdown'>
										<li><a href='<?= $putanjaApp ?>financije/svrhe/svrhe.php?id=<?=  $izborZupe->zupa_id ?>'>Stavke dnevnika</a></li>
										<li><a href='<?= $putanjaApp ?>financije/stavke/stavke.php?id=<?=  $izborZupe->zupa_id ?>'>Stavke izvješća</a></li>
										<li><a href='<?= $putanjaApp ?>financije/kalkulacije/kalkulacije.php?id=<?=  $izborZupe->zupa_id ?>'>Kalkulacije</a></li>
										<li><a href='<?= $putanjaApp ?>financije/automatike/automatike.php?id=<?=  $izborZupe->zupa_id ?>'>Automatski unosi</a></li>
									</ul>
								</li>								
							</ul>
						</li>
				<?php } ?>
      	    </ul>
      	  </li>
             <?php
          }
			}else{
			activeLink('admin/mjesta','index','Mjesta');
			activeLink('admin/zupe','index','Župe');
			activeLink('admin/biskupije','index','Biskupije');
			activeLink('admin/osobe','index','Osobe');
			activeLink('admin/users','index','Korisnici');
			activeLink('admin/printeri','index','Printeri');
			activeLink('admin/logs','index','Logs');
			?>
			<li class="has-dropdown">
				<a href="#">Printanje</a>
				<ul class="dropdown">
					<li class="has-dropdown">
					<a href="#">Osnovni položaji (po dokumentima)</a>
						<ul class="dropdown">
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=1">Krsni list</a></li>						
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=2">Pristupnica za Svetu Potvrdu</a></li>						
							<li class="has-dropdown">
								<a href="#">Vjenčanje</a>
								<ul class="dropdown">									
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=3">Vjenčani list</a></li>												
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=4">Postupak za ženidbu</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=5">Otpusnica za vjenčanje</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=6">Dopuštenje za ženidbu izvan vlastite župe</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=7">Izjave i obećanja prigodom mješovite ženidbe</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=8">Molba za mješovitu ženidbu</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=9">Molba za oprost od zapreke različitosti vjere</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=10">Zapisnik o prijašnjoj ženidbenoj vezi ili izvanbračnoj zajednici</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=11">Izjava roditelja uz ženidbu njihova maloljetnika</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=12">Ženidbeni najvještaj u župi prebivališta</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=13">Obavijest o sklopljenoj ženidbi</a></li>						
								</ul>
							</li>								 	
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=14">Smrtni list</a></li>	
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=18">Smrtni list (verzija 2)</a></li>
							<li class="has-dropdown">
								<a href="#">Ostalo</a>
								<ul class="dropdown">									
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=15">Izvadak iz Knjige primljenih</a></li>	
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=17">Potvrdnica</a></li>	
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/osnovno.php?vrstaDokumenta=16">Posvjedočenje</a></li>	
								</ul>
							</li>													
						</ul>
					</li>
					<li class="has-dropdown">
					<a href="#">Personaliziranje položaja (po printerima)</a>
						<ul class="dropdown">
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=krsniList">Krsni list</a></li>
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=pristupnica">Pristupnica za Svetu Potvrdu</a></li>
							<li class="has-dropdown">
								<a href="#">Vjenčanje</a>
								<ul class="dropdown">																							
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=vjencaniList">Vjenčani list</a></li>												
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=postupak">Postupak za ženidbu</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=otpusnica">Otpusnica za vjenčanje</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=dopustenje">Dopuštenje za ženidbu izvan vlastite župe</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=izjave">Izjave i obećanja prigodom mješovivite ženidbe</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=molbaZaMjesovituZenidbu">Molba za mješovitu ženidbu</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=molbaZaOprost">Molba za oprost od zapreke različitosti vjere</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=zapisnik">Zapisnik o prijašnjoj ženidbenoj vezi ili izvanbračnoj zajednici</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=izjavaRoditelja">Izjava roditelja uz ženidbu njihova maloljetnika</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=navjestaj">Ženidbeni najvještaj u župi prebivališta</a></li>						
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=obavijest">Obavijest o sklopljenoj ženidbi</a></li>						
								</ul>
							</li>									 	
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=smrtniList">Smrtni list</a></li>										
							<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=smrtniList2">Smrtni list (verzija 2)</a></li>	
							<li class="has-dropdown">
								<a href="#">Ostalo</a>
								<ul class="dropdown">																							
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=izvadakPrimljenih">Izvadak iz Knjige primljenih</a></li>
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=potvrdnica">Potvrdnica</a></li>
									<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/poPrinterima.php?q=posvjedocenje">Posvjedočenje</a></li>
								</ul>
							</li>											
						</ul>
					</li>	
					<li><a href="<?= $putanjaApp ?>admin/postavke/udaljenosti/grupno.php">Uređivanje svih polja za određeni printer</a></li>								
				</ul>
				
			</li>		
			<li class="has-dropdown">
				<a href="#">Financije</a>
				<ul class="dropdown">				
					<li><a href="<?= $putanjaApp ?>admin/financije/grupe/grupe.php">Grupe</a></li>												
					<li><a href="<?= $putanjaApp ?>admin/financije/izvjesca/izvjesca.php">Izvješća</a></li>	
					<li><a href="<?= $putanjaApp ?>admin/financije/svrhe/svrhe.php">Stavke dnevnika</a></li>																							
					<li><a href="<?= $putanjaApp ?>admin/financije/stavke/stavke.php">Stavke izvješća</a></li>											
					<li><a href="<?= $putanjaApp ?>admin/financije/kalkulacije/kalkulacije.php">Kalkulacije</a></li>										
					<li><a href="<?= $putanjaApp ?>admin/financije/automatike/automatike.php">Automatski unosi</a></li>										
				</ul>				
			</li>		
	<?php } ?>
 					
    </ul>

    <!-- Right Nav Section -->
    <ul class="right">
    	<?php if(isset($_SESSION[$ida . "autoriziran"])): 
		//provjeri da li ima nepročitanih poruka
    		$izraz = $veza -> prepare("select count(id) as poruke from poruke where za=:id and procitano=0 and obrisano=0;");
			$izraz -> bindParam(":id", $podaci->userId);
			$izraz -> execute();
			$imaLiPoruka = $izraz -> fetch(PDO::FETCH_OBJ);
			//odredi boju ikone ovisno o rezulatatu i ako ima nepročitanih poruka učitaj .js za izmjenu boje ikone poruke
			$ikonaPoruke = (empty($imaLiPoruka->poruke)) ? $putanjaApp . "img/e_mail.png" : $putanjaApp . "img/e_mail_red.png"; 
			(!empty($imaLiPoruka->poruke)&&strpos($_SERVER["PHP_SELF"], '/poruke/index.php')==0) ? $footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/blinkMessage.js"></script>' : null; 		
    		?>
    			<li> 
    				<a class="transparent pr0" href="<?= $putanjaApp ?>poruke/index.php">
    					<img class="settings" id="ikonaPoruke" src="<?= $ikonaPoruke ?>" />
    				</a>
    			</li>
    			<li class="has-dropdown">
						<a class="postavke transparent"><img class="settings hand" src="<?= $putanjaApp ?>img/settings.png" /></a>					
						 <ul class="dropdown">
						 	<li><a href="<?= $putanjaApp ?>profil/osobniPodaci.php">Osobni podaci</a></li>
      						<li><a href="<?= $putanjaApp ?>profil/korisnickiPodaci.php">Korisnički račun</a></li>
      						<?php
      						if($_SESSION[$ida . "autoriziran"]->razina==0){ 
								//za svaku župu daj link
								echo "<li class='has-dropdown'>
									 	 <a href='#'>Podaci župe</a>
									 	 <ul class='dropdown'>";
											foreach ($izborZupa as $izborZupe) {
												echo "<li><a href='" . $putanjaApp . "profil/podaciZupe.php?id=" . $izborZupe->zupa_id . "'>" . $izborZupe->nazivZupe . "</a></li>";
											}
      							echo "</ul></li>";
								echo "<li><a href='" . $putanjaApp  . "profil/postavkeIspisa.php'>Postavke ispisa</a></li>";
								echo "<li><a href='" . $putanjaApp . "support/porukaAdminu.php'>Kontaktiraj administratora</a></li>";
								echo "<li style='padding-bottom: 10px !important;'>
										<a target='_blank' href='" . $putanjaApp . "manual.php'>
											<img style='width: 27px; height: 27px;' src='" . $putanjaApp . "img/manual.png' alt='manual'/>
											Korisnički priručnik
										</a>
									</li>";
								      							
							 }
							 
							 if($_SESSION[$ida . "autoriziran"]->razina==3){ ?>   							
								<!--<li>
									<a href="<?= $putanjaApp ?>admin/postavke/javniPristup/index.php">Javni pristup</a>
								</li>-->
								<li>
									<a href="<?= $putanjaApp ?>admin/postavke/inspect/index.php">Inspect element</a>
								</li>  							
      						<?php } ?>
						 </ul>						 
				</li>

		<?php endif; ?>	
      <li class="divider"></li>
      <?php if(isset($_SESSION[$ida . "autoriziran"])){ ?>
          <li><a class="pe-7s-power transparent" href="<?= $putanjaApp ?>auth/odjava.php"></a></li>
      <?php }else{ ?>
          <li class="pe-7s-door-lock transparent" href="<?= $putanjaApp ?>auth/prijava.php"></a></li>
      <?php } ?>
    </ul>


  </section>
  </nav>
</div>

</div>
</div>

<?php

include_once 'config/conf.php';
include_once 'kontrole/dozvola.php';
if(isset($_SESSION[$ida . "autoriziran"])){
	header('location: predlosci.php');
}
$title = 'Izbor načina rada';
include_once 'masters/masterHead.php';
?>
<div class="row">
        <div class="large-12 columns">
            <div class="center naslovniPanel">
                <h1 class="font">Ispis crkvenih dokumenata</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="large-12 columns center">
            <h3 class="fontArial mb15">Odaberite način rada</h3>
           <ul class="large-block-grid-2">
               <li class="odabirRadaSaBazom">
               	<a href="auth/prijava.php"><img src="img/database.jpg"/ alt="Baza"></a>
                 <p class="mt15"><b>Rad sa bazom</b></p>
                 <p>
                    <ul class="objasnjenje">
                        <li>-ispis dokumenata i spremanje podataka za kasnije korištenje</li>
                        <li>-ispis dokumenata osobama koje su <b>već unesene</b> kao župljani vaše župe</li>
                        <li>-ubrzava i olakšava popunjavanje podataka</li>
                        <li>-prilagođena pozicija polja kod ispisa</li>
                        <li>-potrebno je prijaviti se u sustav</li>
                    </ul>
                 </p>
               </li>
               <li class="odabirRadaBezBaze">
                  <a href="predlosci.php"><img src="img/nodatabase.jpg"/ alt="Bez baze"></a>
                  <p class="mt15"><b>Rad bez baze</b></p>
                  <p>
                     <ul class="objasnjenje">
                        <li>-ispis dokumenata bez spremanja podataka</li>
                        <li>-ispis dokumenata osobama koje <b>nisu unesene</b> kao župljani vaše župe</li>
                        <li>-potrebno ručno upisivanje podataka osobe(sporije)</li>
                        <li>-neprilagođena pozicija polja kod ispisa</li>
                        <li>-rad bez prijave u sustav</li>
                     </ul>
                  </p>
                </li>
            </ul>
            </div>
        </div>
    </div>
    
<?php
	include_once 'masters/masterBottom.php';
?>
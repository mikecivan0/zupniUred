<?phpinclude '../config.conf.php';
if(!$_POST){
	header("location: prijava.php?error=4"); //niste autorizirani za taj posao
}else{
	//ako nije upisano korisničko ime vrati ga natrag
	if(strlen(trim($_POST["username"]))<1){
		header("location: prijava.php?error=5"); //upišite korisničko ime
		
	}
	
	//ako nije upisano korisničko ime vrati ga natrag	
	if($_POST["password"]==""){
		header("location: prijava.php?error=3&username=" . $_POST["username"]);
		
	}
	
include '../config/conf.php';

//provjera podataka

//da li korisničko ime uopće postoji u bazi
$izraz = $veza -> prepare("select o.ime,o.prezime,o.mjestoPrebivanja,o.ulica,o.kucniBroj,o.jmbg,o.oib,o.email,
						   u.username, u.razina, u.aktivan, u.id as userId, u.password, u.osoba_id, u.istekLicence, u.rukopis
						   from users u inner join osobe o on u.osoba_id=o.id where u.username=:username");
	$izraz -> bindParam(':username', $_POST["username"]);
	$izraz -> execute();
	$korisnik = $izraz -> fetch(PDO::FETCH_OBJ);
	
	
//ako korisnik postoji onda provjeri da li lozinka odgovara
	if(!empty($korisnik)){
		if($korisnik->password!==md5($_POST["password"])){
			header("location: prijava.php?error=6&username=" . $_POST["username"]); //netočna lozinka
		}else{ //ako lozinka odgovara provjeri da li je aktivan ili ne
			if($korisnik->aktivan==1){ //ako je aktivan provjeri koja je razina
				if($korisnik->istekLicence!=null&&$korisnik->istekLicence<date("Y-m-d")){
					header("location: prijava.php?error=7&username=" . $_POST["username"]); //istekla licenca
				}else{
					unset($korisnik->password);
					if(isset($_SESSION[$ida . "attempt"])){
						unset($_SESSION[$ida . 'attempt']);
					}
					$_SESSION[$ida . "autoriziran"]=$korisnik;
					//ako je sve ok unesi prijavu
					
					$browser = (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') > 0) ? 'Firefox': 'Chrome';//odredi browser
	
					$izraz = $veza -> prepare("insert into prijave(user_id,browser,datum,vrijeme,tip) values(:userId,:browser,CURDATE(),CURTIME(),1);");
					$izraz -> bindParam(':userId', $korisnik->userId);
					$izraz -> bindParam(':browser', $browser);
					$izraz -> execute();					
					
					if($korisnik->razina==3){
						header("location: " . $putanjaApp . "admin/zupe/index.php");
					}else{
						if($korisnik->istekLicence!=null){
						//koliko dana je dana do isteka licence
						$now = time(); 
					    $istekLicence = strtotime($korisnik->istekLicence);
					    $razlika = $istekLicence - $now;
					    $dana_do_isteka= floor($razlika/(60*60*24)) + 1;
							if($dana_do_isteka<=15){
								$istek = "&istek=" . $dana_do_isteka;
							}
						}else{
							$istek = null;
						}
						header("location: " . $putanjaApp . "predlosci.php?poruke=check" . $istek);//poruka o skorom isteku licence
					}
				}			
				
			}else{
				header("location: prijava.php?error=1&username=" . $_POST["username"]);	//neaktivan korisnik
			}
		}
	}else{
		header("location: prijava.php?error=2&username=" . $_POST["username"]); //nepostojeći korisnik
	}
}

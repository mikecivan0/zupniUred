<div class="footer pl5 hide-for-small-only">
    <span>Powered by ЯedoC     &copy;2016-<?= date("Y") ?></span>
 </div>
<script src="<?= $putanjaApp ?>js/vendor/jquery.js"></script>
<script src="<?= $putanjaApp ?>js/foundation.min.js"></script>
<link rel="stylesheet" href="<?= $putanjaApp ?>css/jquery-ui.css" />
<script src="<?= $putanjaApp ?>js/tinymce/tinymce.min.js"></script>

<?php
	$footerScript .= ($postavke -> inspect == 0) ? '<script src="' . $putanjaApp . 'js/skripteStranica/inspect.js"></script>' : '';
	//dozvola za inspect element i desni klik
?>

<!--
mora se 2 puta učitati foundation() jer se
preklapaju skripte
-->
  	<script>
		$(document).foundation();		
    </script>   
	<script src="<?= $putanjaApp ?>js/jquery-ui.js"></script>	  
	<script src="<?= $putanjaApp ?>js/jquery-1.9.1.js"></script><!-- dodano radi bug-a sa označavanjem select-a kod uzastopnog autocompleta -->
	<script src="<?= $putanjaApp ?>js/jquery-ui.js"></script>	  <!-- mora se dva puta učitati da bi radio autocomplete -->
	<script src="<?= $putanjaApp ?>js/swal.js"></script>
  <?= $footerScript ?>
</body>
</html>

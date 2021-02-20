<?php
$footerScript .= '<script src="' . $putanjaApp . 'js/skripteStranica/drugiPrinter.js"></script>';
?>
<br />
<input type="checkbox" name="drugiPrinterSelect" id="drugiPrinterSelect" <?php if($_POST&&isset($_POST["drugiPrinterSelect"])){echo "checked='checked' value='" . $_POST["drugiPrinterSelect"] . "'";} ?>>
<label for="drugiPrinterSelect">Printanje u drugoj župi (ne u onoj koja je gore označena)</label>

<div id="izborDrugogPrintera" <?php if(!$_POST||($_POST&&!isset($_POST["drugiPrinterSelect"]))){echo "style='display: none;'";} ?>>
 <?= Html::Input('Upišite par slova iz naziva župe ili mjesta u kojem se župa nalazi, ili samo ime printera', 'text', 'drugiPrinter', 'drugiPrinter') ?>
</div>
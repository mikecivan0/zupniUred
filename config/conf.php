<?php

$mysql_host = "localhost";
$mysql_database = "database";
$mysql_user = "user";
$mysql_password = "pass";
$putanjaApp = "/";

//postavke osnovnih varijabli sustava da se ne mora stalno raditi if upit
$title = '';
$bodyClass = '';
$headScript = '';
$footerScript = '';
$legend = '';
$formId = '';
$postURL = '';
$odgovor = '';
$greske = array();
$porukaOSpremanju = "";
 /*Identifikacija aplikacije */
$ida="zupni-ured_";

/*
 * Naslov aplikacije
 */
 $naslovAPP="Župni ured";
 



//spajanje na bazu
$veza = new PDO("mysql:dbname=" . $mysql_database . ";host=" . $mysql_host . "", $mysql_user, $mysql_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));



session_start();	

if(isset($_SESSION[$ida . "autoriziran"])){
	$podaci = $_SESSION[$ida . "autoriziran"];
}

date_default_timezone_set('Europe/Zagreb');

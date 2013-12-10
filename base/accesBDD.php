<?php
session_start();
$hostname='infolimon'; //infolimon
$login='bexchauveto'; //login iut
$passwd='1105017183J'; // votre passwd
$base='bexchauveto'; //login iut
$connect = mysql_connect($hostname,$login,$passwd) or die ("erreur de connexion");
mysql_select_db($base,$connect) or die ("erreur de connexion base");
?>

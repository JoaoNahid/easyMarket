<?php
  $host = 'localhost';
  $user = 'root';
  $passwd = 'vertrigo';
  $bd = 'easyMarket';
  $connBDInterno = mysqli_connect($host, $user, $passwd, $bd);
	if(!$connBDInterno) {
		die('Falha ao conectar no servidor: ' . mysqli_error());
	}

	mysqli_query($connBDInterno, "SET SESSION sql_mode='';");
	mysqli_set_charset($connBDInterno, 'utf8');
	mysqli_query($connBDInterno, "SET NAMES 'utf8';");
	mysqli_query($connBDInterno, "SET CHARACTER SET 'utf8';");
	mysqli_query($connBDInterno, "SET COLLATION_CONNECTION = 'utf8_unicode_ci';");

	date_default_timezone_set('America/Sao_Paulo');
	setlocale(LC_TIME, 'portuguese');
?>

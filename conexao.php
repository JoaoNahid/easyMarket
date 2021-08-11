<?php
  $host = 'localhost';
  $user = 'root';
  $passwd = 'vertrigo';
  $bd = 'easymarketcliente';
  $conn = mysqli_connect($host, $user, $passwd, $bd);
  if(!$conn) {
    die('Falha ao conectar no servidor: ' . mysqli_error());
  }

  mysqli_query($conn, "SET SESSION sql_mode='';");
  mysqli_set_charset($conn, 'utf8');
  mysqli_query($conn, "SET NAMES 'utf8';");
  mysqli_query($conn, "SET CHARACTER SET 'utf8';");
  mysqli_query($conn, "SET COLLATION_CONNECTION = 'utf8_unicode_ci';");

  date_default_timezone_set('America/Sao_Paulo');
  setlocale(LC_TIME, 'portuguese');
?>

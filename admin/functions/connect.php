<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'bitlist';

  $dbh = 'mysql:host='.$db_host.';dbname='.$db_db.';charset=utf8';
  $pdo = new PDO($dbh,$db_user,$db_password);
?>
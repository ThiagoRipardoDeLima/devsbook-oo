<?php
session_start();
//$base = 'http://localhost:8080/devsbook';
$base = 'http://localhost/devsbook-oo';

$db_name = 'devsbook';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$pdo = new PDO("mysql:dbname=". $db_name .";hots=". $db_host, $db_user,$db_pass);

date_default_timezone_set('America/Cuiaba');

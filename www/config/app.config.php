<?php
$host = "127.0.0.1";
$port = "5530";
$dbName = 'faistoip';
$user = "faistoip";
$password = "faistoip";

/*$host = "mysql51-68.perso";
$port=3306;
$dbName = 'faistoipbdd';
$user = "faistoipbdd";
$password = "anelka92";*/

$conf = 'mysql:host='.$host.';dbname='.$dbName.';port='.$port.'charset=utf8';
try {
	$bdd = new PDO($conf, $user, $password);
} catch(Exception $e) {
	die;
}
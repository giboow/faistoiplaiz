<?php
$host = "127.0.0.1";
$port = "5530";
$dbName = 'faistoip';
$user = "faistoip";
$password = "faistoip";
$conf = 'mysql:host='.$host.';dbname='.$dbName.';port='.$port.'charset=utf8';
try {
	$bdd = new PDO($conf, $user, $password);
} catch(Exception $e) {
	die;
}
<?php
include_once '../config/functions.php';

$inputDatas = $_GET;

$action = null;
if (isset($inputDatas['action'])) {
	$action = $inputDatas['action'];
}

if($action == "supprimer") {
	deletePhrase($bdd, $inputDatas['id']);
} elseif ($action == "modifier") {
	updatePhrase($bdd, $inputDatas['id'], $inputDatas['phrase']);
} else {

}

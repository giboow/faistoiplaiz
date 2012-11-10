<?php
include_once 'config/app.config.php';

function getPhrase($bdd, $sexe='M', $insulte=true, $id=null) {
	if ($insulte) {
		$insulte = 1;
	} else {
		$insulte = 0;
	}
	$sql = 'SELECT * FROM phrases WHERE sexe="'.$sexe.'" AND insulte='.$insulte;
	if ($id) {
		$sql .= ' AND id='.$id;
	} else {
		$sql .= ' ORDER BY RAND()';
	}
	$sql .= ' LIMIT 1';

	$select =  $bdd->query($sql);
	$datas = $select->setFetchMode(PDO::FETCH_ASSOC);
	return $select->fetch();
}

function generateUrl($datas) {
	$url = 'http://'.$_SERVER["HTTP_HOST"]."/?datas=".encodeData($datas);
	return $url;
}

function encodeData($datas) {
	$datasEncode = base64_encode(json_encode($datas));
	return $datasEncode;
}

function decodeData($datas) {

	$datasDecode = json_decode(base64_decode($datas));
	return $datasDecode;
}

<?php
include_once 'config/app.config.php';

function getPhrase($bdd, $sexe='M', $insulte=true) {
	if ($insulte) {
		$insulte = 1;
	} else {
		$insulte = 0;
	}
	$sql = 'SELECT * FROM phrases WHERE sexe="'.$sexe.'" AND insulte='.$insulte.' ORDER BY RAND() LIMIT 1';
	$select =  $bdd->query($sql);
	$datas = $select->setFetchMode(PDO::FETCH_ASSOC);
	return $select->fetch();
}

$inputDatas = $_POST;

$insulte = false;
if(isset($inputDatas['insulte'])) {
	$insulte = (int)$inputDatas['insulte'];
}

$sexe = 'M';
if(isset($inputDatas['sexe'])) {
	$sexe = $inputDatas['sexe'];
}
$phrase = getPhrase($bdd, $sexe, $insulte);
$phrase["phrase"] = htmlspecialchars(utf8_encode($phrase["phrase"]));

echo json_encode($phrase);
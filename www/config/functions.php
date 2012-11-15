<?php
include_once  __DIR__.'/app.config.php';

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


function getPhrases ($bdd, $sexe=null, $insulte=null){
	$sql = "SELECT * FROM phrases";
	if ($sexe || $insulte) {
		$sql .= " WHERE";
		if ($insulte !== null) {
			$insulte = (bool)$insulte;
			$sql .= " insulte='".$insulte."'";
		}
		if ($sexe !== null) {
			if ($insulte !== null)
				$sql.=" AND";
			$sql .= " sexe='".$sexe."'";
		}
	}
	$select =  $bdd->query($sql);
	$datas = $select->setFetchMode(PDO::FETCH_ASSOC);
	return $select->fetchAll();
}

function updatePhrase($bdd, $id, $phrase)
{
	$sql = "UPDATE phrases set phrase='".addslashes(utf8_decode($phrase))."' WHERE id=".$id;
	$select =  $bdd->exec($sql);
}

function deletePhrase($bdd, $id) {
	$sql = "DELETE FROM phrases WHERE id=".$id;
	$select =  $bdd->exec($sql);
}

function addPhrase($bdd, $datas) {
	$sexe = $datas['sexe'];
	$insulte = (isset($data['insulte'])?1:0);
	$phrase = addslashes(utf8_decode($datas['phrase']));
	$sql = "INSERT INTO `phrases` (`sexe`, `insulte`, `phrase`) VALUES ('".$sexe."', '".$insulte."', '".$phrase."');";
	$bdd->exec($sql);
}
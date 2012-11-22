<?php
include_once 'config/functions.php';

$inputDatas = $_POST;


$insulte = false;
if(isset($inputDatas['insulte'])) {
	$insulte = (int)$inputDatas['insulte'];
}

$sexe = 'M';
if(isset($inputDatas['sexe'])) {
	$sexe = $inputDatas['sexe'];
}

$id=null;
if (isset($inputDatas['id'])) {
	$id = $inputDatas['id'];
}

$datas = getPhrase($bdd, $sexe, $insulte, $id);
$inputDatas['id'] = $datas['id'];

$colors = array(
		'jaune',
		'bleu',
		'bleupastel',
		'orange',
		'rose',
		'rouge',
		'vert',
		'violet'
);

$datas["color"] = $colors[array_rand($colors)];

$inputDatas['color'] = $datas["color"];


if(!$id) {
	$datas["fbUrl"] = generateUrl($inputDatas);
}
$datas['imgUrl'] = generateUrl($inputDatas, 'getImg.php');
$datas["phrase"] = htmlentities(utf8_encode($datas["phrase"]), ENT_XHTML);



echo json_encode($datas);
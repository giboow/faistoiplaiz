<?php
include __DIR__.'/config/functions.php';

if(!isset($_GET['datas'])) {
	die;
}
$datas = decodeData($_GET['datas']);


$colors = array(
	'jaune' => array(
		'bg' => '/img/affiches/jaune.png',
		'logo' => '/img/logo/logovert.png',
		'color' => 'black',
		'prenom' => 'vert',
	),
	'bleu' => array(
		'bg' => '/img/affiches/bleu.png',
		'logo' => '/img/logo/logovertfluo.png',
		'color' => 'white',
		'prenom' => 'vertFluo',
	),
	/*'bleupastel' => array(
		'bg' => '/img/affiches/bleupastel.png',
		'logo' => '/img/logo/logojaune.png',
		'color' => 'white',
		'prenom' => 'jaune',
	),*/
	'orange' => array(
		'bg' => '/img/affiches/orange.png',
		'logo' => '/img/logo/logoblanc.png',
		'color' => 'black',
		'prenom' => 'white',
	),
	'rose' => array(
		'bg' => '/img/affiches/rose.png',
		'logo' => '/img/logo/logojaune.png',
		'color' => 'white',
		'prenom' => 'jaune',
	),
	'vert' => array(
		'bg' => '/img/affiches/vert.png',
		'logo' => '/img/logo/logoblanc.png',
		'color' => 'black',
		'prenom' => 'white',
	),
	'violet' => array(
		'bg' => '/img/affiches/violet.png',
		'logo' => '/img/logo/logojaune.png',
		'color' => 'white',
		'prenom' => 'jaune',
	),

);
if(@$datas->color && isset($colors[$datas->color])) {
	$colorConf = $colors[$datas->color];
} else {
	$colorConf = $colors[array_rand($colors)];
}
$im = imagecreatefrompng('./'.$colorConf['bg']);
$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$vertFluo = imagecolorallocate($im, 55, 236, 138);
$vert = imagecolorallocate($im, 106, 175, 57);
$jaune = imagecolorallocate($im, 223, 233, 48);

$colorPanel = array(
		'black' => $black,
		'white' => $white,
		'vertFluo' => $vertFluo,
		'vert' => $vert,
		'jaune' => $jaune
);
$colorConf['color'] = $colorPanel[$colorConf['color']];
$colorConf['prenom'] = $colorPanel[$colorConf['prenom']];


// Path to our font file
header('Cache-control: max-age='.(60*60*24*365));
header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
header('Last-Modified: '.date(DATE_RFC822,strtotime(" 1 day")));
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
	header('HTTP/1.1 304 Not Modified');
	die();
}
$font = './css/font/Rockwell/ROCKB.TTF';
$id = $datas->id;
$phrase = getPhrase($bdd, $datas->sexe, $datas->insulte, $id);

$text = $phrase["phrase"];
$text = mb_strtoupper($text);
$prenom = $datas->prenom;
$prenom = str_split($prenom, 18)[0];
$colored = array('{PRENOM}' => array('color' => $colorConf['prenom'], 'value' => strtoupper($prenom)));
$y = write_multiline_text($im, 25, $colorConf['color'], $font, 33, $text, 0, 0, 278, false, $colored);
$y1 = $y + 100;
$yTop = (398-$y1)/2;

$logo = imagecreatefrompng('./'.$colorConf['logo']);
imageline ( $im, 20 , $yTop+15 , 100 , $yTop+15 , $colorConf['color']);
imageline ( $im, 20 , $yTop+16 , 100 , $yTop+16 , $colorConf['color']);
imagecopy($im, $logo , 113, $yTop, 0, 0, 82, 27);
imageline ( $im, 208 , $yTop+15 , 288  , $yTop+15 , $colorConf['color']);
imageline ( $im, 208 , $yTop+16 , 288 , $yTop+16 , $colorConf['color']);


$y2 = $yTop + 60;

$y = write_multiline_text($im, 25, $colorConf['color'], $font, 33, $text, 15, $y2, 278, true, $colored);

$y= $y+15;
imageline($im, 20, $y, 288, $y, $colorConf['color']);
imageline($im, 20, $y+1, 288, $y+1, $colorConf['color']);

// Output to browser
header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);

?>
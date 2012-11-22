<?php
include __DIR__.'/config/functions.php';

if(!isset($_GET['datas'])) {
	die;
}
$datas = decodeData($_GET['datas']);




$im = imagecreatefrompng( 'img/affiches/bleu.png');


$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);

// Set the background to be white


// Path to our font file
$font = './css/font/Rockwell.ttf';
$phrase = getPhrase($bdd, $datas->sexe, $datas->insulte, $datas->id);
header('Cache-control: max-age='.(60*60*24*365));
header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
header('Last-Modified: '.date(DATE_RFC822,strtotime(" 1 day")));
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
	header('HTTP/1.1 304 Not Modified');
	die();
}

$text = $phrase["phrase"];
$text = strtoupper($text);
$prenom = $datas->prenom;
$prenom = str_split($prenom, 18)[0];
$colored = array('{PRENOM}' => array('color' => $white, 'value' => strtoupper($prenom)));
$y = write_multiline_text($im, 20, $black, $font, 8, $text, 0, 0, 298, false, $colored);
$y1 = $y + 100;
$yTop = (398-$y1)/2;

$logo = imagecreatefrompng('img/logo/logoblanc.png');
imageline ( $im, 20 , $yTop+15 , 100 , $yTop+15 , $black);
imageline ( $im, 20 , $yTop+16 , 100 , $yTop+16 , $black);
imagecopy($im, $logo , 113, $yTop, 0, 0, 82, 27);
imageline ( $im, 208 , $yTop+15 , 288  , $yTop+15 , $black);
imageline ( $im, 208 , $yTop+16 , 288 , $yTop+16 , $black);


$y2 = $yTop + 60;

$y = write_multiline_text($im, 20, $black, $font, 8, $text, 10, $y2, 298, true, $colored);

$y= $y+15;
imageline($im, 20, $y, 288, $y, $black);
imageline($im, 20, $y+1, 288, $y+1, $black);

// Output to browser
header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);

?>
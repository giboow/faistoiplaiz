<?php

function write_multiline_text($image, $font_size, $color, $font, $line_heigh, $text, $start_x, $start_y, $max_width) {
    //split the string
    //build new string word for word
    //check everytime you add a word if string still fits
    //otherwise, remove last word, post current string and start fresh on a new line
    $words = explode(" ", $text);
    $string = "";
    $tmp_string = "";

    for($i = 0; $i < count($words); $i++) {
        $tmp_string .= $words[$i]." ";

        //check size of string
        $dim = imagettfbbox($font_size, 0, $font, $tmp_string);

        if($dim[4] < ($max_width - $start_x)) {
            $string = $tmp_string;
            $curr_width = $dim[4];
        } else {
            $i--;
            $tmp_string = "";
            $start_xx = $start_x + round(($max_width - $curr_width - $start_x) / 2);
            imagettftext($image, $font_size, 0, $start_xx, $start_y, $color, $font, $string);

            $string = "";
            $start_y += abs($dim[5]) + $line_heigh;
            $curr_width = 0;
        }
    }

    $start_xx = $start_x + round(($max_width - $dim[4] - $start_x) / 2);
    imagettftext($image, $font_size, 0, $start_xx, $start_y, $color, $font, $string);
}

$im = imagecreatefrompng( 'img/affiches/bleu.png');


$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);

// Set the background to be white

$logo = imagecreatefrompng('img/logo/logoblanc.png');
imagecopy($im, $logo , 113, 30, 0, 0, 82, 27);
// Path to our font file
$font = './css/font/Rockwell.ttf';

$text = "This is a very ";
$text .= "long long long long long long long long long long long long long long long long ";
$text .= "long long long long long long long long long long long long long long long long ";
$text .= "line of text";

$text = strtoupper($text);
write_multiline_text($im, 20, $black, $font, 2, $text, 10, 100, 298);

// Output to browser
header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);

?>
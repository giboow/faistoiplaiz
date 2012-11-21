<?php
function write_multiline_text($image, $font_size, $color, $font, $text, $start_x, $start_y, $max_width)
{
        //split the string
        //build new string word for word
        //check everytime you add a word if string still fits
        //otherwise, remove last word, post current string and start fresh on a new line
        $words = explode(" ", $text);
        $string = "";
        $tmp_string = "";

        for($i = 0; $i < count($words); $i++)
        {
            $tmp_string .= $words[$i]." ";

            //check size of string
            $dim = imagettfbbox($font_size, 0, $font, $tmp_string);

            if($dim[4] < $max_width)
            {
                $string = $tmp_string;
            } else {
                $i--;
                $tmp_string = "";
                imagettftext($image, 11, 0, $start_x, $start_y, $color, $font, $string);

                $string = "";
                $start_y += 22; //change this to adjust line-height. Additionally you could use the information from the "dim" array to automatically figure out how much you have to "move down"
            }
        }

        imagettftext($image, 11, 0, $start_x, $start_y, $color, $font, $string); //"draws" the rest of the string
}
// CrŽation d'une image de 300x150 pixels
$im = imagecreatetruecolor(300, 150);
$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);

// DŽfinit l'arrire-plan en blanc
imagefilledrectangle($im, 0, 0, 299, 299, $white);

// Chemin vers le fichier de police
$font = './css/font/Rockwell.ttf';

// Tout d'abord, nous crŽons notre rectangle entourant notre premier texte
$bbox = imagettfbbox(10, 45, $font, 'Powered by PHP ' . phpversion());

// Nos coordonnŽes en X et en Y
$x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) - 25;
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 5;

// Dessin du texte
imagettftext($im, 10, 45, $x, $y, $black, $font, 'Powered by PHP ' . phpversion());

// Nous crŽons notre rectangle entourant notre second texte
$bbox = imagettfbbox(10, 45, $font, 'and Zend Engine ' . zend_version());

// DŽfinit les coordonnŽes afin que le second text suive le premier
$x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2) + 10;
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2) - 5;

// Dessin du texte
imagettftext($im, 10, 45, $x, $y, $black, $font, 'and Zend Engine ' . zend_version());

// Affichage vers le navigateur
header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);
?>

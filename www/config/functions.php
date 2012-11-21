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

function write_multiline_text($image, $font_size, $color, $font, $line_heigh, $text, $start_x, $start_y, $max_width, $write=true, $colored = array()) {
	//split the string
	//build new string word for word
	//check everytime you add a word if string still fits
	//otherwise, remove last word, post current string and start fresh on a new line
	$words = explode(" ", $text);
	$string = "";
	$tmp_string = array();
	$coloredString = array();
	for($i = 0; $i < count($words); $i++) {
		$cWord = $words[$i];
		if (array_key_exists($cWord, $colored)) {
			if (isset($colored[$cWord]['value'])) {
				$tmp_string[] = $colored[$cWord]['value'];
				if (isset($colored[$cWord]['color'])) {
					$coloredString[count($tmp_string)-1] = $colored[$cWord]['color'];
				}
			}
		} else {
			$tmp_string [] = $words[$i];
		}
		//check size of string
		$s = implode(' ', $tmp_string);
		$dim = imagettfbbox($font_size, 0, $font, $s);

		if($dim[4] < ($max_width - $start_x)) {
			$string = implode(' ', $tmp_string);
			$curr_width = $dim[4];
		} else {
			$i--;
			$start_xx = $start_x + round(($max_width - $curr_width - $start_x) / 2);
			if ($write) {
				$x = $start_xx;
				unset($tmp_string[count($tmp_string)-1]);
				foreach ($tmp_string as $k => $s) {
					$oColor = false;
					if (array_key_exists($k, $coloredString)) {
						$oColor = $coloredString[$k];
					}
					$c = $oColor?$oColor:$color;
					$d = imagettftext($image, $font_size, 0, $x, $start_y, $c, $font, $s." ");
					$x = $d[2];
				}
			}
			$coloredString = array();
			$tmp_string = array();
			$string = "";
			$start_y += abs($dim[5]) + $line_heigh;
			$curr_width = 0;
		}
	}

	$start_xx = $start_x + round(($max_width - $dim[4] - $start_x) / 2);
	if ($write) {
		$x = $start_xx;
		foreach ($tmp_string as $k => $s) {
			$oColor = false;
			if (array_key_exists($k, $coloredString)) {
				$oColor = $coloredString[$k];
			}
			$c = $oColor?$oColor:$color;
			$d = imagettftext($image, $font_size, 0, $x, $start_y, $c, $font, $s." ");
			$x = $d[2];
		}
	}
	return $start_y;
}
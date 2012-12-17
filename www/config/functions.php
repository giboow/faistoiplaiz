<?php
include_once  __DIR__.'/app.config.php';
include_once __DIR__ .'/Cache.php';
$cache = new Cache(__DIR__.'/../cache/');

function getPhrase($bdd, $sexe='M', $insulte=true, $id=null) {
	global $cache;
	global $dbName;
	global $bdd;
	$sexe = addslashes($sexe);
	$insulte = (bool)$insulte;
	$id = (int)$id;
	if ($insulte) {
		$insulte = 1;
	} else {
		$insulte = 0;
	}
	$cacheName = $dbName.$sexe.$insulte;
	if(($entries = $cache->get($cacheName)) === false) {
		$sql = 'SELECT * FROM '.$dbName.' WHERE sexe="'.$sexe.'" AND insulte='.$insulte;
		$select =  $bdd->query($sql);
		$datas = $select->setFetchMode(PDO::FETCH_ASSOC);
		$v = $select->fetchAll();
		$entries = array();
		foreach ($v as $d) {
			$entries[$d['id']] = $d;
		}
		$cache->set($cacheName, $entries);
	}
	if ($id) {
		if(isset($entries[$id])) {
			return $entries[$id];
		}
	}
	return $entries[array_rand($entries)];

}

function generateUrl($datas, $script=null) {
	$url = 'http://'.$_SERVER["HTTP_HOST"];
	if($script)
		$url .= "/".$script;
	$url .= "/?datas=".encodeData($datas);
	return $url;
}

function encodeData($datas) {
	$str =json_encode($datas);
	$datasEncode = base64_encode($str);
	return $datasEncode;
}

function decodeData($datas) {
	$d = base64_decode($datas);
	$datasDecode = json_decode($d);
	return $datasDecode;
}


function getPhrases ($bdd, $sexe=null, $insulte=null){
	global $dbName;
	global $bdd;
	$sql = "SELECT * FROM ".$dbName;
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

function clearCaches()
{
	global $cache;
	global $dbName;
	$cache->clear($dbName.'M0');
	$cache->clear($dbName.'M1');
	$cache->clear($dbName.'F0');
	$cache->clear($dbName.'F1');
}

function updatePhrase($bdd, $id, $phrase)
{
	global $dbName;
	$sql = "UPDATE ".$dbName." set phrase='".addslashes(utf8_decode($phrase))."' WHERE id=".$id;
	$select =  $bdd->exec($sql);
	clearCaches();
}

function deletePhrase($bdd, $id) {
	global $dbName;
	$sql = "DELETE FROM ".$dbName." WHERE id=".$id;
	$select =  $bdd->exec($sql);
	clearCaches();
}

function addPhrase($bdd, $datas) {
	global $dbName;
	$sexe = $datas['sexe'];
	$insulte = (isset($datas['insulte'])?1:0);
	$phrase = addslashes(utf8_decode($datas['phrase']));
	$sql = "INSERT INTO `".$dbName."` (`sexe`, `insulte`, `phrase`) VALUES ('".$sexe."', '".$insulte."', '".$phrase."');";
	$bdd->exec($sql);
	clearCaches();
}

function write_multiline_text($image, $font_size, $color, $font, $line_heigh, $text, $start_x, $start_y, $max_width, $write=true, $colored = array()) {
	foreach ($colored as $k => $c) {
		if (isset($c['value'])) {
			if(!preg_match('#'.$k.' #', $text)) {
				$text = str_replace($k, $k.' ', $text);
			}
		}
	}
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
			if(count($tmp_string) > 1) {
				$i--;
				unset($tmp_string[count($tmp_string)-1]);
			}
			//$start_xx = $start_x + round(($max_width - $curr_width - $start_x) / 2);
			$start_xx = $start_x;
			//var_dump($tmp_string);
			if ($write) {
				$x = $start_xx;
				$replace= false;
				foreach ($tmp_string as $k => $s) {
					$oColor = false;
					if (array_key_exists($k, $coloredString)) {
						$oColor = $coloredString[$k];
						$replace = true;
					} else {
						$s .= " ";
						if ($replace && preg_match("#^[A-Za-z]#", $s)) {
							$s = " ".$s;
						}
						$replace = false;
					}
					$c = $oColor?$oColor:$color;
					$d = imagettftext($image, $font_size, 0, $x, $start_y, $c, $font, $s);
					$x = $d[2];
				}
			}
			$coloredString = array();
			$tmp_string = array();
			$string = "";
			$d = abs($dim[5]);
			if ($d >= $line_heigh) {
				$start_y += $d;
			} else {
				$start_y += $line_heigh;
			}
			//$start_y += abs($dim[5]) + $line_heigh;
			$curr_width = 0;
		}
	}

	//$start_xx = $start_x + round(($max_width - $dim[4] - $start_x) / 2);
	$start_xx = $start_x;
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
<?php

$replace = array();
foreach ($keywordsArray as $key => $value) {
	$replace[] = 'PGZvbnQgY29sb3I9cmVkPjxiPg== '.$value.' PC9iPjwvZm9udD4=';
}

function decode($text) {
		$wordsArray = explode(" ", $text);
		$decoded = "";
		foreach ($wordsArray as $key => $value) {
			$decoded = $decoded.base64_decode($value);
		}
		return $decoded;
}

foreach ($result as $key => $value) {
	echo '<div>';
	switch ($value['search_indices']['type']) {
		case '1':
			echo '<div><a href="/webcontents/view/'.$value['search_indices']['content_id'].'" style="float: none">';
			$webcontent = $this->requestAction(
					'/webcontents/getWebcontentInfoById/'.$value['search_indices']['content_id']);
			echo $webcontent['Webcontent']['title'];
			echo '</a><br>'.$webcontent['Webcontent']['created'].'</div>';
			break;
		default:
			
			break;
	}
	echo '<div><p>';
	echo decode( str_replace ($keywordsArray, $replace, $value['search_indices']['content']) );
	echo '</p></div><br>';
	echo '</div>';
}

//返回高亮结果
// echo highlight($result['0']['search_indices']['content'], $keywordsArray);
function highlight($str, $key_arr) {
	
	$param_temp = array();
	echo preg_match_all('/' . join('|', $key_arr) . '/i', $str, $matches);
	// var_dump($matches);
	
	foreach ($matches[0] as $value) {
		$param_temp[$value] = "<font color=red><b>" . $value . "</b></font>";
	}

	$str2 = strtr($str, $param_temp);
	return $str2;
}

// var_dump($result);
?>

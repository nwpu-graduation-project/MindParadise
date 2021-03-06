<?php
require_once (dirname(__FILE__) . '/pscws4.class.php');

class WordSegmenter {
	protected $pscws;

	public function WordSegmenter($ignore = false) {
		$this -> pscws = new PSCWS4('utf8');

		// 接下来, 设定一些分词参数或选项, set_dict 是必须的, 若想智能识别人名等需要 set_rule
		// 包括: set_ignore, set_multi, set_debug, set_duality ... 等方法
		$this -> pscws -> set_dict('./dict.utf8.xdb');
		$this -> pscws -> set_rule('./rules.utf8.ini');
		$this -> pscws -> set_ignore($ignore);

	}

	public function segment($text) {
		$encoded = "";
		// 分词调用 send_text() 将待分词的字符串传入, 紧接着循环调用 get_result() 方法取回一系列分好的词
		// 返回的词是一个关联数组, 包含: word 词本身, idf 逆词率(重), off 在text中的偏移, len 长度, attr 词性
		$this -> pscws -> send_text($text);
		while ($some = $this -> pscws -> get_result()) {
			foreach ($some as $word) {
				// echo $word['word'].':'.$this->zh2en($word['word']);
				$encoded = $encoded . $this -> zh2en($word['word']) . ' ';
			}
		}
		// echo $encoded;
		return $encoded;

		// 在 send_text 之后可以调用 get_tops() 返回分词结果的词语按权重统计的前 N 个词
		// 返回的数组元素是一个词, 它又包含: word 词本身, weight 词重, times 次数, attr 词性
		// $tops = $pscws->get_tops(10, 'n,v');
		// print_r($tops);
	}

	protected function zh2en($str) {
		// return base64_encode($str);
		$str = trim($str);
		return base64_encode($str);
		// $str = urlencode($str);
		// return str_replace("%", "", $str);
	}
	
	public function decode($text) {
		$wordsArray = explode(" ", $text);
		$decoded;
		foreach ($wordsArray as $key => $value) {
			$decoded = $decoded.base64_decode($value);
		}
		return $decoded;
	}
	
	public function parseKeyword($keyword) {
		$ignore = array('dec', 'deg', 'di', 'etc', 'as', 'msp', 'u', 'uj');
		$encoded = "";
		$this -> pscws -> send_text($keyword);
		while ($some = $this -> pscws -> get_result()) {
			foreach ($some as $word) {
				if(!in_array($word['attr'], $ignore)) {
					// echo $word['word'].':'.$word['attr'].'----';
					$encoded = $encoded . $this -> zh2en($word['word']) . ' ';
				}
			}
		}
		// echo $encoded;
		return $encoded;
	}

	function __destruct() {
		$this -> pscws -> close();
	}

}
?>
<?php

App::uses('WordSegmenter', 'Vendor');
App::uses('DboSource', 'Core');

class SearchIndex extends AppModel {
	
	/* type :
	 * 	webcontents -- 1
	 * 	encyclopedia -- 2
	 */
	public function createIndex($text, $type, $content_id) {
		$data = array('type' => $type, 'content_id' => $content_id);
		$segmenter = new WordSegmenter();
		$data['content'] = $segmenter->segment($text);
		$this->create();
		if($this->save($data)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function search($keywords, $type=0) { // $keywordArray = array()
		// $keywords = '';
		// foreach ($keywordArray as $key => $keywrod) {
			// $keywords = $keywords.' '.$keywrod;
		// }
		$segmenter = new WordSegmenter(true);
		$keywords = $segmenter->parseKeyword($keywords);
		$keywords = trim($keywords);
		$keywords = $this->getDatasource()->value($keywords, 'TEXT');
		$query = "SELECT * FROM search_indices WHERE MATCH(content) AGAINST(".$keywords.");";
		return $this->query($query);
	}
	
	// return an array of parsed keywords
	public function parse($keyword) {
		$segmenter = new WordSegmenter();
		$keywords = $segmenter->parseKeyword($keyword);
		return explode(" ", $keywords);
	}
	
}

?>
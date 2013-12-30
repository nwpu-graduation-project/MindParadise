<?php

class WebcontentsTag extends AppModel {
	// hasMany and saveAll()
    // public $belongsTo = array('Webcontent','Tag');
	
	public function saveContentAsscoTags($id, array $array) {
		$mdata = array();
		$pageTag = array();
		foreach ($array as $tagID) {
			$pageTag['webcontent_id'] = $id;
			$pageTag['tag_id'] = $tagID;
			$mdata[] = $pageTag;
			unset($pageTag);
		}
		
		$options = array(
			'fieldList' => array('webcontent_id','tag_id'),
			'deep' => false			
		);
		
		if($this->saveMany($mdata, $options)){
			return TRUE;
		}
		return FALSE;
	}
}

?>
<?php

class EncyclopediaEntry extends AppModel {
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'fields' => array('id', 'name')
		),
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array('id', 'username')
		)
	);
	
	public function browsedOnce($id) {
		if(!$id) {
			return ;
		}
		$entry = $this->read('browse_count', $id);
		$this->saveField('browse_count', ++$entry['EncyclopediaEntry']['browse_count']);
		$this->clear();
	}
}

?>
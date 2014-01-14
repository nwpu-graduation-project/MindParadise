<?php

class Webcontent extends AppModel {
	
    public $belongsTo = array(
    	'User' => array(
    		'className' => 'User',
    		'fields' => array('id','username','role'))
	);

	public $hasAndBelongsToMany = array(
        'WecontentTags' =>
            array(
                'className' => 'Tag',
                'fields' => array('id', 'tag'),
                'joinTable' => 'webcontents_tags',
                'foreignKey' => 'webcontent_id',
                'associationForeignKey' => 'tag_id',
                'unique' => true
            )
    );
	
    public $validate = array(
        'title' => array('rule' => 'notEmpty'),
        'abstract' => array('rule' => 'notEmpty'),
        'category' => array('rule' => 'notEmpty')
    );
	
	public function browsedOnce($id) {
		if(!$id) {
			return ;
		}
		$webcontent = $this->read('browse_count', $id);
		$this->saveField('browse_count', ++$webcontent['Webcontent']['browse_count']);
		$this->clear();
	}
}

?>
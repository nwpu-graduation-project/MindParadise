<?php

class Webcontent extends AppModel {
	
    public $belongsTo = array(
    	'User' => array(
    		'className' => 'User',
    		'fields' => array('id','username','role'))
	);
	/*
    public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'conditions' => array('Comment.parent_comment_id' => null)
		),
        'WebcontentsTag' => array('className' => 'WebcontentsTag',
								'fields' => array('tag_id'))
    );*/
	
	public $hasAndBelongsToMany = array(
        'WecontentTags' =>
            array(
                'className' => 'Tag',
                'fields' => 'tag',
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
		$webcontent = $this->Webcontent->read('browse_count', $id);
		$this->Webcontent->set('browse_count', ++$webcontent['browse_count']);
		$this->Webcontent->save();
	}
    
}

?>
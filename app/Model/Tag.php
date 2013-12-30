<?php

class Tag extends AppModel {
	// public $hasMany = 'WebcontentsTag';
	
	public $hasAndBelongsToMany = array(
        'TagWebcontents' =>
            array(
                'className' => 'Webcontent',
                'fields' => array('id'),
                'joinTable' => 'webcontents_tags',
                'foreignKey' => 'tag_id',
                'associationForeignKey' => 'webcontent_id',
                'unique' => true
            )
    );
	
    public $validate = array(
        'tag' => array('rule' => 'notEmpty')
    );	
}

?>
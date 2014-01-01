<?php

class EncyclopediaEntry extends AppModel {
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'fields' => array('id', 'name')
		)
	);
}

?>
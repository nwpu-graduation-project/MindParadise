<?php
class Blogroll extends AppModel
{
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
			),
		'url' => array(
			'rule' => 'notEmpty'
			)
		);
}

?>
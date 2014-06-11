<?php 
class RecommendContent extends AppModel
{
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
			),
		'abstract' => array(
			'rule' => 'notEmpty'
			),
		'picture' => array(
			'rule' => 'notEmpty'
			),
		'url' => array(
			'rule' => 'notEmpty'
			),
		);

}


?>
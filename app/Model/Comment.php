<?php

class Comment extends AppModel {
	public $belongsTo = array(
		'Webcontent' => array(
			'className' => 'Webcontent',
			'fields' => array('id'),
			'counterCache' => true),
		// 'ParentComment' => array('className' => 'Comment','foreignKey' => 'comment_on_id'),
		'Commentor' => array(
			'className' => 'User',
			'foreignKey' => 'commentor_id',
			'fields' => array('username')),
		'CommenttedUser' => array(
			'className' => 'User',
			'foreignKey' => 'commentted_user_id',
			'fields' => array('username'))
	);
	
	public $hasMany = array(
		'FollowedComments' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_comment_id',
			'order' => 'FollowedComments.created ASC'
		)
	);
}

?>
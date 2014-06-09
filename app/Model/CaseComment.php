<?php
App::uses('Message', 'Model');

class CaseComment extends AppModel {
	public $belongsTo = array(
		'CaseArticle' => array(
			'className' => 'CaseArticle',
			'fields' => array('id', 'title', 'owner_id'),
			'counterCache' => true),
		'Commentor' => array(
			'className' => 'User',
			'foreignKey' => 'commentor_id',
			'fields' => array('username')),
		'CommenttedUser' => array(
			'className' => 'User',
			'foreignKey' => 'commentted_user_id',
			'fields' => array('username')),
 		'ParentComment' => array(
			'className' => 'CaseComment',
			'foreignKey' => 'parent_comment_id',
			'fields' => array('content', 'commentor_id'),
			),
	);
	
	public $hasMany = array(
		'FollowedComments' => array(
			'className' => 'CaseComment',
			'foreignKey' => 'parent_comment_id',
			'order' => 'FollowedComments.created ASC'
		)
	);

	// public function afterSave($created, $options = Array())
	// {
	// 	$message = new Message();
	// 	$message->createCommentMessage($this->read());
	// 	parent::afterSave();
	// }
}

?>
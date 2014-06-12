<?php
App::uses('Message', 'Model');

class Contact extends AppModel {
	public $belongsTo = array(
		'expert' => array(
			'className' => 'Expert',
			'fields' => array('id', 'consultant_id', 'realname'),
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
			'className' => 'Comment',
			'foreignKey' => 'parent_comment_id',
			'fields' => array('content', 'commentor_id'),
			),
	);
	
	public $hasMany = array(
		'FollowedComments' => array(
			'className' => 'Contact',
			'foreignKey' => 'parent_comment_id',
			'order' => 'FollowedComments.created ASC'
		)
	);

	public function afterSave($created, $options = Array())
	{
		$message = new Message();
		$message->createContactMessage($this->read());
		parent::afterSave();
	}
}

?>
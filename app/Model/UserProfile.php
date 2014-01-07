<?php 
class UserProfile extends AppModel
{
	public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'user_id',
				'fields' => array('username', 'email'),
				),
		);


}

?>
<?php 
class AdministratorProfile extends AppModel
{
	public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'admin_id',
				'fields' => array('username', 'email'),
				),
		);

}



?>
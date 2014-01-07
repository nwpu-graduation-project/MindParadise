<?php 
class ConsultantProfile extends AppModel
{
	public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'consultant_id',
				'fields' => array('username', 'email'),
				),
		);

}

?>
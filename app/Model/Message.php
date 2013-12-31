<?php
class Message extends AppModel
{
	public $useTable = 'messages';
	public $belongsTo = array(
			'Creator' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'counterCache' => array(
						'messages_read' => array('Message.f_read' => 1),
						'messages_unread' => array('Message.f_read' => 0))
					)
			);

	public function markRead()
	{

	}
}
?>

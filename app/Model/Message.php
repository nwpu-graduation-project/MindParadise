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

	public function markRead($id = null)
	{
		if($id != null)
		{
			$this->id = $id;
			$this->saveField('f_read', 1);
		}
	}

	public function markReadAll()
	{	
		$this->updateAll(array('f_read' => 1),array('f_read' => 0));
	}

	public function createMessage($user_id, $type, $abstract, $link_route)
	{
		$this->create();
		$data = array(
				'user_id' => $user_id,
				'type' => $type,
				'abstract' => $abstact,
				'link_route' => $link_route,
				'f_read' => 0,
			);

		return $this->save($data);

	}
}
?>

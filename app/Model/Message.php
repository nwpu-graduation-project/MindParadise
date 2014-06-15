<?php
App::uses('User','Model');
App::uses('Comment','Model');
App::uses('Contact','Model');
class Message extends AppModel
{
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

	public function createMessage($type, $user_id, $abstract, $trigger_user_id, $trigger_username, $link_title, $link_url)
	{
		$this->create();
		$data = array(
				'type' => $type,
				'user_id' => $user_id,
				'abstract' => $abstract,
				'trigger_user_id' => $trigger_user_id,
				'trigger_username' => $trigger_username,
				'link_title' => $link_title,
				'link_url' => $link_url,
				'f_read' => 0,
			);

		return $this->save($data);

	}

	public function createCommentMessage($comment)
	{

		//$comment = $this->Comment->findById($comment_id);

		$type = null;
		$user_id = null;
		if($comment['Comment']['parent_comment_id'])
		{
			// type: 回复
			$type 	 			= 1;
			if($comment['Comment']['commentted_user_id'])
				$user_id 			= $comment['Comment']['commentted_user_id'];
			else
			{
				$comment_obj = new Comment();
				$res = $comment_obj->find('first',array(
						'fields' => array('commentor_id'),
						'recursive' => -1,
						'condition' => array('id' => $comment['Comment']['parent_comment_id']),
					));
				//$res = $comment_obj->read('commentor_id', $comment['Comment']['parent_comment_id']);
				$user_id = $res['Comment']['commentor_id'];
			}
		}
		else
		{
			// type: 评论
			$type 	 			= 2;
			$user_id 			= $comment['Webcontent']['user_id'];
		}
		$abstract			= $comment['Comment']['content'];
		$trigger_user_id 	= $comment['Comment']['commentor_id'];
		$trigger_username 	= $comment['Commentor']['username'];
		$link_title 		= $comment['Webcontent']['title'];
		$link_url 			= '/webcontents/view/'.$comment['Webcontent']['id'].'#'.$comment['Webcontent']['id'].'_'.$comment['Comment']['id'];
		
		return $this->createMessage($type, $user_id, $abstract, $trigger_user_id, $trigger_username, $link_title, $link_url);

	}

	public function createContactMessage($contact)
	{
		$type = null;
		$user_id = null;
		if($contact['Contact']['parent_comment_id'])
		{

			if($contact['Contact']['commentted_user_id'])
				$user_id 			= $contact['Contact']['commentted_user_id'];
			else
			{
				$contact_obj = new Contact();
				$res = $contact_obj->find('first',array(
						'fields' => array('commentor_id'),
						'recursive' => -1,
						'condition' => array('id' => $contact['Contact']['parent_comment_id']),
					));
	
				$user_id = $res['Contact']['commentor_id'];
			}

		    $user_obj = new User();
			$commentted_user = $user_obj->find('first', array(
						'fields' => array('role'),
						'recursive' => -1,
						'condition' => array('id' => $user_id)
					));

			if($commentted_user['User']['role'] == 3)
			{
				// type: 留言
				$type = 3;
			}
			else
			{
				// type: 答复
				$type = 4;
			}
		}
		else
		{
			// type: 留言
			$type 	 			= 3;
			$user_id 			= $contact['expert']['consultant_id'];
		}
		$abstract			= $contact['Contact']['content'];
		$trigger_user_id 	= $contact['Contact']['commentor_id'];
		$trigger_username 	= $contact['Commentor']['username'];
		$link_title 		= '咨询师页面';
		$link_url 			= '/experts/view/'.$contact['expert']['id'].'#'.$contact['expert']['id'].'_'.$contact['Contact']['id'];
		
		return $this->createMessage($type, $user_id, $abstract, $trigger_user_id, $trigger_username, $link_title, $link_url);
	}
}
?>

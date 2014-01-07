<?php

class PersonalCenterController extends AppController
{
	public $helpers = array('Html', 'Form', 'Time', 'Paginator');
	public $components = array('Paginator');
	public $uses = array('User','Comment','UserProfile','ConsultantProfile','AdministartorProfile');

	// 个人中心首页
	function index()
	{
		$currentUser = parent::currentUser();

		if(!$currentUser)
		{
			// erro 
			// set flash
			// redirect to login

		}

		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$this->render("user_index");
				break;
			case 3: // consultant
				$this->render("consultant_index");
				break;
			case 4: // administrator
				$this->render("admin_index");
				break;
			default: // error
		}
	}

	// 个人档案查询
	function profileView()
	{
		$currentUser = parent::currentUser();

		if(!$currentUser)
		{
			// erro 
			// set flash
			// redirect to login

		}

		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$profileObj	= $this->UserProfile->findByUserId($currentUser['User']['id']);
				$this->set('profile', $profileObj);
				$this->render("user_profile_view");
				break;
			case 3: // consultant
				$profileObj	= $this->ConsultantProfile->findByConsultantId($currentUser['User']['id']);
				$this->set('profile', $profileObj);
				$this->render("consultant_profile_view");
				break;
			case 4: // administrator
				$profileObj	= $this->AdministratorProfile->findByAdminId($currentUser['User']['id']);
				$this->set('profile', $profileObj);
				$this->render("admin_profile_view");
				break;
			default: // error
		}

	}

	// 个人档案修改
	function profileEdit()
	{
		$currentUser = parent::currentUser();

		if(!$currentUser)
		{
			// erro 
			// set flash
			// redirect to login

		}
		$profileModelName = null;
		$profileObj = null;
		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$profileModelName = 'UserProfile';
				$profileObj	= $this->UserProfile->findByUserId($currentUser['User']['id']);
				break;
			case 3: // consultant
				$profileModelName = 'ConsultantProfile';
				$profileObj	= $this->ConsultantProfile->findByConsultantId($currentUser['User']['id']);
				break;
			case 4: // administrator
				$profileModelName = 'AdministartorProfile';
				$profileObj	= $this->AdministratorProfile->findByAdminId($currentUser['User']['id']);
				break;
			default: // error
		}


		if ($this->request->is(array('post', 'put'))) {

			$this->$profileModelName->id = $profileObj[$profileModelName]['id'];
			if ($this->$profileModelName->save($this->request->data)) {
				$this->Session->setFlash(__('你的信息已经被更新.'));
			return $this->redirect(array('action' => 'profileView'));
			}
			$this->Session->setFlash(__('更新失败.'));
		}

		if ($this->request->data) 
		{
			$this->request->data = $profileObj;
		}

		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$this->render("user_profile_edit");
				break;
			case 3: // consultant
				$this->render("consultant_profile_edit");
				break;
			case 4: // administrator
				$this->render("admin_profile_edit");
				break;
			default: // error
		}

	}


	// 个人评论
 	function myComments()
 	{
 		//$this->Comment->unbindModel(array('belongsTo' => array('CommenttedUser')));
 		// $this->Comment->bindModel(array('belongsTo' => array(
 		// 		'ParentComment' => array(
			// 		'className' => 'Comment',
			// 		'foreignKey' => 'parent_comment_id',
			// 		'fields' => array('content')),
 		// 	)));
 		
 		$this->Paginator->settings = array(
        					'limit' => 8,
        					'order' => array(
            					'Comment.created' => 'desc'
        					),
        					'recursive' => 0,
    					);
		$commentsOnOthers = $this->Paginator->paginate('Comment',array('Comment.commentor_id' => $this->Auth->user('id')));

		$this->set('commentsOnOthers', $commentsOnOthers);
		
		// $this->Comment->unbindAll();
		// $this->Comment->bindModel(
		// 	array('hasMany' => array(
		// 			'FollowedComments' => array(
		// 			'className' => 'Comment',
		// 			'foreignKey' => 'parent_comment_id',
		// 			'order' => 'FollowedComments.created ASC'),
		// 			),
		// 	)
		// );			

		// $res = $this->Comment->find('all', array(
		// 		'conditions' => array('commentor_id' => $this->Auth->user('id')),
		// 		'recursive' => 1,
		// 	));
		//var_dump($res);
		//$this->set('', );
 	}
}

?>
<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $components = array('Auth','Email','Session');
	var $uses = array('User','Message','Blogroll');

	public $layout = 'index';

	/*
	 *  get current user
	 */
	protected function currentUser()
	{

		//Set User's ID in model which is needed for validation
		$id = $this->Auth->user('id');

		// Load the user (avoid populating $this->data)
		$currentUser = null;
		if($id)
		{
			$currentUser = $this->User->find('first',array(
				'conditions' => array('id' => $id),
				'recursive' => -1,
			));
		}
		return $currentUser;

		// $current = $this->Auth->user();
		// return $current? array('User' => $current) : false;
	}

	private function getUnreadMessages()
	{
		$id = $this->Auth->user('id');

		$unreadMessages = null;
		if($id)
		{
			$unreadMessages = $this->Message->find('all',array(
				'conditions' => array('user_id' => $id, 'f_read' => 0),
				'recursive' => -1,
				'order' => 'created desc',
				'limit' => 3,
			));
		}

		return $unreadMessages;
	}

	private function getBlogrolls()
	{
		return $this->Blogroll->find('all');
	}

	function beforeRender()
	{
		$this->set('currentUser', $this->currentUser());
		$this->set('unreadMessages', $this->getUnreadMessages());
		$this->set('blogrolls', $this->getBlogrolls());
		parent::beforeRender();
	}

	protected function checkAdmin()
	{
		$currentUser = $this->currentUser();

		if($currentUser && $currentUser['User']['role'] == 4)
				return true;
		return false;
	}

	protected function checkConsultant()
	{
		$currentUser = $this->currentUser();

		if($currentUser && $currentUser['User']['role'] == 3)
				return true;
		return false;
	}
}

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
	var $uses = array('User','Message');

	public $layout = 'index';

	/*
	 *  get current user
	 */
	protected function currentUser()
	{
		// Set User's ID in model which is needed for validation
		$id = $this->Auth->user('id');

		// Load the user (avoid populating $this->data)
		$currentUser = null;
		if($id)
		{
			$currentUser = $this->User->find('first',array(
				'condition' => array('id' => $id),
				'recursive' => -1,
			));
		}
		return $currentUser;
	}

	function getUnreadMessages()
	{
		$id = $this->Auth->user('id');

		$unreadMessages = null;
		if($id)
		{
			$unreadMessages = $this->Message->find('all',array(
				'condition' => array('user_id' => $id, 'f_read' => 0),
				'recursive' => -1,
				'order' => 'created desc',
				'limit' => 3,
			));
		}

		return $unreadMessages;
	}

	function beforeRender()
	{
		$this->set('currentUser', $this->currentUser());
		$this->set('unreadMessages', $this->getUnreadMessages());
		parent::beforeRender();
	}
}

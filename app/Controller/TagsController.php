<?php

class TagsController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Session');

	public function index() {
		$this->set('tags', $this->Tag->find('all'));
	}

	public function view() {
		$this->Tag->id = 1;
		echo $this->Tag->field('tag');

		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		return $this->Tag->find('all');
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash(__('The tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add the tag.'));
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Tag->delete($id)) {
			$this->Session->setFlash(__('The tag with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
?>
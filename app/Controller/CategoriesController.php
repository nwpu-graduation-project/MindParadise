<?php

class CategoriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry');
	
	public function beforeFilter() {
		$this->Auth->allow();
		parent::beforeFilter();
	}
	
	public function view() {
		if ($this->request->is('get')) {
		}
		
		if ($this->request->is('post')) {
			$type = array_pop($this->request->data);
			if($type == 0) {
				array_pop($this->request->data);
			} elseif($type == 1) {
				$this->request->data['Category']['parent_id'] = array_pop($this->request->data);
			}
			
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				return $this->redirect(array('controller' => 'encyclopediaentries', 'action' => 'add'));
			} else {
				debug($this->Category->validationErrors);
				$this->Session->setFlash(__('Unable to add the tag.'));
			}
		}
	}
	
	public function printAllCategories() {
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		} else {
			$this->_printAllCategories($this->Category->find('threaded'));
		}
	}
	
	public function getAncestors($id) {
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		} else {
			return $this->_getAncestors($id);
		}
	}
	
	protected function _printAllCategories($array=array(), $level = 0) {
		if($level == 0) {
			echo '<ul class="anyClass skinClear harmonica">';
		} else {
			echo '<ul style="display: none;">';
		}
			
		foreach ($array as $key => $value) {
			echo '<li><a onclick="onSelectID('.$value['Category']['id'].', '.
				($value['Category']['parent_id']==NULL?'null':$value['Category']['parent_id']).
				')" id="category_'.$value['Category']['id'].'" class="harFull" style="cursor:pointer">';
			echo $value['Category']['name'].'</a>';
			
			if($value['children'] != NULL) {
				$nextLevel = $level+1;
				$this->_printAllCategories($value['children'], $nextLevel);
			}
			echo '</li>';
		}
		echo '</ul>';
	}
	
	protected function _getAncestors($id, $array = array()) {
		$category = $this->Category->findById($id);
		if($category['Category']['name'] != NULL) {
			$array[] = $category; // $category['Category']['name'];
		}
		if($category['Category']['parent_id'] != NULL) {
			$array = $this->_getAncestors($category['Category']['parent_id'], $array);
		}
		return $array;
	}
}
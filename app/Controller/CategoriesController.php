<?php

class CategoriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry');

	
	public function view() {
		if ($this->request->is('get')) {
		}
		
		if ($this->request->is('post')) {
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
			echo '<li><a onclick="selectID('.$value['Category']['id'].
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
			$array[] = $category['Category']['name'];
		}
		if($category['Category']['parent_id'] != NULL) {
			$array = $this->_getAncestors($category['Category']['parent_id'], $array);
		}
		return $array;
	}
}
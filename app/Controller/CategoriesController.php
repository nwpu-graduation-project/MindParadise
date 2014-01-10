<?php

include_once('WebcontentsController.php');

class CategoriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry');
	
	public function view() {
		if ($this->request->is('get')) {
		}
		
		if ($this->request->is('post')) {
			echo WebcontentsController::_echoArray($this->request->data);
		}
	}
	
	public function printAllCategories() {
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		} else {
			$this->_printAllCategories($this->Category->find('threaded'));
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
}
<?php

class CategoriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry');
	
	public function view() {
		if ($this->request->is('get')) {
			// verify the user
		}
		
		if ($this->request->is('post')) {
			WebcontentsController::_echoArray($this->request->data);
		}
	}
	
}
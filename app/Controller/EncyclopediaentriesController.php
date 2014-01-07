<?php

class EncyclopediaentriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry', 'SearchIndex');
	
	public function view() {
		
	}
	
	public function add() {
		if ($this->request->is('get')) {
			// verify the user
		}
		
		if ($this->request->is('post')) {
			if(!$this->SearchIndex->createIndex($this->request->data['plainText'], 2, 1)) {
				echo 'Create index failed';
			}
		}
	}
	
}

?>
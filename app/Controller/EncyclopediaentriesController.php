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
			$this->render('new');
		}
		
		if ($this->request->is('post')) {
			// if(!$this->SearchIndex->createIndex($this->request->data['plainText'], 2, 1)) {
				// echo 'Create index failed';
			// }
			$text = $this->request->data['entryPage'];
			// $reg = '/(?<=<h\d id=)(.|\n)*(?=<\/h\d>)/';
			$reg = '/(?<=<h\d id=)\a(.|\s)*(?=">)/';
			$matches = array();
			if(preg_match($reg, $text, $matches)) {
    			// var_dump($matches);
    			print_r($matches);
			}
		}
	}
	
}

?>
<?php

class SearchController extends AppController {

	public $helpers = array('Html');
	public $uses = array('SearchIndex');
	
	public function index() {
		if($this->request->is('get')) {
			$this->set('result', 'No keyword specificed.');
		}
		
		if($this->request->is('post')) {
			$keyword = $this->request->data['keyword'];
			if(!empty($keyword)) {
				$this->set('keywordsArray', $this->SearchIndex->parse($keyword));
				$this->set('result', $this->SearchIndex->search($keyword));
			} else {
				return $this->redirect(array('controller' => 'search', 'action' => 'index'));
			}
		}
	}
	
}

?>
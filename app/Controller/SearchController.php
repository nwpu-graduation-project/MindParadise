<?php

class SearchController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('SearchIndex', 'CaseArticle');
	
	public function beforeFilter()
	{
		$this->Auth->allow();
		parent::beforeFilter();
	}
	
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

	public function check() {
		if($this->request->is('get')) {
			$this->set('result', 'No keyword specificed.');
		}
		
		if($this->request->is('post')) {
			$keyword = $this->request->data['keyword'];
			if(!empty($keyword)) {
				$this->set('keywordsArray', $this->SearchIndex->parse($keyword));
				$this->set('result', $this->SearchIndex->search($keyword));
				return $this->redirect(array('controller' => 'search', 'action' => 'check'));
			} else {
				return $this->redirect(array('controller' => 'CaseArticles', 'action' => 'index'));
			}
				
			
			
		}
	}
	
}

?>
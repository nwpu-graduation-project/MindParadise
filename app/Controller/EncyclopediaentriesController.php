<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class EncyclopediaentriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry', 'SearchIndex');
	
	public function beforeFilter()
	{
		$this->Auth->allow();
		$this->Auth->deny('add');
		//$this->Auth->autoRedirect = false;
		parent::beforeFilter();
	}
	
	public function index() {
		$this->render('add');
	}
	
	public function view() {
		// echo print_r($this->EncyclopediaEntry->find('first'));
	}
	
	public function add() {
		if ($this->request->is('get')) {
			// verify the user
			$this->render('new');
		}
		
		if ($this->request->is('post')) {
			$page_content = $this->request->data['entryPage'];
			$page_index = $this->request->data['pageIndex'];
			$plainText = $this->request->data['plainText'];
			array_pop($this->request->data);
			array_pop($this->request->data);
			array_pop($this->request->data);
			$this->request->data['EncyclopediaEntry']['path'] = $this->_saveToFile($page_content, $page_index);
			$this->request->data['EncyclopediaEntry']['user_id'] = $this->Auth->user('id');
			
			$this->EncyclopediaEntry->create();
			if ($this->EncyclopediaEntry->save($this->request->data)) {
				$pageId = $this->EncyclopediaEntry->id;
				
				if(!$this->SearchIndex->createIndex($plainText, 2, $pageId)) {
					echo 'Creating search-index failed.';
					$this->Session->setFlash(__('Create search-index failed.'));			
				}
				
				return $this->redirect(array('action' => 'index'));
			} else {
				debug($this->EncyclopediaEntry->validationErrors);
				$this->Session->setFlash(__('Unable to add the tag.'));
			}
		}
	}
	
	protected function _saveToFile($content, $index) {
		$return = NULL;
		$dir = new Folder('./files/entry_page');
		$name = time();
		$file = new File($dir->pwd().DS.$name.'.inc', true, 0644);
		if($file->open('wb')) {
			$file->write($content);
			$file->close();
			$return = $file->pwd();
    	} else {
        	echo "open ".$file->pwd()." failed";
			$file->close();
			$return = NULL;
		}
		
		$indexFile = new File($dir->pwd().DS.$name.'.inc.index', true, 0644);
		if($indexFile->open('wb')) {
			$indexFile->write($index);
			$indexFile->close();
    	} else {
        	echo "open ".$indexFile->pwd()." failed";
			$indexFile->close();			
		}
		return $return;
	}
	
}

?>
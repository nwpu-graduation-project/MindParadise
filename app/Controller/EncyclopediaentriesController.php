<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class EncyclopediaentriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session', 'Paginator');
	public $uses = array('Category','EncyclopediaEntry', 'SearchIndex');
	
	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'EncyclopediaEntry.id' => 'asc'
        ),
        'recursive' => -1
    );
	
	public function beforeFilter()
	{
		$this->Auth->allow();
		$this->Auth->deny('add');
		//$this->Auth->autoRedirect = false;
		parent::beforeFilter();
	}
	
	public function index() {
	}
	
	public function category($category = NULL) {
		if(empty($category)) {
			;
		} else {
			;
		}
		$this->Paginator->settings = $this->paginate;
			$this->set('entries', $this->Paginator->paginate('EncyclopediaEntry',
				array('EncyclopediaEntry.category_id' => $category)));
		
    	$this->set('currentCategory',$category);
		
		$this->set('childCategories', $this->Category->find('all',
				array('conditions' => array('parent_id' => $category),
					 'recursive' => -1) ));
	}
	
	public function view($id) {
		if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $entry = $this->EncyclopediaEntry->find('first',array(
					'conditions' => array('EncyclopediaEntry.id' => $id),
					'recursive' => 0)
				);
        if (!$entry) {
            throw new NotFoundException(__('Invalid post'));
        }
    
        if ($this->request->is('get')) {
        	$this->set('entry',$entry);
			
			$page = '';
			$file = new File($entry['EncyclopediaEntry']['path']);
			if($file->open('rb')) {
				$page = $file->read();
    		} else {
        		echo "open ".$file->pwd()." failed";
    		}
    		$file->close();
			$this->set('page',$page);
			
			$indexPage = '';
			$indexFile = new File($entry['EncyclopediaEntry']['path'].'.index');
			if($indexFile->open('rb')) {
				$indexPage = $indexFile->read();
    		} else {
        		echo "open ".$indexFile->pwd()." failed";
    		}
    		$indexFile->close();
			$this->set('indexPage',$indexPage);
        }
	}
	
	public function add() {
		if ($this->request->is('get')) {
			// verify the user
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
				
				return $this->redirect(array('action' => 'view', $pageId));
			} else {
				debug($this->EncyclopediaEntry->validationErrors);
				$this->Session->setFlash(__('Unable to add the tag.'));
			}
		}
	}

	public function getEntryID() {
		echo 'hehe';
	}
	
	protected function _saveToFile($content, $index) {
		$return = NULL;
		$dir = new Folder('./files/entry_page');
		$name = time();
		$file = new File($dir->pwd().DS.$name.'.inc', true, 0644);
		if($file->open('wb')) {
			$file->write($content);
			$return = $file->pwd();
			$file->close();
			
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
	
	public function afterFilter() {
		if($this->request->param('action') == 'view') {
			$id = $this->request->param('pass');
			$this->EncyclopediaEntry->browsedOnce($id);
		}
		parent::afterFilter();
	}
	
}

?>
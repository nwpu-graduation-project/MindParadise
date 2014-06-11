<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

// 错误处理，Model层定义，查询
class WebcontentsController extends AppController {

	public $helpers = array('Html', 'Form', 'Time', 'Paginator');
	public $components = array('Session', 'Paginator');
	public $uses = array('Webcontent', 'Tag','Comment','User', 'WebcontentsTag', 'SearchIndex');
	
    public $paginate = array(
        'limit' => 8,
        'order' => array(
            'Webcontent.created' => 'desc'
        ),
        'recursive' => 1
    );
	
	public function beforeFilter() {
		$this->Auth->allow();
		$this->Auth->deny('add', 'postComment');
		//$this->Auth->autoRedirect = false;
		parent::beforeFilter();
	}
	
	public function test() {
		if($this->request->is('get')) {
			
		}
		if($this->request->is('post')) {
			// var_dump($this->request->data);
			$result = 0;
			foreach ($this->request->data as $key => $value) {
				$result += (int)$value;
			}
			$this->set('result', $result);
			$description = "Thank you for the test.";
			$this->set('description', $description);
		}
	}
	
	public function tag($tagId = null) {
		$this->Paginator->settings = $this->paginate;
		if(empty($tagId)) {
			return $this->redirect(array('controller' => 'tags', 'action' => 'index'));
		} else {
			// $this->Tag->findById($tagId, array(''));
			$db = $this->Webcontent->getDataSource();
			$result = $db->fetchAll(
    			'SELECT DISTINCT webcontent_id from webcontents_tags where tag_id = ?',
    			array($tagId)
			);
			$array = array();
			foreach ($result as $key => $value) {
				$array[] = $value['webcontents_tags']['webcontent_id'];
			}
			$this->set('webcontents', $this->Paginator->paginate('Webcontent',
				array('Webcontent.id' => $array)));
		}
		$this->render('index');
	}
	
	public function category($category = 0) {
		$this->Paginator->settings = $this->paginate;
		if($category == 0) {
			$this->set('webcontents', $this->Paginator->paginate('Webcontent'));
		} else {
			$this->set('webcontents', $this->Paginator->paginate('Webcontent',
				array('Webcontent.category' => $category)));
		}
    	$this->set('category',$category);
		$this->render('index');
	}
	
	public function listview() {
		$this->Paginator->settings = $this->paginate;
    	$this->set('webcontents', $this->Paginator->paginate('Webcontent'));
	}
	
	public function index() {
		$this->Paginator->settings = $this->paginate;
    	$this->set('webcontents', $this->Paginator->paginate('Webcontent'));
		// $this->Webcontent->unbindModel( array('hasMany' => array('Comment')) );
		// $this->set('webcontents', $this->Webcontent->find('all',array('recursive' => 1)));
	}
	
	public function add() {
		if ($this->request->is('get')) {
			// verify the user
			$this->set('categories',$this->_getCategories());
		}
		
		if ($this->request->is('post')) {
			
			// webcontentPage
			$this->request->data['Webcontent']['path'] = $this->_saveToFile(array_pop($this->request->data));
			
			// plainText
			$plainText = array_pop($this->request->data);
			
			// selectedTagIDs
			$tagsStr = array_pop($this->request->data);

			$this->request->data['Webcontent']['user_id'] = $this->_getCurrentUserID();

			$this->Webcontent->create();
			if ($this->Webcontent->save($this->request->data)) {
				$pageId = $this->Webcontent->id;
				if(!$this->WebcontentsTag->saveContentAsscoTags($pageId, $this->_tagNames2ID($tagsStr))) {
					echo 'Saving tags failed.';
				};
				
				if(!$this->SearchIndex->createIndex($plainText, 1, $pageId)) {
					echo 'Creating search-index failed.';
					$this->Session->setFlash(__('Create search-index failed.'));			
				}
				
				return $this->redirect(array('action' => 'index'));
			} else {
				debug($this->Webcontent->validationErrors);
				$this->Session->setFlash(__('Unable to add the tag.'));
			}
		}
	}

	public function preview() {
	}

	public function view($id) {
		if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $webcontent = $this->Webcontent->find('first',array(
				'conditions' => array('Webcontent.id' => $id),
				'recursive' => 1)
				);
        if (!$webcontent) {
            throw new NotFoundException(__('Invalid post'));
        }
    
        if ($this->request->is('get')) {
        	$this->set('webcontent',$webcontent);
			
			$page = '';
			$file = new File($webcontent['Webcontent']['path']);
			if($file->open('rb')) {
				$page = $file->read();
    		} else {
        		echo "open ".$file->pwd()." failed";
    		}
    		$file->close();
			$this->set('page',$page);
			
			// $this->User->unbindAll(); // 查询完成后有没有再绑定
			$comments = $this->Comment->find('all', array(
				'conditions' => array(
					'Comment.webcontent_id' => $id,
					'Comment.parent_comment_id' => null,
					),
				'recursive' => 2,
				'order' => 'Comment.created ASC')
				);
			$this->set('comments', $comments);
        }
	}

	public function getMostViewedArticals() {
		return $this->Webcontent->find('all',
			array(
				'recursive' => -1,
				'fields' => array('id', 'title', 'abstract'),
				'limit' => 3,
				'order' => 'browse_count DESC'
			));
	}
	
	public function getWebcontentInfoById($value) {
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		
		return $this->Webcontent->find('first', array('fields' => array('title', 'created'),
														'conditions' => array('id' => $value),
														'recursive' => -1));
	}
	
	public function getCategories() {
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$categories[0] = '全部';
		$categories += $this->_getCategories();
		return $categories;
	}
	
	protected function _getCategories() {
		$categories = array(1 => '新闻',2 => '文章', 3 => '视频', 4 => '图片',
							5 => '游戏', 6 => '心理测试', 7 => '公告');
		return $categories;
	}

	protected function _getCurrentUserID() {
		return $this->Auth->user('id');
	}

	protected function _saveToFile($content) {
		$dir = new Folder('./pages');
		$file = new File($dir->pwd().DS.time().'.inc', true, 0644);
		if($file->open('wb')) {
			$file->write($content);
			$file->close();
			return $file->pwd();
    	} else {
        	echo "open ".$file->pwd()." failed";
			$file->close();
			return NULL;
		}
	}
	
	public function postComment($pageId = NULL, $parentCommentId = NULL) {
		if($this->request->is('get')) {
			if($pageId == NULL) {
				// should pop up some error massage and return to previous page
				return $this->redirect(array('action' => 'index'));
			}
			$this->set('webcontentId', $pageId);
			if($parentCommentId != NULL) {
				$parentComment = $this->Comment->find('first',array(
					'conditions' => array('Comment.id' => $parentCommentId),
					'recursive' => 0));
				if($parentComment) {
					$this->set('parentComment',$parentComment);
					// WebcontentsController::_echoArray($parentComment);
				} else {
					// should pop up some error massage and return to previous page
				}
			}
		}
		
		if ($this->request->is('post')) {
			$this->request->data['Comment']['commentor_id'] = $this->_getCurrentUserID();
			// WebcontentsController::_echoArray($this->request->data);
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				return $this->redirect(array('action' => 'view',
					$this->request->data['Comment']['webcontent_id']));
			} else {
				debug($this->Comment->validationErrors);
				$this->Session->setFlash(__('Unable to add the tag.'));
			}
		}
	}
	
	protected function _tagNames2ID($str) {
		$names = explode('`', $str);
		$tagIdArray = array();
		// print_r($names);
		foreach ($names as $key => $value) {
			$tagId = $this->Tag->find('first', array(
				'conditions' => array('tag' => $value),
				'recursive' => -1,
				'fields' => array('id')
				)
			);
			
			if($tagId == NULL) {
				$tagName = array(
					'Tag' => array(
						'tag' => $value
					)
				);
				
				$this->Tag->create();				
				if($this->Tag->save($tagName,TRUE,array('tag'))) {
					$tagIdArray[] = $this->Tag->id;
					$this->Tag->clear();
				} else {
					$this->Tag->clear();
					echo 'Save tag failed';
				}
			} else {
				$tagIdArray[] = $tagId['Tag']['id'];
			}
		}
		
		return $tagIdArray;
	}
	
	public function afterFilter() {
		if($this->request->param('action') == 'view') {
			$id = $this->request->param('pass');
			$this->Webcontent->browsedOnce($id);
		}
		parent::afterFilter();
	}
}

?>
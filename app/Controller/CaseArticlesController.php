<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class CaseArticlesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Session', 'Paginator');
    public $uses = array('CaseArticle', 'Expert', 'SearchIndex');

    public $paginate = array(
        'limit' => 3,
        'order' => array(
            'CaseArticle.created' => 'desc'
        ),
        'recursive' => 1
    );
    
    public function index () {
        $this->Paginator->settings = $this->paginate;
        $this->set('caseArticles', $this->Paginator->paginate('CaseArticle'));
    }

    public function operate () {
        $this->CaseArticle->recursive = 0;
        $this->set('caseArticles',$this->paginate());
    }
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('无效的ID'));
        }
        $caseArticle = $this->CaseArticle->findById($id);
        if (!$caseArticle) {
            throw new NotFoundException(__('无效的 caseArticle'));
        }
        $this->set('caseArticle', $caseArticle);
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->CaseArticle->create();

            $user_id = $this->Auth->user('id');
            $expert_profile = $this->Expert->find('first', array('fields' => array('realname'), 'conditions' => array('consultant_id' => $user_id)));
            $realname = $expert_profile['Expert']['realname'];

            $title = $this->request->data['title'];
            // $body = $this->request->data['body'];
            $abstract = $this->request->data['abstract'];
            $photo_name = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], "./img/cases_photos/".$photo_name);
            $this->request->data['CaseArticle']['photo'] = $photo_name;
            $this->request->data['CaseArticle']['title'] = $title;
            $this->request->data['CaseArticle']['body'] = htmlspecialchars(stripcslashes($this->request->data['body']));
            $this->request->data['CaseArticle']['abstract'] = $abstract;
            $this->request->data['CaseArticle']['owner_id'] = $user_id;
            $this->request->data['CaseArticle']['source'] = $realname;

            $text = $this->request->data['CaseArticle']['body'];
            $type = 3;

            if($this->CaseArticle->save($this->request->data)) {

                $content_id = $this->CaseArticle->id;
                if(!$this->SearchIndex->createIndex($text, $type, $content_id)) {
                    echo 'Creating search-index failed.';
                    $this->Session->setFlash(__('Create search-index failed.'));
                }

                $this->Session->setFlash(__('案例添加成功!'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('案例添加失败!'));
                return $this->redirect(array('action' => 'add'));
            }
            
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('无效的ID'));
        }
        $caseArticle = $this->CaseArticle->findById($id);
        if (!$caseArticle) {
            throw new NotFoundException(__('无效的caseArticle'));
        }
    
        if (!$this->request->data) { //$this->request->is('get')) {
            $this->request->data = $caseArticle;
        }
        if ($this->request->is(array('caseArticle', 'put')) ) {
            $this->CaseArticle->id = $id;
            if ($this->CaseArticle->save($this->request->data)) {
                $this->Session->setFlash(__('案例信息已被更新!'));
                return $this->redirect(array('action' => 'operate'));
            } else {
                $this->Session->setFlash(__('案例信息更新失败!'));
                return $this->redirect(array('action' => 'operate'));
            }
            
        }        
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->CaseArticle->delete($id)) {
            $this->Session->setFlash(__('ID: %s 删除成功!', h($id)));
            return $this->redirect(array('action' => 'operate'));
        } else {
            $this->Session->setFlash(__('ID: %s 删除失败!', h($id)));
            return $this->redirect(array('action' => 'operate'));
        }
    }

    public function getCaseArticleById($value) {
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        
        return $this->CaseArticle->find('first', array('fields' => array('title', 'created'),
                                                        'conditions' => array('id' => $value),
                                                        'recursive' => -1));
    }

}
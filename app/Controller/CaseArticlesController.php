<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class CaseArticlesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Session', 'Paginator');
    public $uses = array('CaseArticle', 'Expert', 'SearchIndex', 'CaseComment');

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

        $caseComments = $this->CaseComment->find('all', array(
            'conditions' => array(
                'caseComment.case_article_id' => $id,
                'caseComment.parent_comment_id' => null,
                ),
            'recursive' => 2,
            'order' => 'CaseComment.created ASC')
            );
        $this->set('caseComments', $caseComments);

        $count = $this->CaseArticle->findById($id);
        $count_number = $count['CaseArticle']['count'];
        $count_number = $count_number + 1;
        $this->CaseArticle->updateAll(array('CaseArticle.count'=>$count_number),array('CaseArticle.id'=>$id));
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

    public function postComment($pageId = NULL, $parentCommentId = NULL) {
        if($this->request->is('get')) {
            if($pageId == NULL) {
                // should pop up some error massage and return to previous page
                return $this->redirect(array('action' => 'index'));
            }
            $user_id = $this->_getCurrentUserID();
            $this->set('caseArticleId', $pageId);
            $this->set('commentorId', $user_id);
            if($parentCommentId != NULL) {
                $parentComment = $this->CaseComment->find('first',array(
                    'conditions' => array('CaseComment.id' => $parentCommentId),
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
            $this->request->data['CaseComment']['commentor_id'] = $this->_getCurrentUserID();
            // WebcontentsController::_echoArray($this->request->data);

            $comment = $this->CaseArticle->findById($pageId);
            $commentCount = $comment['CaseArticle']['comment_number'];
            $commentCount = $commentCount + 1;
            $this->CaseArticle->updateAll(array('CaseArticle.comment_number' => $commentCount),array('CaseArticle.id' => $pageId));

            $this->CaseComment->create();
            if ($this->CaseComment->save($this->request->data)) {
                return $this->redirect(array('action' => 'view',
                    $this->request->data['CaseComment']['case_article_id']));
            } else {
                debug($this->CaseComment->validationErrors);
                $this->Session->setFlash(__('Unable to add the tag.'));
            }
        }
    }

    protected function _getCurrentUserID() {
        return $this->Auth->user('id');
    }

}
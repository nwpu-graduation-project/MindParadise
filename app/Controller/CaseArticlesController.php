<?php
class CaseArticlesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Session', 'Paginator');
    
    public function index () {
        $this->CaseArticle->recursive = 0;
        $this->set('caseArticles',$this->paginate());
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

            $title = $this->request->data['title'];
            $body = $this->request->data['body'];
            $photo_name = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], "./img/uploads/".$photo_name);
            $this->request->data['CaseArticle']['photo'] = $photo_name;
            $this->request->data['CaseArticle']['title'] = $title;
            $this->request->data['CaseArticle']['body'] = $body;
            if($this->CaseArticle->save($this->request->data)) {
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

}

?>
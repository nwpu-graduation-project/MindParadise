<?php

class ExpertsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('Session', 'Paginator');
    public $uses = array('Contact', 'Expert');
    
    public function index () {
    	$this->Expert->recursive = 0;
        $this->set('experts',$this->paginate());
    }

    public function operate () {
        $this->Expert->recursive = 0;
        $this->set('experts',$this->paginate());

        $experts = $this->Expert->find('all');
        $this->set('experts', $experts);
    }

    public function add() {
    	if ($this->request->is('post')) {
    		$this->Expert->create();

    		
    		$alias = $this->request->data['alias'];
    		$realname = $this->request->data['realname'];
    		$age = $this->request->data['age'];
    		$gender = $this->request->data['gender'];
    		$education = $this->request->data['education'];
    		$phone = $this->request->data['phone'];
    		$qq_number = $this->request->data['qq_number'];
    		$email = $this->request->data['email'];
    		$microblog = $this->request->data['microblog'];
    		$blog = $this->request->data['blog'];
    		$weixin_number = $this->request->data['weixin_number'];
    		$personal_information = $this->request->data['personal_information'];
    		$experience = $this->request->data['experience'];
    		$profession = $this->request->data['profession'];
    		$price = $this->request->data['price'];

    		$picture_name = $_FILES['avatar']['name'];
    		move_uploaded_file($_FILES['avatar']['tmp_name'], "./img/experts_photos/".$picture_name);

    		$this->request->data['Expert']['avatar'] = $picture_name;
    		$this->request->data['Expert']['alias'] = $alias;
    		$this->request->data['Expert']['realname'] = $realname;
    		$this->request->data['Expert']['age'] = $age;
    		$this->request->data['Expert']['gender'] = $gender;
    		$this->request->data['Expert']['education'] = $education;
    		$this->request->data['Expert']['phone'] = $phone;
    		$this->request->data['Expert']['qq_number'] = $qq_number;
    		$this->request->data['Expert']['email'] = $email;
    		$this->request->data['Expert']['microblog'] = $microblog;
    		$this->request->data['Expert']['blog'] = $blog;
    		$this->request->data['Expert']['weixin_number'] = $weixin_number;
    		$this->request->data['Expert']['personal_information'] = $personal_information;
    		$this->request->data['Expert']['experience'] = $experience;
    		$this->request->data['Expert']['profession'] = $profession;
    		$this->request->data['Expert']['price'] = $price;

    	
    		
    		if ($this->Expert->save($this->request->data)) {		
				 	$this->Session->setFlash(__('注册成功!'));		 	
				 	return $this->redirect(array('action' => 'index'));
			} else {
                    $this->Session->setFlash(__('注册失败!'));          
                    return $this->redirect(array('action' => 'add'));
            }
    	}
    }

    public function view($id = null) {

        if (!$id) {
            throw new NotFoundException(__('id 为空'));
        }

        $expert = $this->Expert->findById($id);

        if (!$expert) {
            throw new NotFoundException(__('无效的$expert'));
        }

        $this->set('expert', $expert);
        $user_id = $this->Auth->user('id');
        $this->set('user_id', $user_id);

        $contacts = $this->Contact->find('all', array(
            'conditions' => array(
                'Contact.expert_id' => $id,
                'Contact.parent_comment_id' => null,
                ),
            'recursive' => 2,
            'order' => 'Contact.created ASC')
            );
        $this->set('contacts', $contacts);
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Expert->delete($id)) {
            $this->Session->setFlash(__('ID为: %s 专家已被删除成功!', h($id)));
            return $this->redirect(array('action' => 'operate'));
        } else {
            $this->Session->setFlash(__('ID为: %s 专家已被删除失败!', h($id)));
            return $this->redirect(array('action' => 'operate'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('无效的ID'));
        }
        $expert = $this->Expert->findById($id);
        if (!$expert) {
            throw new NotFoundException(__('无效的专家'));
        }
    
        if (!$this->request->data) { 
            $this->request->data = $expert;
        }
        if ($this->request->is(array('post', 'put')) ) {
            $this->Expert->id = $id;
            $this->request->data['Expert']['modified_time'] = date('Y-m-d H:i:s');
            if ($this->Expert->save($this->request->data)) {
                $this->Session->setFlash(__('你的信息已被更新!'));
                return $this->redirect(array('action' => 'operate'));
            }
            $this->Session->setFlash(__('你的信息修改失败,请重新操作或注销!'));
            return $this->redirect(array('action' => 'operate'));
        } 
    }

    public function postComment($pageId = NULL, $parentCommentId = NULL) {
        if($this->request->is('get')) {
            if($pageId == NULL) {
                // should pop up some error massage and return to previous page
                return $this->redirect(array('action' => 'index'));
            }
            $user_id = $this->_getCurrentUserID();
            $this->set('expertId', $pageId);
            $this->set('commentorId', $user_id);
            if($parentCommentId != NULL) {
                $parentComment = $this->Contact->find('first',array(
                    'conditions' => array('Contact.id' => $parentCommentId),
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
            $this->request->data['Contact']['commentor_id'] = $this->_getCurrentUserID();
            // WebcontentsController::_echoArray($this->request->data);
            $this->Contact->create();
            if ($this->Contact->save($this->request->data)) {
                return $this->redirect(array('action' => 'view',
                    $this->request->data['Contact']['expert_id']));
            } else {
                debug($this->Contact->validationErrors);
                $this->Session->setFlash(__('Unable to add the tag.'));
            }
        }
    }

    protected function _getCurrentUserID() {
        return $this->Auth->user('id');
    }
}
<?php 
class DocumentsController extends AppController{
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	public $uses = array('Customer', 'Document', 'Expert');

	public function index() {

		$titles = $this->Document->find('all', array('fields' => 'title'));
		$this->set('titles', $titles);

		$this->set('documents', $this->Document->find('all'));
		if ($this->request->is('get')) {
			
			// return $this->redirect(array('action' => 'index'));
		}

		if ($this->request->is('post')) {
			$title = $this->request->data['title'];
			$this->Session->setFlash($title);
			$this->set('documents', $this->Document->find('all', array('conditions' => array('Document.title' => $title))));
			// return $this->redirect(array('action' => 'index'));
		}


		//$case_id = $this->Document->find('all', array('fields' => array('case_id')));
		//var_dump($case_id);
		//$customer_name = $this->Customer->find('list', array('fields' => array('Customer.first_name', 'Customer.family_name'),
		//	'conditions' => array('Customer.id' => $case_id['Document']['case_id'])));
	   // var_dump($customer_name);
	}

	public function view($id) {
		if (!$id) {
			throw new NotFoundException(__("无效的id!"));	
		}

		$document = $this->Document->findById($id);
		if (!$document) {
			throw new NotFoundException(__("无效的案例!"));	
		}
		$this->set('document', $document);

		$expert_id = $this->Expert->find('first', array('fields' => 'id','conditions' => array('consultant_id' => $document['Document']['consultant_id'])));
		$expert = $this->Expert->findById($expert_id['Expert']['id']);
		$this->set('expert', $expert);
		
		$case_id = $this->Document->find('first', array('fields' => 'case_id', 'conditions' => array('id' => $id)));
		$customer = $this->Customer->findById($case_id['Document']['case_id']);
		$this->set('customer', $customer);



	}

	public function add() {

		if ($this->request->is('post')) {
			$this->Document->create();

			$consultant_id = $this->Auth->user('id');
			$this->request->data['Document']['consultant_id'] = $consultant_id;
		
			if ($this->Document->save($this->request->data)) {
				$this->Session->setFlash(__('添加案例成功!'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('添加案例失败!'));
				return $this->redirect(array('action' => 'add'));
			}

		}

	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__("无效的id!"));	
		}

		$document = $this->Document->findById($id);
		if (!$document) {
			throw new NotFoundException(__("无效的案例!"));	
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Document->id = $id;

			if ($this->Document->save($this->request->data)) {
				$this->Session->setFlash(__('修改案例成功!'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('修改案例失败!'));
				return $this->redirect(array('action' => 'edit'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $document;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Document->delete($id)) {
			$this->Session->setFlash(__('id为%s已被成功删除', h($id)));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('id为%s删除失败', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function display() {
		if ($this->request->is('post')) {
			$titles = $this->Document->find('all', array('fields' => 'title'));
			$this->set('titles', $titles);
			$title = $this->request->data['title'];
			if ($title) {
				$this->set('title', $title);
				$this->set('documents', $this->Document->find('all', array('conditions' => array('Document.title' => $title))));
			} else {
				$this->set('documents', $this->Document->find('all'));
			}
		}
	}



















}
?>
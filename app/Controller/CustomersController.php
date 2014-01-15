<?php 
	class CustomersController extends AppController {
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');

		public function index() {
			$this->set('customers', $this->Customer->find('all'));
		}

		public function add() {
			if ($this->request->is('post')) {
				$this->Customer->create();

				$this->request->data['Customer']['owner_id'] = $this->Auth->user('id');
		
				if ($this->Customer->save($this->request->data)) {
					$this->Session->setFlash(__('添加客户资料成功!'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('添加客户资料失败!'));
					return $this->redirect(array('action' => 'add'));
				}

			}
		}

		public function edit($id = null) {
			if (!$id) {
				throw new NotFoundException(__("无效的id!"));	
			}

			$customer = $this->Customer->findById($id);
			if (!$customer) {
				throw new NotFoundException(__("无效的案例!"));	
			}

			if ($this->request->is(array('post', 'put'))) {
				$this->Customer->id = $id;

				if ($this->Customer->save($this->request->data)) {
					$this->Session->setFlash(__('修改客户资料成功!'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('修改客户资料失败!'));
					return $this->redirect(array('action' => 'edit'));
				}
			}

			if (!$this->request->data) {
				$this->request->data = $customer;
			}
		}

		public function delete($id) {
			if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			}

			if ($this->Customer->delete($id)) {
				$this->Session->setFlash(__('id为%s的客户资料已被成功删除', h($id)));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('id为%s的客户资料删除失败', h($id)));
				return $this->redirect(array('action' => 'index'));
			}
		}

		public function view($id) {
			if (!$id) {
            	throw new NotFoundException(__('id 为空'));
       	 	}

        	$customer = $this->Customer->findById($id);

        	if (!$customer) {
          	  throw new NotFoundException(__('无效的$customer'));
        	}

        	$this->set('customer', $customer);
		}

	}

?>
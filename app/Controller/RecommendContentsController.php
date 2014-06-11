<?php

class RecommendContentsController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session', 'RequestHandler');
	public $uses = array('RecommendContent');

	private $MAX_ENTRIES = 6;

	public function beforeFilter() {
		
		if(!parent::checkAdmin())
		{
			// error
			$this->redirect("/users/index");
		}
		parent::beforeFilter();
	}

	function index()
	{
		$recommendEntries = $this->RecommendContent->find('all',array(
				'fields' => array('id', 'title', 'url'),
				'order' => 'listorder'
				));
		$this->set('recommendEntries', $recommendEntries);
	}

	function add()
	{
		if ($this->request->is('post')) {
			$action = null;
			if(isset($this->request->data['action']))
				$action = $this->request->data['action'];
			if($action != 'autoAdd')
			{
				// 达到最大条目 6
				$count = $this->RecommendContent->find('count');
				if($count >= $this->MAX_ENTRIES)
				{
					$this->Session->setFlash(__('已达到最大添加数，请删除一些再添加.'));
			 		$this->redirect(array('action' => 'index'));
				}
					
				define( 'ROOT_PATH', WWW_ROOT.'upload'.DS.'recommend_pictures'.DS);

				$file = $this->request->data['RecommendContent']['picture'];
				// 判断是否有文件上传（恒成立，前台设置requiret=true属性）
				if ($file['name'] != '') {
				    $ext = pathinfo($file['name']);
				    $ext = strtolower($ext['extension']);
				    $tempFile = $file['tmp_name'];
				    $targetPath   = ROOT_PATH;
				    if( !is_dir($targetPath) ){
				        mkdir($targetPath,0775,true);
				    }
				    $timestamp = time();
				    $new_file_name = $timestamp.'.'.$ext;
				    $targetFile = $targetPath . $new_file_name;
				    move_uploaded_file($tempFile,$targetFile);
				    if( !file_exists( $targetFile ) ){
				        
				        $this->Session->setFlash(__('图片上传失败.'));
				    } else if( !$imginfo=$this->__getImageInfo($targetFile) ) {
				       	$this->Session->setFlash(__('图片文件不存在.'));
				    } else {

				   		// rewrite the request data field picture
				   		// $this->request->data = array_merge($this->request->data, array('picture' => $targetFile));
				   		$pic_name = DS.'upload'.DS.'recommend_pictures'.DS.$new_file_name;
				   		$this->request->data['RecommendContent']['picture'] = $pic_name;

				   		$this->RecommendContent->create();
			 			if ($this->RecommendContent->save($this->request->data)) {
			 				$this->Session->setFlash(__('添加成功.'));
			 			    $this->redirect(array('action' => 'index'));
			 			}
			 			$this->Session->setFlash(__('无法添加.'));

			    	}
				} else {
				    $this->Session->setFlash(__('未提供图片.'));
				}
				
			}
			else
			{
				$saveData = array('RecommendContent' => array(
					'title' => $this->request->data['title'],
					'abstract' => $this->request->data['abstract'],
					'url' => $this->request->data['url'],
				));
				$this->request->data = $saveData;
			}
 		}
	}


	function edit($id)
	{
		if (!$id) {
 			throw new NotFoundException(__('Invalid RecommendContent'));
 		}
 		$entry = $this->RecommendContent->findById($id);
 		if (!$entry) {
 			throw new NotFoundException(__('Invalid RecommendContent'));
 		}

 		if ($this->request->is(array('post', 'put'))) {

 			define( 'ROOT_PATH', WWW_ROOT.'upload'.DS.'recommend_pictures'.DS);

			$file = $this->request->data['RecommendContent']['picture'];
			// 判断是否有文件上传， 用户可以不修改图片
			if ($file['name'] != '') {
			    $ext = pathinfo($file['name']);
			    $ext = strtolower($ext['extension']);
			    $tempFile = $file['tmp_name'];
			    $targetPath   = ROOT_PATH;
			    if( !is_dir($targetPath) ){
			        mkdir($targetPath,0775,true);
			    }
			    $timestamp = time();
			    $new_file_name = $timestamp.'.'.$ext;
			    $targetFile = $targetPath . $new_file_name;

			    move_uploaded_file($tempFile,$targetFile);
			    if( !file_exists( $targetFile ) ){
			        $this->Session->setFlash(__('图片上传失败.'));
			    } else if( !$imginfo=$this->__getImageInfo($targetFile) ) {
			       	$this->Session->setFlash(__('图片文件不存在.'));
			    } else {
			    	// delete the old picture
			    	$old_picture = $entry['RecommendContent']['picture'];
			    	$old_picture_path = WWW_ROOT.substr($old_picture, 1);
			    	if(!unlink($old_picture_path))
			    	{
			    		$this->Session->setFlash(__('删除旧图失败.'));
			    	}
			    	else
			    	{
			    		// rewrite the request data field picture
				   		$pic_name = DS.'upload'.DS.'recommend_pictures'.DS.$new_file_name;
				   		$this->request->data['RecommendContent']['picture'] = $pic_name;

						$this->RecommendContent->id = $id;
			 			if ($this->RecommendContent->save($this->request->data)) {
			 				$this->Session->setFlash(__('添加成功.'));
			 			    $this->redirect(array('action' => 'index'));
			 			}
			 			$this->Session->setFlash(__('无法添加.'));
			    	}
			   		
		    	}
			} else {
				$this->RecommendContent->id = $id;
				// 取消picture字段，不更新
				unset($this->request->data['RecommendContent']['picture']);
	 			if ($this->RecommendContent->save($this->request->data)) {
	 				$this->Session->setFlash(__('添加成功.'));
	 			    $this->redirect(array('action' => 'index'));
	 			}
		 		$this->Session->setFlash(__('无法添加2.'));
			}	
 		}
 		if (!$this->request->data) {
 			$this->request->data = $entry;
 		}
	}

	function delete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		// 删除图片资源
		$entry = $this->RecommendContent->findById($id);
		if($entry)
		{
			// delete the old picture
	    	$old_picture = $entry['RecommendContent']['picture'];
	    	$old_picture_path = WWW_ROOT.substr($old_picture, 1);
	    	if(!unlink($old_picture_path))
	    	{
	    		$this->Session->setFlash(__('删除旧图失败.'));
	    	}
		}
		if ($this->RecommendContent->delete($id)) {
			$this->Session->setFlash(
				__('The entry with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}

	function updateOrder()
	{
		if ($this->request->is(array('post'))) 
 		{
 			$requestData = $this->request->data;
 			$arrayOrder = $requestData['arrayorder'];
 			$action = $requestData['action'];
 			if ($action == "update")
 			{
				$count = 1;
				foreach ($arrayOrder as $idval) {
					$this->RecommendContent->id = $idval;
					$this->RecommendContent->save(array('listorder' => $count));
					$count ++;	
				}	
			}
 			echo '顺序已经更新';
			exit();
 		}

		

	}


	private function __getImageInfo( $img ){
			$imageInfo = getimagesize($img);
			if( $imageInfo!== false) {
				$imageType = strtolower(substr(image_type_to_extension($imageInfo[2]),1));
				$info = array(
						"width"		=>$imageInfo[0],
						"height"	=>$imageInfo[1],
						"type"		=>$imageType,
						"mime"		=>$imageInfo['mime'],
				);
				return $info;
			}else {
				return false;
			}
	}
	
	
}
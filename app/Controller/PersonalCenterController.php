<?php

class PersonalCenterController extends AppController
{
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Paginator', 'RequestHandler');
	public $uses = array('User','Comment','UserProfile','Expert','AdministratorProfile','Blogroll');

	///////////////////////////////////////////// 个人中心首页//////////////////////////////////////////
	function index()
	{
		$currentUser = parent::currentUser();

		if(!$currentUser)
		{
			// erro 
			// set flash
			// redirect to login

		}

		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$this->render("_index_for_user");
				break;
			case 3: // consultant
				$this->render("_index_for_consultant");
				break;
			case 4: // administrator
				$this->render("_index_for_admin");
				break;
			default: // error
		}
	}

	///////////////////////////////////////////// 个人信息 ////////////////////////////////////////////
	// 个人档案查询
	function profileView()
	{
		$profile = $this->_getCurrentUserProfileModelNameAndObj();
		$profileModelName = $profile['profileModelName'];
		$profileInfo 	  = $profile['profileInfo'];
		$this->set('profile', $profileInfo);

		$currentUser = parent::currentUser();
		switch($currentUser['User']['role'])
		{
			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
			
				$this->render("_profile_view_for_user");
				break;
			case 3: // consultant
				$this->render("_profile_view_for_consultant");
				break;
			case 4: // administrator
				$this->render("_profile_view_for_admin");
				break;
			default: // error
		}
	}

	// 个人档案修改
	function profileEdit()
	{
		
		$profile = $this->_getCurrentUserProfileModelNameAndObj();
		$profileModelName = $profile['profileModelName'];
		$profileInfo 	  = $profile['profileInfo'];

		if ($this->request->is(array('post', 'put'))) {

			$this->$profileModelName->id = $profileInfo[$profileModelName]['id'];
			if ($this->$profileModelName->save($this->request->data)) {
				$this->Session->setFlash(__('你的信息已经被更新.'));
			return $this->redirect(array('action' => 'profileView'));
			}
			$this->Session->setFlash(__('更新失败.'));
		}

		if (!$this->request->data) 
		{
			$this->request->data = $profileInfo;
		}


		$currentUser = parent::currentUser();
		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$this->render("_profile_edit_for_user");
				break;
			case 3: // consultant
				$this->render("_profile_edit_for_consultant");
				break;
			case 4: // administrator
				$this->render("_profile_edit_for_admin");
				break;
			default: // error
		}
	}
	// 修改头像
	function modifyAvatar($act = null)
	{
		define( 'ROOT_PATH', WWW_ROOT.'upload'.DS.'uploads'.DS.$this->Auth->user('id').DS);

		function getImageInfo( $img ){
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

		function resize( $ori ){
			if( preg_match('/^http:\/\/[a-zA-Z0-9]+/', $ori ) ){
				return $ori;
			}
			$info = getImageInfo( ROOT_PATH . $ori );
			if( $info ){
		        //上传图片后切割的最大宽度和高度
				$width = 500;
				$height = 500;
				$scrimg = ROOT_PATH . $ori;
		        if( $info['type']=='jpg' || $info['type']=='jpeg' ){
		            $im = imagecreatefromjpeg( $scrimg );
		        }
				if( $info['type']=='gif' ){
					$im = imagecreatefromgif( $scrimg );
				}
				if( $info['type']=='png' ){
					$im = imagecreatefrompng( $scrimg );
				}
				if( $info['width']<=$width && $info['height']<=$height ){
					return;
				} else {
					if( $info['width'] > $info['height'] ){
						$height = intval( $info['height']/($info['width']/$width) );
					} else {
						$width = intval( $info['width']/($info['height']/$height) );
					}
				}
				$newimg = imagecreatetruecolor( $width, $height );
				imagecopyresampled( $newimg, $im, 0, 0, 0, 0, $width, $height, $info['width'], $info['height'] );
				imagejpeg( $newimg, ROOT_PATH . $ori );
				imagedestroy( $im );
			}
			return;
		}

		if($act == 'upload')
		{
			if (!empty($_FILES)) {
			    $ext = pathinfo($_FILES['Filedata']['name']);
			    $ext = strtolower($ext['extension']);
			    $tempFile = $_FILES['Filedata']['tmp_name'];
			    $targetPath   = ROOT_PATH;
			    if( !is_dir($targetPath) ){
			        mkdir($targetPath,0775,true);
			    }
			    $timestamp = time();
			    $new_file_name = $timestamp.'_ori.'.$ext;
			    $targetFile = $targetPath . $new_file_name;
			    move_uploaded_file($tempFile,$targetFile);
			    if( !file_exists( $targetFile ) ){
			        $ret['result_code'] = 0;
			        $ret['result_des'] = 'upload failure';
			    } elseif( !$imginfo=getImageInfo($targetFile) ) {
			        $ret['result_code'] = 101;
			        $ret['result_des'] = 'File is not exist';
			    } else {
			    	// delete other same name with different extension.
			    	$this->_rmPreviewsFiles($targetFile);

					resize($new_file_name);
			        $img = DS.'upload'.DS.'uploads'.DS.$this->Auth->user('id').DS.$new_file_name;
			        $ret['result_code'] = 1;
			        $ret['result_des'] = $img;

			    }
			} else {
			    $ret['result_code'] = 100;
			    $ret['result_des'] = 'No File Given';
			}
			exit( json_encode( $ret ) );

		}

		// get the current user profile model name and profile object.
		$profile = $this->_getCurrentUserProfileModelNameAndObj();
		$profileModelName = $profile['profileModelName'];
		$profileInfo 	  = $profile['profileInfo'];


		if($act == 'cut')
		{
			if( !$image = $_POST["img"] ){
			    $ret['result_code'] = 101;
			    $ret['result_des'] = "图片不存在";
			} else {
			    $image = WWW_ROOT . substr($image, 1);
			    $info = getImageInfo( $image);
			    if( !$info ){
			        $ret['result_code'] = 102;
			        $ret['result_des'] = "图片不存在";
			    } else {
					$x = $_POST["x"];
					$y = $_POST["y"];
					$w = $_POST["w"];
					$h = $_POST["h"];
					$width = $srcWidth = $info['width'];
					$height = $srcHeight = $info['height'];
					$type = empty($type)?$info['type']:$type;
					$type = strtolower($type);
					unset($info);
					// 载入原图
					$createFun = 'imagecreatefrom'.($type=='jpg'?'jpeg':$type);
					$srcImg     = $createFun($image);
					//创建缩略图
					if($type!='gif' && function_exists('imagecreatetruecolor'))
						$thumbImg = imagecreatetruecolor($width, $height);
					else
						$thumbImg = imagecreate($width, $height);
					// 复制图片
					if(function_exists("imagecopyresampled"))
						imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth,$srcHeight);
					else
						imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height,  $srcWidth,$srcHeight);
					if('gif'==$type || 'png'==$type) {
						$background_color  =  imagecolorallocate($thumbImg,  0,255,0);
						imagecolortransparent($thumbImg,$background_color);
					}
					// 对jpeg图形设置隔行扫描
					if('jpg'==$type || 'jpeg'==$type)
						imageinterlace($thumbImg,1);

					// 生成图片
					$imageFun = 'image'.($type=='jpg'?'jpeg':$type);
					$thumbname01 = str_replace("ori", "200", $image);
					$thumbname02 = str_replace("ori", "130", $image);
					$thumbname03 = str_replace("ori", "112", $image);
					$imageFun($thumbImg,$thumbname01,100);
					$imageFun($thumbImg,$thumbname02,100);
					$imageFun($thumbImg,$thumbname03,100);
					$thumbImg01 = imagecreatetruecolor(200,200);
					imagecopyresampled($thumbImg01,$thumbImg,0,0,$x,$y,200,200,$w,$h);

					$thumbImg02 = imagecreatetruecolor(130,130);
					imagecopyresampled($thumbImg02,$thumbImg,0,0,$x,$y,130,130,$w,$h);

						$thumbImg03 = imagecreatetruecolor(112,112);
					imagecopyresampled($thumbImg03,$thumbImg,0,0,$x,$y,112,112,$w,$h);

					$imageFun($thumbImg01,$thumbname01,100);
					$imageFun($thumbImg02,$thumbname02,100);
					$imageFun($thumbImg03,$thumbname03,100);

					imagedestroy($thumbImg01);
					imagedestroy($thumbImg02);
					imagedestroy($thumbImg03);
					imagedestroy($thumbImg);
					imagedestroy($srcImg);


					$ret['result_code'] = 1;
					$ret['result_des'] = array(
						"big"   => str_replace(WWW_ROOT, DS, $thumbname01),
						"middle"=> str_replace(WWW_ROOT, DS, $thumbname02),
						"small" => str_replace(WWW_ROOT, DS, $thumbname03)
					);
  
			        // delete other same name with different extension.
					$this->_rmPreviewsFiles($thumbname01);
					$this->_rmPreviewsFiles($thumbname02);
					$this->_rmPreviewsFiles($thumbname03);

					// save the avatar path to the profile table
					$this->$profileModelName->id = $profileInfo[$profileModelName]['id'];
					$data = array($profileModelName => array('avatar' => str_replace(WWW_ROOT, DS, $thumbname03)));
					$this->$profileModelName->save($data);
				}
			}
			echo json_encode($ret);
			exit();
		}

		$avatar = $profileInfo[$profileModelName]['avatar'];
		$this->set('avatar', $avatar);
	}


	//////////////////////////////////////// 个人评论//////////////////////////////////////////////////
 	function commentsOnOthers()
 	{
 		// $this->Comment->unbindModel(array('belongsTo' => array('CommenttedUser')));
 		
		$usernameIndex = array();
		$userSet = $this->User->find('all', array(
				'fields' => array('id', 'username'),
				'recursive' => -1,
			));

		foreach($userSet as $key => $user)
		{
			$usernameIndex = array_merge($usernameIndex, array('id'.$user['User']['id'] => $user['User']['username']));
			//print_r($usernameIndex);
		}
 		
 		$this->Paginator->settings = array(
        					'limit' => 8,
        					'order' => array(
            					'Comment.created' => 'desc'
        					),
        					'recursive' => 0,
    					);

		$commentsOnOthers = $this->Paginator->paginate('Comment', array('Comment.commentor_id' => $this->Auth->user('id')));

		$this->set('commentsOnOthers', $commentsOnOthers);
		$this->set('usernameIndex', $usernameIndex);


 	}

 	function commentsOnSelfContents()
 	{
 		// $this->Comment->unbindModel(array('belongsTo' => array('CommenttedUser')));

 		$this->Paginator->settings = array(
        					'limit' => 8,
        					'order' => array(
            					'Comment.created' => 'desc'
        					),
        					'recursive' => 0,
    					);

		$commentsOnSelfContents = $this->Paginator->paginate('Comment', array('Webcontent.user_id' => $this->Auth->user('id'), 'Comment.parent_comment_id' => null));

		$this->set('commentsOnSelfContents', $commentsOnSelfContents);

 	}

 	function commentsOnSelfComments()
 	{
 		// $this->Comment->unbindModel(array('belongsTo' => array('CommenttedUser')));
 		
 		$this->Paginator->settings = array(
        					'limit' => 8,
        					'order' => array(
            					'Comment.created' => 'desc'
        					),
        					'recursive' => 0,
    					);

		$commentsOnSelfComments = $this->Paginator->paginate('Comment', array('ParentComment.commentor_id' => $this->Auth->user('id')));

		$this->set('commentsOnSelfComments', $commentsOnSelfComments);

 	}

 	/////////////////////////////////////// 用户管理///////////////////////////////////////////////////
 	function userIndex()
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}

 	}

 	function userAdd()
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}

 		if ($this->request->is('post')) {
 			$this->User->create();
 			if ($this->User->save($this->request->data)) {
 				$this->Session->setFlash(__('用户添加成功.'));
 				return ;//$this->redirect(array('action' => 'index'));
 			}
 			$this->Session->setFlash(__('无法添加用户.'));
 		}
 	}

 	function userView($id = null)
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}
 	}

 	function userEdit($id = null)
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}
 	}

 	function userDelete($id = null)
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}
 		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(
			__('The user with id: %s has been deleted.', h($id))
		);
		return $this->redirect(array('action' => 'userIndex'));
		}
 	}

 	////////////////////////////////////////友情链接//////////////////////////////////////////////////
 	function blogrollIndex()
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}
 	}

 	function blogrollAdd()
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}

 		if ($this->request->is('post')) {
 			$this->Blogroll->create();
 			if ($this->Blogroll->save($this->request->data)) {
 				$this->Session->setFlash(__('Your blogroll has been saved.'));
 				return $this->redirect(array('action' => 'blogrollIndex'));
 			}
 			$this->Session->setFlash(__('Unable to add your blogroll.'));
 		}
 	}

 	function blogrollView($id = null)
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}

 		if (!$id) {
 			throw new NotFoundException(__('Invalid blogroll'));
 		}
 		$blogroll = $this->Blogroll->findById($id);
 		if (!$blogroll) {
 			throw new NotFoundException(__('Invalid blogroll'));
 		}
 		$this->set('blogroll', $blogroll);

 	}
 	
 	function blogrollEdit($id = null)
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}

 		if (!$id) {
 			throw new NotFoundException(__('Invalid blogroll'));
 		}
 		$blogroll = $this->Blogroll->findById($id);
 		if (!$blogroll) {
 			throw new NotFoundException(__('Invalid blogroll'));
 		}
 		if ($this->request->is(array('post', 'put'))) {
 			$this->blogroll->id = $id;
 			if ($this->Blogroll->save($this->request->data)) {
 				$this->Session->setFlash(__('Your blogroll has been updated.'));
 				return $this->redirect(array('action' => 'index'));
 			}
 			$this->Session->setFlash(__('Unable to update your blogroll.'));
 		}
 		if (!$this->request->data) {
 			$this->request->data = $blogroll;
 		}


 	}

 	function blogrollDelete($id = null)
 	{
 		if(!parent::checkAdmin())
 		{
 			//error : have no previlege
 		}

 		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Blogroll->delete($id)) {
		$this->Session->setFlash(
		__('The blogroll with id: %s has been deleted.', h($id))
		);
		return $this->redirect(array('action' => 'blogrollIndex'));
		}

 	}

 	////////////////////////////////  function for the class /////////////////////////////////////////
 	public function _getCurrentUserProfileModelNameAndObj()
 	{
 		$currentUser = parent::currentUser();

		if(!$currentUser)
		{
			// erro 
			// set flash
			// redirect to login
		}

		$profileModelName = null;
		$profileInfo = null;
		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$profileModelName = 'UserProfile';
				$profileInfo	= $this->UserProfile->findByUserId($currentUser['User']['id']);
				break;
			case 3: // consultant
				$profileModelName = 'Expert';
				$profileInfo	= $this->Expert->findByConsultantId($currentUser['User']['id']);
				break;
			case 4: // administrator
				$profileModelName = 'AdministratorProfile';
				$profileInfo	= $this->AdministratorProfile->findByAdminId($currentUser['User']['id']);
				break;
			default: // error
		}
		if($profileModelName != null)
			return array('profileModelName' => $profileModelName, 'profileInfo' => $profileInfo);
		else 
			return null;
 	}
 	public function _getUserProfileModelNameAndObj($id)
 	{
 		$user = $this->User->findById($id);

		if(!$user)
		{
			// erro 
			// set flash
			// redirect to login
		}

		$profileModelName = null;
		$profileInfo = null;
		switch($user['User']['role'])
		{

			// case 1: // tourist
			// 	break;
			case 2: // normal user
				$profileModelName = 'UserProfile';
				$profileInfo	= $this->UserProfile->findByUserId($user['User']['id']);
				break;
			case 3: // consultant
				$profileModelName = 'Expert';
				$profileInfo	= $this->Expert->findByConsultantId($user['User']['id']);
				break;
			case 4: // administrator
				$profileModelName = 'AdministratorProfile';
				$profileInfo	= $this->AdministratorProfile->findByAdminId($user['User']['id']);
				break;
			default: // error
		}
		if($profileModelName != null)
			return array('profileModelName' => $profileModelName, 'profileInfo' => $profileInfo);
		else 
			return null;
 	}
 	private function _rmPreviewsFiles($filename)
	{
		$file_path = pathinfo($filename);
		$res = glob($file_path['dirname'].DS.'*'.substr($file_path['filename'], -4).'*');
		if(is_array($res))
		{
			$rmKey = array_search($filename, $res);
			if($rmKey == 0)
				array_shift($res);
			else 
				array_splice($res, $rmKey);
			if(!empty($res))
		    	array_map('unlink', $res);
		    return ;
		}
		return ;
	}

 	
}

?>
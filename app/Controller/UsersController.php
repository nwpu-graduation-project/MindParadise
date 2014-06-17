<?php
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{
  public $uses = array('Webcontent', 'RecommendContent', 'Expert', 'CaseArticle', 'EncyclopediaEntry');
  /**
   *      * Runs automatically before the controller action is called
   *           */
  function beforeFilter()
  {
    $this->Auth->allow('register', 'recover', 'verify', 'index');
    //$this->Auth->autoRedirect = false;
    parent::beforeFilter();
  }
  /**
   *      * Before Render
   *           */
  function beforeRender()
  {
    unset($this->request->data['User']['password']);
    unset($this->request->data['User']['password_confirm']);
    parent::beforeRender();
  }

  /**
   *  index of the web page
   */
  function index()
  {
      // announcement and news module
      $news_and_anouncements = $this->Webcontent->find('all', array(
              'conditions' =>array('Webcontent.category' => array(1,7)),
              'limit' => 8,
              'order' => 'Webcontent.created DESC',
        ));

      $recommend_entries = $this->RecommendContent->find('all', array(
              'order' => 'RecommendContent.listorder'
        ));


      $experts = $this->Expert->find('all', array(
          'limit' => 8,
          'order' => 'id'
        ));

      $popular_cases = $this->CaseArticle->find('all', array(
          'limit' => 6,
          'order' => 'count'
        ));

      $popular_entries = $this->EncyclopediaEntry->find('all', array(
          'limit' => 6,
          //'order' => 'browse_num'
        ));

      $popular_article = $this->Webcontent->find('first', array(
          'conditions' => array('Webcontent.category' => 2),
          'order' => 'browse_count',
        ));

      $popular_picture = $this->Webcontent->find('first', array(
          'conditions' => array('Webcontent.category' => 4),
          'order' => 'browse_count',
        ));

      $popular_vedio  = $this->Webcontent->find('first', array(
          'conditions' => array('Webcontent.category' => 3),
          'order' => 'browse_count',
        ));


      $this->set('news_and_anouncements', $news_and_anouncements);
      $this->set('recommend_entries', $recommend_entries);
      $this->set('experts', $experts);
      $this->set('popular_cases', $popular_cases);
      $this->set('popular_entries', $popular_entries);
      $this->set('popular_article', $popular_article);
      $this->set('popular_picture', $popular_picture);
      $this->set('popular_vedio', $popular_vedio);
  }


  /**
   *      * Registration page for new users
   **/
  function register()
  {
    $this->layout = 'register';
    if(parent::currentUser())
      $this->redirect(array('controller' => 'users', 'action' => 'index'));
    
    if (!empty($this->data)) 
    {
      $this->User->create();
      // set user role to 2(normal user)
      $this->request->data['User'] = array_merge(
          $this->request->data['User'],
          array('role' => 2)
      );

      if ($this->User->save($this->data)) {
        $this->Session->setFlash(__('账户已被创建.', true));
        // Redirect the user
        $id = $this->User->id;
        $this->request->data['User'] = array_merge(
            $this->request->data['User'],
            array('id' => $id)
        );
        $this->Auth->login($this->request->data['User']);
        $this->redirect('/users/index');
      } else {
        $this->Session->setFlash(__('无法创建用户.', true));
      }
    }
  }

  /**
   *      * Account login page
   *           */
  function login()
  {
    $this->layout = 'login';
    if(parent::currentUser())
      $this->redirect(array('controller' => 'users', 'action' => 'index'));
    
    // Check for a successful login
    if ($this->request->is('post')) {
      if($this->Auth->login()) 
      {
          $fields = array('lastlogin' => date('Y-m-d H:i:s'), 'modified' => false);
          $this->User->id = $this->Auth->user('id');
          $this->User->save($fields, false, array('lastlogin'));
        
          $url = array('controller' => 'users', 'action' => 'index');
          if ($this->Session->check('Auth.redirect')) 
          {
              $url = $this->Session->read('Auth.redirect');
          }
          $this->redirect($url);  
      } 
      else 
      {
        $this->Session->setFlash('登录失败');
      }
    }
       
  }

  /**
   *      * Log a user out
   *           */
  function logout()
  {
    return $this->redirect($this->Auth->logout());
  }



  /**
   * Account details page (change password)
   */
  function changePassword()
  {
      $this->User->id = $this->Auth->user('id');

      $this->User->useValidationRules('ChangePassword');

      $this->User->set($this->data);
      if (!empty($this->data) && $this->User->validates()) {
          $password = $this->Auth->password($this->data['User']['password']);
          $this->User->saveField('password', $password);

          $this->Session->setFlash('密码已被修改，请重新登录');
          $this->redirect(array('action' => 'logout'));
      }          
  }

  /**
   * Allows the user to email themselves a password redemption token
   */
  function recover()
  {
      if (parent::currentUser()) 
      {
          $this->redirect(array('controller' => 'users', 'action' => 'index'));
      }
       
      if (!empty($this->data['User']['email'])) {
          $Token = ClassRegistry::init('Token');
          $user = $this->User->findByEmail($this->data['User']['email']);
           
          if ($user == false) {
              $this->Session->setFlash('未找到匹配用户');
              return false;
          }
           
          $token = $Token->generate(array('User' => $user['User']));
          $this->Session->setFlash('已发送一封验证邮件到你的注册邮箱。');
          
          $Email = new CakeEmail('default');
          $Email->to($user['User']['email']);
          $Email->subject('Password Recovery');
          $Email->from('mindparadise.service@gmail.com');
          $Email->template('recover');
          $Email->viewVars(array('user'=>$user,'token'=>$token));
          $Email->send();
      }
  }
   
  /**
   * Accepts a valid token and resets the users password
   */
  function verify($token_str = null)
  {
      if (parent::currentUser()) 
      {
          $this->redirect(array('controller' => 'users', 'action' => 'index'));
      }

      $Token = ClassRegistry::init('Token');
       
      $res = $Token->get($token_str);
      if ($res) {
          // Update the users password
          $password = $this->User->generatePassword();
          $this->User->id = $res['User']['id'];
          $this->User->saveField('password', $this->Auth->password($password));
          $this->set('success', true);

          // Send email with new password
          $Email = new CakeEmail('default');
          $Email->to($res['User']['email']);
          $Email->subject('Password Changed');
          $Email->from('mindparadise.service@gmail.com');
          $Email->template('verify');
          $Email->viewVars(array('user' => $res, 'password' => $password));
          $Email->send();
      }
  }

  

}
?>

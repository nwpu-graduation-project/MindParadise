<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('UserProfile', 'Model');
App::uses('ConsultantProfile', 'Model');
App::uses('Expert', 'Model');
App::uses('AdministratorProfile', 'Model');


class User extends AppModel
{
  /*
  var $role = array(
    'tourist' => 1,
    'normaluser' => 2,
    'consultant' => 3,
    'admin' => 4,
  );
  */
  public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'commentor_id'),
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'user_id'),
    );

  // public $hasOne = array(
  //       'Profile' => array(
  //         'className' => 'UserProfile',
  //         'foreignKey' => 'user_id'),
  //   );


  public function beforeSave($options = array()) 
  {
    if (!$this->id) 
    {
        $this->data['User']['password'] = 
            Security::hash($this->data['User']['password'], null, true);

    }
    return true;
  }
  /**
   * Standard validation behaviour
   */
  public $validate = array(
    'username' => array(
      'length' => array(
        'rule'      => array('minLength', 5),
        'message'   => 'Must be more than 5 characters',
        'required'  => true,
      ),
      'alphanum' => array(
        'rule'      => 'alphanumeric',
        'message'   => 'May only contain letters and numbers',
      ),
      'unique' => array(
        'rule'      => 'isUnique',
        'message'   => 'Already taken',
      ),
    ),
    'email' => array(
      'email' => array(
        'rule'      => 'email',
        'message'   => 'Must be a valid email address',
      ),
      'unique' => array(
        'rule'      => 'isUnique',
        'message'   => 'Already taken',
      ),
    ),
    'password' => array(
      'empty' => array(
        'rule'      => 'notEmpty',
        'message'   => 'Must not be blank',
        'required'  => true,
      ),
    ),
    'password_confirm' => array(
      'compare'    => array(
        'rule'      => array('password_match', 'password', false),
        'message'   => 'The password you entered does not match',
        'required'  => true,
      ),
      'length' => array(
        'rule'      => array('between', 6, 20),
        'message'   => 'Use between 6 and 20 characters',
      ),
      'empty' => array(
        'rule'      => 'notEmpty',
        'message'   => 'Must not be blank',
      ),
    ),
  );


  /**
   *      * Ensure two password fields match
   *      *
   *      * @param   array   data provided by the controller
   *      * @param   string  the original (already hashed) 
   *        password fieldname
   *      * @param   bool    whether the password field 
   *           has been hashed,
   *      *                  only hashed when a 
   *       username input is present
   **/
  function password_match($data, $password_field, $hashed = true)
  {
    $password         = $this->data[$this->alias][$password_field];
    $keys             = array_keys($data);

    
    $password_confirm = $hashed ?
        Security::hash($data[$keys[0]], null, true) :
        $data[$keys[0]];

    return $password === $password_confirm;
  }


  /**
   * Extra form dependent validation rules
   */
  public $validateChangePassword = array(
      '_import' => array('password', 'password_confirm'),
      'password_old' => array(
          'correct' => array(
              'rule'      => 'password_old',
              'message'   => 'Does not match',
              'required'  => true,
          ),
          'empty' => array(
              'rule'      => 'notEmpty',
              'message'   => 'Must not be blank',
          ),
      ),
  );

  /**
   * Dynamically adjust our validation behaviour
   *
   * Look for an _import key in new ruleset, and import
   * those rules from the base validation ruleset
   *
   * @param   string  array key of the validation ruleset to use
   */
  function useValidationRules($key)
  {
      $variable = 'validate' . $key;
      $rules = $this->$variable;
       
      if (isset($rules['_import'])) {
          foreach ($rules['_import'] as $key) {
              $rules[$key] = $this->validate[$key];
          }
          unset($rules['_import']);
      }
       
      $this->validate = $rules;
  }
   

  /**
   * Ensure password matches the user session
   *
   * @param   array   data provided by the controller
   */
  function password_old($data)
  {
      $password = $this->field('password',
          array('User.id' => $this->id));
      return $password ===
          Security::hash($data['password_old'], null, true);
  }


  /**
     * Generate a random pronounceable password
     */
  function generatePassword($length = 10) {
      // Seed
      srand((double) microtime()*1000000);
       
      $vowels = array('a', 'e', 'i', 'o', 'u');
      $cons = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n',
          'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
          'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph',
          'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl');
       
      $num_vowels = count($vowels);
      $num_cons = count($cons);
       
      $password = '';
      for ($i = 0; $i < $length; $i++){
          $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
      }
       
      return substr($password, 0, $length);
  }

  /**
    * Generate a profile for the user when user created
    */

  public function afterSave($created, $options = Array())
  {
    //
    if($created)
    {
      switch($this->data['User']['role'])
      {
        case 1:
        case 2:
          $profileObj = new UserProfile();
          $profileObj->create();
          $data = array('user_id' => $this->id, 'avatar' => '/upload/images/default.gif');
          $profileObj->save($data);
          break;
        case 3:
          $profileObj = new Expert();
          $profileObj->create();
          $data = array('consultant_id' => $this->id, 'avatar' => '/upload/images/default.gif');
          $profileObj->save($data);
          break;
        case 4:
          $profileObj = new AdministratorProfile();
          $profileObj->create();
          $data = array('admin_id' => $this->id, 'avatar' => '/upload/images/default.gif');
          $profileObj->save($data);
          break;
        default:
          //error
      }
    }
    parent::afterSave($created, $options = Array());
  }

  public function beforeDelete($cascade = true)
  {
    // deal with some records depends on the record, set their fk to null or others
  }


}?>

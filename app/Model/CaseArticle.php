<?php
	App::uses('Folder', 'Utility');
	App::uses('File', 'Utility');
	App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class CaseArticle extends AppModel {

    public $validate = array(
        'title' => array('rule' => 'notEmpty'),
        'body' => array('rule' => 'notEmpty'),
    );
}

?>
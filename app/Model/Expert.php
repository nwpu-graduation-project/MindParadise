<?php

	App::uses('Folder', 'Utility');
	App::uses('File', 'Utility');

class Expert extends AppModel {

    public $useTable = "consultant_profiles";
    public $validate = array(
        'realname' => array('required' => array('rule' => array('notEmpty'), 'message' => '真实姓名不能为空!')),
        'education' => array('required' => array('rule' => array('notEmpty'), 'message' => '教育资质不能为空!')),
        'phone' => array('required' => array('rule' => array('notEmpty'), 'message' => '电话不能为空!')),
        'personal_information' => array('required' => array('rule' => array('notEmpty'), 'message' => '个人信息不能为空!')),
        'experience' => array('required' => array('rule' => array('notEmpty'), 'message' => '重点阅历不能为空!')),
        'profession' => array('required' => array('rule' => array('notEmpty'), 'message' => '擅长领域不能为空!')),
        'price' => array('required' => array('rule' => array('notEmpty'), 'message' => '收费标准不能为空!')),
        'photo' => array('required' => array('rule' => array('notEmpty'), 'message' => '图片不能为空!')),
    );

   
}

?>
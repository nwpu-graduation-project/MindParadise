<?php 
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end(); 

?>

<h3>添加用户</h3>
<?php
echo $this->Form->create('User');
?>
<?php
echo $this->Form->input('username', array('label' => false, 'placeholder' => 'username'));
echo $this->Form->input('role', array('options' => array('1' => '游客', '2' => '会员', '3' => '咨询师', '4' => '管理员')));
echo $this->Form->input('password_confirm', array('label' => false, 'placeholder' => 'password', 'type' => 'password'));
echo $this->Form->input('password', array('label' => false, 'placeholder' => 'password confirm'));
echo $this->Form->input('email', array('label' => false, 'placeholder' => 'email'));
echo $this->Form->end('保存');
?>

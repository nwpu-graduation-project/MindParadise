<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end();
?>
<?php $this->start('css');?>
<style>
.text{
	margin-left: 0px;
}
</style>
<?php $this->end();?>

<h3>修改个人基本信息</h3>

<?php echo $this->Form->create('AdminstratorProfile'); ?>
<table>
	<tr><td><?php echo $this->Form->input('family_name', array('type' => 'text', 'label' => '姓')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('first_name', array('type' => 'text', 'label' => '名')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('age', array('label' => '年龄')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('gender', array('label' => '性别', 'options' => array('男', '女') , 'empty' => '请选择')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('phone_number', array('type' => 'tel', 'label' => '电话号码')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('qq_number', array('type' => 'text', 'label' => 'qq号')); ?></td></tr>

	<tr><td><?php echo $this->Form->end('保存修改'); ?></td></tr>
</table>
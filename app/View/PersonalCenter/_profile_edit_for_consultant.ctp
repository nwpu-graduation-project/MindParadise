<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_consultant');
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
<table>
<?php echo $this->Form->create('Expert'); ?>
	<tr><td><?php echo $this->Form->input('alias', array('label' => '别名')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('realname', array('label' => '真实姓名')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('age', array('label' => '年龄')); ?></td></tr>
	<tr><td><?php $sizes = array('男' => '男', '女' => '女');
echo $this->Form->input('gender', array('options' => $sizes, 'default' => '男', 'label' => '性别')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('education', array('label' => '等级认证')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('phone', array('label' => '电话')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('qq_number', array('label' => 'QQ号码')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('microblog', array('label' => '微博帐号')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('blog', array('label' => '博客地址')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('weixin_number', array('label' => '微信微帐号')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('personal_information', array('rows' => '3','label' => '个人信息')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('experience', array('rows' => '3','label' => '重点阅历')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('profession', array('rows' => '3','label' => '擅长领域')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('price', array('rows' => '3','label' => '收费标准')); ?></td></tr>
	<tr><td align ="center"><?php echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('保存修改'); ?></td></tr>
</table>
<?php
$this->extend('/PersonalCenter/common_view');
$this->start('sidebar');
switch($currentUser['User']['role'])
{
	//case 1:
	case 2: echo $this->element("sidebar_user");break;
	case 3: echo $this->element("sidebar_consultant");break;
	case 4: echo $this->element("sidebar_admin");break;
	default://error
}
$this->end();
?>
<?php $this->start('css');?>
<style>
.text{
	margin-left: 0px;
	width:120%;
}
</style>
<?php $this->end();?>
<div class='main'>
	<div class='account'>
<h1>修改案例</h1>
<center>
<table>
	<?php echo $this->Form->create('CaseArticle'); ?>
	<tr><td><?php echo $this->Form->input('title', array('label' => '案例标题', 'size' => '50%')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('body', array('rows' => '30', 'cols' => '50', 'label' => '案例内容')); ?></td></tr>
	<tr align="center"><td><?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
	<?php echo $this->Form->end('保存修改'); ?></td></tr>	
</table>
</center>
</div>
</div>
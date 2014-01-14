<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end();

?>

<h3> 个人信息 </h3>
<div class='clearfix'>
	<div>
		<?php echo $this->Html->image($profile['AdminstratorProfile']['avatar'], array('alt' => '头像')); ?>
	</div>
	<div>
		<?php echo $this->Html->link('修改头像', array('action' => 'modifyAvatar')); ?>
	</div>
</div>
--------------------------------------------------------------
<div>
	<ul>
		<li><label>姓:</label><?php echo $profile['AdminstratorProfile']['family_name']; ?></li>
		<li><label>名:</label><?php echo $profile['AdminstratorProfile']['first_name']; ?></li>
		<li><label>年龄:</label><?php echo $profile['AdminstratorProfile']['age']; ?></li>
		<li><label>性别:</label><?php echo $profile['AdminstratorProfile']['gender']; ?></li>
		<li><label>电话号码:</label><?php echo $profile['AdminstratorProfile']['phone_number']; ?></li>
		<li><label>qq号码:</label><?php echo $profile['AdminstratorProfile']['qq_number']; ?></li>
	</ul>
	<div>
		<?php echo $this->Html->link('修改', array('action' => 'profileEdit')); ?>
	</div>
</div>
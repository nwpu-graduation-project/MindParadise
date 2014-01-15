<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_user');
$this->end();

?>

<h3> 个人信息 </h3>
<div class='clearfix'>
	<div>
		<?php echo $this->Html->image($profile['Expert']['avatar'], array('alt' => '头像')); ?>
	</div>
	<div>
		<?php echo $this->Html->link('修改头像', array('action' => 'modifyAvatar')); ?>
	</div>
</div>
--------------------------------------------------------------
<div>
	<ul>
		<li><label>姓名:</label><?php echo $profile['Expert']['realname']; ?></li>
		<li><label>别名:</label><?php echo $profile['Expert']['alias']; ?></li>
		<li><label>年龄:</label><?php echo $profile['Expert']['age']; ?></li>
		<li><label>性别:</label><?php echo $profile['Expert']['gender']; ?></li>
		<li><label>等级认证</label><?php echo $profile['Expert']['education']; ?></li>
		<li><label>电话:</label><?php echo $profile['Expert']['phone']; ?></li>
		<li><label>QQ号码:</label><?php echo $profile['Expert']['qq_number']; ?></li>
		<li><label>微博帐号:</label><?php echo $profile['Expert']['microblog']; ?></li>
		<li><label>个人博客:</label><?php echo $profile['Expert']['blog']; ?></li>
		<li><label>微信号:</label><?php echo $profile['Expert']['weixin_number']; ?></li>
		<li><label>个人简介:</label><?php echo $profile['Expert']['personal_information']; ?></li>
		<li><label>重点阅历:</label><?php echo $profile['Expert']['experience']; ?></li>
		<li><label>擅长领域:</label><?php echo $profile['Expert']['profession']; ?></li>
		<li><label>收费标准:</label><?php echo $profile['Expert']['price']; ?></li>
	</ul>
	<div>
		<?php echo $this->Html->link('修改', array('action' => 'profileEdit')); ?>
	</div>
</div>
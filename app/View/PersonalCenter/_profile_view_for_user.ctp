<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_user');
$this->end();

?>

<h3> 个人信息 </h3>
<div class='clearfix'>
	<div>
		<?php echo $this->Html->image($profile['UserProfile']['avatar'], array('alt' => '头像')); ?>
	</div>
	<div>
		<?php echo $this->Html->link('修改头像', array('action' => 'modifyAvatar', $user_id)); ?>
	</div>
</div>
--------------------------------------------------------------
<div>
	<ul>
		<li><label>姓:</label><?php echo $profile['UserProfile']['family_name']; ?></li>
		<li><label>名:</label><?php echo $profile['UserProfile']['first_name']; ?></li>
		<li><label>年龄:</label><?php echo $profile['UserProfile']['age']; ?></li>
		<li><label>性别:</label><?php echo $profile['UserProfile']['gender']; ?></li>
		<li><label>生日:</label><?php echo $profile['UserProfile']['birthday']; ?></li>
		<li><label>出生地:</label><?php echo $profile['UserProfile']['birthplace']; ?></li>
		<li><label>现住址:</label><?php echo $profile['UserProfile']['present_address']; ?></li>
		<li><label>民族:</label><?php echo $profile['UserProfile']['nationality']; ?></li>
		<li><label>宗教:</label><?php echo $profile['UserProfile']['religion']; ?></li>
		<li><label>婚恋状态:</label><?php echo $profile['UserProfile']['marital_status']; ?></li>
		<li><label>健康状况:</label><?php echo $profile['UserProfile']['health_condition']; ?></li>
		<li><label>学历:</label><?php echo $profile['UserProfile']['education']; ?></li>
		<li><label>职业:</label><?php echo $profile['UserProfile']['profession']; ?></li>
		<li><label>经济境况:</label><?php echo $profile['UserProfile']['finacial_situation']; ?></li>
		<li><label>电话号码:</label><?php echo $profile['UserProfile']['phone_number']; ?></li>
		<li><label>qq号码:</label><?php echo $profile['UserProfile']['qq_number']; ?></li>
		<li><label>爱好:</label><?php echo $profile['UserProfile']['hobby']; ?></li>
	</ul>
	<div>
		<?php echo $this->Html->link('修改', array('action' => 'profileEdit', $user_id)); ?>
	</div>
</div>
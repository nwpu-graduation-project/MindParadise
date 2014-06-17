
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
<div class='main'>
	<div class='account'>
		
		<h3>修改密码</h3>
		<p>你是<?php echo $currentUser['User']['username']; ?>，最后登录时间是<?php echo $currentUser['User']['lastlogin']; ?>.</p>
		 
		<?php
		echo $this->Form->create('User', array('action' => 'changePassword'));
		echo $this->Form->input('password_old',     array('label' => false, 'placeholder' => '旧密码', 'type' => 'password', 'class' => 'input_2', 'autocomplete' => 'off', 'div' => array('class' => 'clearfix')));
		echo $this->Form->input('password_confirm', array('label' => false, 'placeholder' => '新密码', 'type' => 'password', 'class' => 'input_2', 'autocomplete' => 'off', 'div' => array('class' => 'clearfix')));
		echo $this->Form->input('password', array('label' => false, 'placeholder' => '重新输入新密码', 'class' => 'input_3', 'autocomplete' => 'off', 'div' => array('class' => 'clearfix')));
		
		echo $this->Form->end(array('class' => 'register_img', 'label' => '更新密码'));
		//echo $this->Form->end('Update Password');
		?>
	</div>
</div>
<?php
switch($currentUser['User']['role'])
{
	//case 1:
	case 2: echo $this->element("sidebar_user");break;
	case 3: echo $this->element("sidebar_consultant");break;
	case 4: echo $this->element("sidebar_admin");break;
	default://error
}
?>
<div class='main'>
	<div class='account'>
		<h2>Account Page</h2>
		<h3>Change your password</h3>
		<p>You are <?php echo $currentUser['User']['username']; ?> who last logged in <?php echo $currentUser['User']['lastlogin']; ?>.</p>
		 
		<?php
		echo $this->Form->create(array('action' => 'changePassword'));
		echo $this->Form->input('password_old',     array('label' => 'Old password', 'type' => 'password', 'autocomplete' => 'off'));
		echo $this->Form->input('password_confirm', array('label' => 'New password', 'type' => 'password', 'autocomplete' => 'off'));
		echo $this->Form->input('password',         array('label' => 'Re-enter new password', 'type' => 'password', 'autocomplete' => 'off'));
		echo $this->Form->end('Update Password');
		?>
	</div>
</div>
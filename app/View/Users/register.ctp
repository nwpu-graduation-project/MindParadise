<div id='register_details'>
	<?php
	echo $this->Form->create('User',array('action' => 'register'));
	?>
	<div style="height:54px" ><h6>Register</h6> </div>
	<?php
	echo $this->Form->input('username', array('label' => false, 'class'=>'input_1', 'placeholder' => 'username', 'div' => array('class' => 'clearfix')));
	echo $this->Form->input('password_confirm', array('label' => false, 'placeholder' => 'password', 'type' => 'password', 'class' => 'input_2', 'div' => array('class' => 'clearfix')));
	echo $this->Form->input('password', array('label' => false, 'placeholder' => 'password confirm', 'class' => 'input_3', 'div' => array('class' => 'clearfix')));
	echo $this->Form->input('email', array('label' => false, 'placeholder' => 'email', 'class'=>'input_4', 'div' => array('class' => 'clearfix')));
	echo $this->Form->end(array('class' => 'register_img', 'label' => ''));
	?>
</div>
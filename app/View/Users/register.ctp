<div id='register_details'>
	<?php
	echo $this->Form->create(array('action' => 'register'));
	?>
	<div style="height:54px" ><h6>Register</h6> </div>
	<?php
	echo $this->Form->input('username', array('class'=>'input_1', 'div' => array('class' => '')));
	echo $this->Form->input('password_confirm', array('label' => 'password', 'type' => 'password', 'class' => 'input_2'));
	echo $this->Form->input('password', array('label' => 'password confirm', 'class' => 'input_3'));
	echo $this->Form->input('email', array('class'=>'input_4'));
	echo $this->Form->end(array('class' => 'register_img', 'label' => ''));
	?>
</div>
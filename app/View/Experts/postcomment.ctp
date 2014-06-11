<div id="comment_form">
<?php
	echo $this->Form->create('Contact');

	if(!isset($parentComment)) {
		echo '<h2>'.'留言咨询'.'</h>';
		echo $this->Form->input('parent_comment_id',array('label' => false,'type'=>'hidden'));
	} else {
		echo '<h2>'.'回复 '.$parentComment['Commentor']['username'].'</h>';

		if($parentComment['Contact']['parent_comment_id'] != NULL) {
			echo $this->Form->input('parent_comment_id',array(
				'label' => false,'type'=>'hidden', 'value' => $parentComment['Contact']['parent_comment_id']));
			if($parentComment['Contact']['commentted_user_id'] != NULL) {
				echo $this->Form->input('commentted_user_id',array(
					'label' => false,'type'=>'hidden', 'value' => $parentComment['Contact']['commentor_id']));
			}
		} else {
			echo $this->Form->input('parent_comment_id',array(
				'label' => false,'type'=>'hidden', 'value' => $parentComment['Contact']['id']));
		}
	}
	echo $this->Form->input('commentor_id',array('label' => false, 'type'=>'hidden', 'value' => $commentorId));
	echo $this->Form->input('content', array('label' => false, 'rows' => '3', 'class' => 'coment_message'));
	echo $this->Form->input('expert_id',array('label' => false, 'type'=>'hidden', 'value' => $expertId));
	echo $this->Form->end('提交');

	?>
</div>
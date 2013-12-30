<?php
echo $this->Form->create('Comment');

if(!isset($parentComment)) {
	echo '<h1>'.'回复主题'.'</h>';
	echo $this->Form->input('parent_comment_id',array('label' => false,'type'=>'hidden'));
} else {
	echo '<h1>'.'回复 '.$parentComment['Commentor']['username'].'</h>';

	if($parentComment['Comment']['parent_comment_id'] != NULL) {
		echo $this->Form->input('parent_comment_id',array(
			'label' => false,'type'=>'hidden', 'value' => $parentComment['Comment']['parent_comment_id']));
		//if($parentComment['Comment']['commentted_user_id'] != NULL) {
			echo $this->Form->input('commentted_user_id',array(
				'label' => false,'type'=>'hidden', 'value' => $parentComment['Comment']['commentor_id']));
		//}
	} else {
		echo $this->Form->input('parent_comment_id',array(
			'label' => false,'type'=>'hidden', 'value' => $parentComment['Comment']['id']));
	}
}

echo $this->Form->input('content', array('rows' => '3'));
echo $this->Form->input('webcontent_id',array('label' => false,'type'=>'hidden', 'value' => $webcontentId));
echo $this->Form->end('Save Post');

?>
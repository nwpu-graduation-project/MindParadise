<div id="comment_form">
	
<?php
echo $this->Form->create('Comment');

if(!isset($parentComment)) {
	echo '<h2>'.'回复主题'.'</h>';
	echo $this->Form->input('parent_comment_id',array('label' => false,'type'=>'hidden'));
} else {
	echo '<h2>'.'回复 '.$parentComment['Commentor']['username'].'</h>';

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

echo $this->Form->input('content', array('label' => false, 'rows' => '3', 'class' => 'coment_message'));
echo $this->Form->input('webcontent_id',array('label' => false, 'type'=>'hidden', 'value' => $webcontentId));
echo $this->Form->end('Save Post');

?>
</div>

        
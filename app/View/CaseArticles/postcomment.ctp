<div id="comment_form">
	
<?php
echo $this->Form->create('CaseComment');

if(!isset($parentComment)) {
	echo '<h2>'.'发表评论'.'</h>';
	echo $this->Form->input('parent_comment_id',array('label' => false,'type'=>'hidden'));
} else {
	echo '<h2>'.'回复 '.$parentComment['Commentor']['username'].'</h>';

	if($parentComment['CaseComment']['parent_comment_id'] != NULL) {
		echo $this->Form->input('parent_comment_id',array(
			'label' => false,'type'=>'hidden', 'value' => $parentComment['CaseComment']['parent_comment_id']));
		if($parentComment['CaseComment']['commentted_user_id'] != NULL) {
			echo $this->Form->input('commentted_user_id',array(
				'label' => false,'type'=>'hidden', 'value' => $parentComment['CaseComment']['commentor_id']));
		}
	} else {
		echo $this->Form->input('parent_comment_id',array(
			'label' => false,'type'=>'hidden', 'value' => $parentComment['CaseComment']['id']));
	}
}
echo $this->Form->input('commentor_id',array('label' => false, 'type'=>'hidden', 'value' => $commentorId));
echo $this->Form->input('content', array('label' => false, 'rows' => '3', 'class' => 'coment_message'));
echo $this->Form->input('case_article_id',array('label' => false, 'type'=>'hidden', 'value' => $caseArticleId));
echo $this->Form->end('提交');

?>
</div>

        
<?php
$categories = array('新闻','文章','视频','图片');

echo $this->Form->create('Webcontent');
echo $this->Form->input('title',array('label' => '标题'));
echo $this->Form->input('abstract',array('label' => '导读','placeholder'=>'导读','rows' => '3'));
echo $this->Form->label('Webcontent.category','分类','required');
echo $this->Form->select('category', $categories);
?>

<label for="tagSelector" class="required">标签</label>
<input id="tagSelector" name="data[selectedTags]" type="text" disabled="disabled" value="hehe hehe" />
<input id="tagIdSelector" name="data[selectedTagIDs]" type="hidden" value="1,2" />

<label for="editorContainer" class="required">正文</label>
<div id="editorContainer" name="editorContainerDiv">
	<script type="text/plain" id="contentEditor" name="data[webcontentPage]" style="width:100%; height:300px;">
	</script>
</div>
<script type="text/javascript">var um = UM.getEditor("contentEditor");</script>

<?php
echo $this->Form->end('提交');
?>
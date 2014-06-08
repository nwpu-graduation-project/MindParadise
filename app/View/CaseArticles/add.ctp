
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
<?php
$this->start('css');
echo '<link rel="stylesheet" type="text/css" href="/ueditor/themes/default/css/ueditor.min.css">';

$this->end();

$this->start('script');
echo '<script src="/js/jquery.min.ueditor.js"></script>';
echo '<script src="/ueditor/ueditor.config.js"></script>';
echo '<script src="/ueditor/ueditor.all.js"></script>';
?>
<?php $this->end('script'); ?>
<?php $this->start('css');?>
<style>
.text{
	margin-left: 0px;
	width:120%;
}
</style>
<?php $this->end();?>
<?php $this->start('script'); ?>
<script type="text/javascript">
	function onSubmit() {
		var element = document.getElementById('body');
		element.value = um.getContentTxt();
	}
</script>
<?php $this->end('script'); ?>
<div class='main'>
	<div class='account'>
<center>
<h1>增加案例</h1>
<form action='/CaseArticles/add' method='post' enctype="multipart/form-data">
<table>
	<tr><td>标题:</td><td><input type="text" name="title" size="55%"></td></tr>
	<tr><td valign='center'>摘要:</td><td><textarea rows="5" cols="53" name="abstract"></textarea></td></tr>
	<tr><td>选择图片:</td><td><input type="file" name="photo"></td></tr>
	<tr><td><input type='hidden' id='body' name='body'></td></tr>
</table>
<div id="editorContainer" name="editorContainerDiv">
	<label for="contentEditor" class="required" name="body">正文</label>
	<script type="text/plain" id="contentEditor" name="body" style="width:100%; height:300px;">
	</script>
</div>
<script type="text/javascript">var um = UE.getEditor("contentEditor");</script>
<input type='submit' value='添加' onClick='return onSubmit()'>
</form>
</center>
</div>
</div>

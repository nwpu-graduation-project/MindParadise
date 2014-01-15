
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
<?php $this->start('css');?>
<style>
.text{
	margin-left: 0px;
	width:120%;
}
</style>
<?php $this->end();?>
<div class='main'>
	<div class='account'>
<center>
<h1>增加案例</h1>
<form action="/CaseArticles/add" method="post" enctype="multipart/form-data">
<table>
	<tr><td>标题:</td><td><input type="text" name="title" size="55%"></td></tr>
	<tr><td valign='center'>摘要:</td><td><textarea rows="5" cols="53" name="abstract"></textarea></td></tr>
	<tr><td valign='center'>内容:</td><td><textarea rows="20" cols="53" name="body"></textarea></td></tr>
	<tr><td>选择图片:</td><td><input type="file" name="photo"></td></tr>
	<tr><td></td><td align='center'><input type="submit" value="添加"></td></tr>
</table>
</form>
</center>
</div>
</div>

<html>
<body>
<center>
<h1>增加案例</h1>
<form action="/CaseArticles/add" method="post" enctype="multipart/form-data">
<table>
	<tr><td>标题:</td><td><input type="text" name="title" size="85%"></td></tr>
	<tr><td valign='center'>摘要:</td><td><textarea rows="5" cols="80" name="abstract"></textarea></td></tr>
	<tr><td valign='center'>内容:</td><td><textarea rows="20" cols="80" name="body"></textarea></td></tr>
	<tr><td>选择图片:</td><td><input type="file" name="photo"></td></tr>
	<tr><td></td><td align='center'><input type="submit" value="添加"></td></tr>
</table>
</form>
</center>
</body>
</html>
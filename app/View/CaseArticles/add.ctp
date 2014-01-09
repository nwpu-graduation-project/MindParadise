<html>
<body>
<center>
<h1>增加案例</h1>
<form action="/CaseArticles/add" method="post" enctype="multipart/form-data">
<table>
	<tr><td>标题:<input type="text" name="title"></td></tr>
	<tr><td>内容:<textarea rows="3" cols="21" name="body"></textarea></td></tr>
	<tr><td>选择图片:<input type="file" name="photo"></td></tr>
	<tr align="center"><td><input type="submit" value="添加"></td></tr>
</table>
</form>
</center>
</body>
</html>
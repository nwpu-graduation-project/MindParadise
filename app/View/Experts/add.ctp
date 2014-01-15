<html>
<body>
<center>
<form action="/Experts/add" method="post" enctype="multipart/form-data">
	<p><label>别名:</label><input type="text" name="alias"></p>
	<p><label>别名:</label><input type="text" name="alias"></p>
	<p><label>别名:</label><input type="text" name="alias"></p>
	<p><label>别名:</label><input type="text" name="alias"></p>

	<p><label>别名:</label><input type="text" name="alias"></p>
	<p><label>真实姓名:</label><input type="text" name="realname"><font color="red">*</font></p>
	<p><label>年龄:</label><input type="text" name="age"></p>
	<p><label>性别:</label>
		<select name="gender">
			<option value="男">男</option>
			<option value="女">女</option>
		</select>
	</p>
	<p><label>教育资质:</label><input type="text" name="education"><font color="red">*</font></p>
	<p><label>电话:</label><input type="text" name="phone"><font color="red">*</font></p>
	<p><label>QQ号码:</label><input type="text" name="qq_number"></p>
	<p><label>微博帐号:</label><input type="text" name="microblog"></p>
	<p><label>个人博客地址:</label><input type="text" name="blog"></p>
	<p><label>微信号:</label><input type="text" name="weixin_number"></p>
	<p><label>个人信息:</label><textarea name="personal_information" row="3" col="10"></textarea><font color="red">*</font></p>
	<p><label>重点阅历:</label><textarea name="experience" row="3" col="10"></textarea><font color="red">*</font></p>
	<p><label>擅长领域:</label><textarea name="profession" row="3" col="10"></textarea><font color="red">*</font></p>
	<p><label>收费标准:</label><textarea name="price" row="3" col="10"></textarea><font color="red">*</font></p>
	<p><label>文件名:</label><input type="file" name="avatar"><font color="red">*</font></p>
	<p><input type="submit" name="submit" value="注册"></p>
</form>
</center>
</body>
</html>



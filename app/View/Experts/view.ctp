<!-- File: /app/View/Experts/view.ctp -->
<html>
<body>

<table align="left">
	<tr><td align="center"><?php echo h($expert['Expert']['realname']); ?></td></tr>
	<tr><td align="center">等级认证:<?php echo h($expert['Expert']['realname']); ?></td></tr>
	<tr><td align="center"><?php $string = $expert['Expert']['photo']; echo "<img src='/img/uploads/$string' width='40%' height='30%' alt='photo' />"; ?></td></tr>
	<tr><td align="left"><h2>个人简介:</h2></td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo h($expert['Expert']['realname']);
			echo ",";
			echo h($expert['Expert']['gender']);
			echo ",";
			echo h($expert['Expert']['age']);
			echo "岁,";
			echo h($expert['Expert']['education']);
			echo ",";
			echo h($expert['Expert']['personal_information']); ?></td></tr>
	<tr><td align="left"><h2>重点阅历:</h2></td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo h($expert['Expert']['experience']); ?></td></tr>
	<tr><td align="left"><h2>擅长领域:</h2></td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo h($expert['Expert']['profession']); ?></td></tr>
	<tr><td align="left"><h2>收费标准:</h2></td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo h($expert['Expert']['price']); ?></td></tr>
	<tr><td align="left"><h2>联系方式:</h2></td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;电话预约:<?php echo h($expert['Expert']['phone']); ?><br>
			&nbsp;&nbsp;&nbsp;&nbsp;线上预约:点击打开线上咨询窗口<br>
			&nbsp;&nbsp;&nbsp;&nbsp;QQ预约:<?php echo h($expert['Expert']['qq_number']); ?><br></td></tr>
</center>
</table>
</body>
</html>
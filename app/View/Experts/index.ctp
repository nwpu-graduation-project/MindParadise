<!-- File: /app/View/Experts/view.ctp -->

<html>
<body>
<h1>专家团队成员信息</h1>
<center>
<?php foreach ($experts as $expert) : ?>
<table width="60%">
		
	<tr>
		<td width="80%"><?php echo $this->Html->link($expert['Expert']['realname'], array('controller' => 'experts', 'action' => 'view', $expert['Expert']['id'])); ?></td><td width="20%"></td>
	</tr>
	<tr>
		<td width="80%"><?php echo $expert['Expert']['personal_information']; ?></td><td width="20%"><?php $string = $expert['Expert']['photo']; echo "<img src='/img/uploads/$string' width='50' height='50' alt='photo' />"; ?></td>
	</tr>
	<tr>
		<td width="80%"><?php echo $expert['Expert']['created_time']; ?></td><td width="20%"></td>
	</tr>
	<tr><hr width="60%"></tr>
</table>
<?php endforeach; ?>
<?php unset($expert); ?>
<hr width="60%">
</center>
</body>
</html>


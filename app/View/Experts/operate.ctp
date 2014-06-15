
<!-- File: /app/View/Experts/operate.ctp -->
<!-- 这个页面只允许管理员访问以便增加,修改和删除专家成员 -->

<h1>专家成员列表</h1>
<table>
	<tr>
		<th>专家ID</th>
		<th>别名</th>
		<th>真实姓名</th>
		<th>创建时间</th>
		<th>修改时间</th>
		<th>操作</th>
	</tr>

	<!-- Here is where we loop throught out $experts array,printing out expert info -->

	<?php foreach ($experts as $expert) : ?>

	<tr>
		<td><?php echo $expert['Expert']['id']; ?></td>
		<td><?php echo $expert['Expert']['alias']; ?></td>
		<td><?php echo $expert['Expert']['realname']; ?></td>
		<td><?php echo $expert['Expert']['created']; ?></td>
		<td><?php echo $expert['Expert']['modified']; ?></td>
		<td>
			<?php
				echo $this->Html->link('修改', array('action' => 'edit', $expert['Expert']['id']));
			?>
			<?php
				echo $this->Form->postLink('删除', array('action' => 'delete', $expert['Expert']['id']), array('confirm' => '你确定要删除吗?'));
			?>
			<?php
				echo $this->Form->postLink('查看', array('action' => 'view', $expert['Expert']['id']));
			?>
		</td>
	</tr>
<?php endforeach; ?>
<?php unset($expert); ?>
</table>

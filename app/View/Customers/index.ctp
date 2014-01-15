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
	width: 100%
}
</style>
<?php $this->end(); ?>

<h2>
<?php
    echo $this->Html->link('新增客户', array('controller' => 'Customers', 'action' => 'add'));
?>
</h2>
<center>
<table>
	<tr>
		<th>ID</th>
		<th>姓名</th>
		<th>性别</th>
		<th>修改</th>
		<th>删除</th>
		<th>创建案例</th>
		<th>创建时间</th>
		<th>更新时间</th>
	</tr>

<?php foreach ($customers as $customer): ?>

	<tr>
		<td><?php echo $customer['Customer']['id']; ?></td>
		<td>
			<?php echo $customer['Customer']['first_name']; 
				  echo $customer['Customer']['family_name'];?>
		</td>
		<td>
			<?php echo $customer['Customer']['gender']; ?>
		</td>
		<td><?php echo $this->Html->link('修改',array('action' => 'edit', $customer['Customer']['id']));?>
		</td>
		<td>
			<?php echo $this->Form->postLink('删除', array('action' => 'delete', $customer['Customer']['id']), array('confirm' => '你确定要删除吗?'));?>
		</td>
		<td>
			<?php echo $this->Form->postLink('创建案例', array('action' => 'view', $customer['Customer']['id']));?>
		</td>
		<td>
			<?php echo $customer['Customer']['created']; ?>
		</td>
		<td>
			<?php echo $customer['Customer']['modified']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</center>


<?php 
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end(); 

?>
<h3>用户管理</h3>
<p><?php echo $this->Html->link("添加用户", array('action' => 'userAdd')); ?></p>
<p><?php echo $this->Html->link("添加咨询师", array('controller' => 'Experts', 'action' => 'add')); ?></p>

<?php
echo $this->Form->create('User');
echo $this->Form->input('role', array('label' => '用户类型', 'required' => false, 'options' => array(1 => '游客', 2 => '会员', 3 => '咨询师', 4 => '管理员'), 'empty' => '请选择'));
echo $this->Form->input('username', array('label' => '用户名', 'required' => false));
echo $this->Form->input('email', array('label' => '注册邮箱', 'required' =>false));
echo $this->Form->end('查询');
?>

<table>
	<tr>
		<th>用户Id</th>
		<th>用户类型</th>
		<th>用户名</th>
		<th>注册邮箱</th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
	<td><?php echo $user['User']['id']; ?></td>
	<td>
	<?php 
	switch($user['User']['role'])
	{
		case 1: echo '游客';break;
		case 2: echo '会员';break;
		case 3: echo '咨询师';break;
		case 4: echo '管理员';break;
		default: //error
	}

	?>
	</td>
	<td><?php echo $user['User']['username']; ?></td>
	<td><?php echo $user['User']['email']; ?></td>
	<td>
		<?php
			echo $this->Html->link(
				'查看用户资料',
				array('action' => 'profileView', $user['User']['id'])
			);
		?>
	</td>
	<td>
		<?php
			echo $this->Html->link(
				'修改用户资料',
				array('action' => 'profileEdit', $user['User']['id'])
			);
		?>
		<?php
			echo $this->Form->postLink(
				'删除用户',
				array('action' => 'userDelete', $user['User']['id']),
				array('confirm' => 'Are you sure?')
			);
		?>
	</td>
	</tr>
	<?php endforeach; ?>
</table>


<ul class="paginate_nav">
<?php
echo $this->Paginator->prev(
  '上一页',
  array(
    // 'escape' => FALSE,
    'tag' => 'li',
    'class' => 'page_prev',
  ),
  '上一页',
  array(
    'tag' => 'li',
    'class' => 'page_prev',
  )
);
?>
      
<?php
echo $this->Paginator->numbers(array(
    'separator' => NULL,
    'tag' => 'li',
    'class' => 'page_number',
    'currentClass' => 'current',
    'currentTag' => 'a'
    )
  );
?>

<?php
echo $this->Paginator->next(
  '下一页',
  array(
    // 'escape' => FALSE,
    'tag' => 'li',
    'class' => 'page_next',
  ),
  '下一页',
  array(
    'tag' => 'li',
    'class' => 'page_next',
  )
);
?>
</ul>
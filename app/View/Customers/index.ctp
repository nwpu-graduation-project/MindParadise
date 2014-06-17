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
		<th>删除案例</th>
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
			<?php echo $this->Form->postLink('删除案例', array('action' => 'deleteCase', $customer['Customer']['id']), array('confirm' => '你确定要删除案例吗?'));?>
		</td>
		<td>
			<?php echo $this->Form->postLink('创建案例', array('action' => 'view', $customer['Customer']['id']));?>
		</td>
		<td>
			<?php $date=$customer['Customer']['created']; echo substr($date, 0,10);?>
		</td>
		<td>
			<?php $date=$customer['Customer']['modified']; echo substr($date, 0,10);?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</center>
<div id="page_navigation">
    <div class="center_frame">
        <ul class="blog_page_nav">
<?php
echo $this->Paginator->prev(
  __('上', true),
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
        'currentTag' => 'a')
    );
?>

<?php
echo $this->Paginator->next(
  __('下', true),
  array(
    'tag' => 'li',
    'class' => 'page_next',
  )
);
?>
        </ul>
    </div>
</div>

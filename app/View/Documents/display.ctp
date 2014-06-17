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
<h2>案例分类显示</h2>
<form method='post' action='/Documents/display/'>
<select name="title">
	<?php 
		if ($title) {
			echo "<option value='$title'>$title</option>";
		}
	?>
	<option value=''>-请选择-</option>
<?php foreach ($titles as $title ): ?>
	<option value='<?php echo $title['Document']['title']; ?>'><?php echo $title['Document']['title']; ?></option>
<?php endforeach; ?>
</select>
<input type='submit' value='显示'/> 
</form>
<h2>案例管理</h2>
<center>
<table>
	<tr>
		<th>ID</th>
		<th>咨询次数</th>
		<th>客户ID</th>
		<th>标题</th>
		<th>查看</th>
		<th>修改</th>
		<th>删除</th>
		<th>更新时间</th>
	</tr>

<?php foreach ($documents as $document): ?>

	<tr>
		<td><?php echo $document['Document']['id']; ?></td>
		<td>
			<?php echo $document['Document']['detail_order']; ?>
		</td>
		<td>
			<?php echo $document['Document']['case_id']; ?>
		</td>
		<td>
			<?php echo $document['Document']['title']; ?>
		</td>
		<td><?php echo $this->Html->link('查看',array('action' => 'view', $document['Document']['id']));?>
		</td>
		<td><?php echo $this->Html->link('修改',array('action' => 'edit', $document['Document']['id']));?>
		</td>
		<td>
			<?php echo $this->Form->postLink('删除', array('action' => 'delete', $document['Document']['id']), array('confirm' => '你确定要删除吗?'));?>
		</td>
		<td>
			<?php $time = $document['Document']['modified']; echo substr($time, 0,10)?>
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

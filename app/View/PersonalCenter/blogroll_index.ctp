<?php 
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end(); 

?>
<h3>友情链接</h3>
<p><?php echo $this->Html->link("添加友情链接", array('action' => 'blogrollAdd')); ?></p>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Action</th>
	</tr>
	<?php foreach ($blogrolls as $blogroll): ?>
	<tr>
	<td><?php echo $blogroll['Blogroll']['id']; ?></td>
	<td>
		<?php
			echo $this->Html->link(
				$blogroll['Blogroll']['title'],
				array('action' => 'blogrollView', $blogroll['Blogroll']['id'])
			);
		?>
	</td>
	<td>
		<?php
			echo $this->Html->link(
				'编辑',
				array('action' => 'blogrollEdit', $blogroll['Blogroll']['id'])
			);
		?>
		<?php
			echo $this->Form->postLink(
				'删除',
				array('action' => 'blogrollDelete', $blogroll['Blogroll']['id']),
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
      
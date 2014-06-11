<?php 
$this->extend('common_view');
$categoryOption = array(2 => '文章', 3 => '视频', 4 => '图片', 5 => '游戏');
$this->start('sidebar');
if($currentUser['User']['role'] == 3)
  echo $this->element('sidebar_consultant');
else
{
  echo $this->element('sidebar_admin');
  $categoryOption = array_merge(array(1 => '新闻', 7 => '公告'), $categoryOption);
}
$this->end(); 
$this->start('css');
?>
<style>
.post_blog a.button
{
	float: left;
	margin-left: 4px;
	padding: 0px 5px 0px 5px;
	background-color: rgb(43, 101, 224);
	-webkit-border-radius: 4px;
	line-height: 30px;
	text-align: center;
	color: #fff;
}
</style>
<?php 
$this->end();
?>
<h3>个人内容管理</h3>

<?php
echo $this->Form->create('Webcontent');
echo $this->Form->input('category', array('label' => '分类筛选', 'required' => false, 'options' => $categoryOption, 'empty' => '请选择'));
echo $this->Form->end('查询');
?>


<?php foreach ($webcontents as $webcontent): ?>	
<div class="post_blog">
	<h2><?php echo $this->Html->link($webcontent['Webcontent']['title'],
		array('controller' => 'webcontents', 'action' => 'view', $webcontent['Webcontent']['id'])); ?>
	</h2>
	<h3>
		<span class="post_date">
		<code><?php echo $this->Time->nice($webcontent['Webcontent']['created'],NULL,'%d'); ?></code>
		<strong>
			<?php
			switch ($this->Time->nice($webcontent['Webcontent']['created'],NULL,'%w')) {
				case '0':
					echo '星期日';
					break;
				case '1':
					echo '星期一';
					break;
				case '2':
					echo '星期二';
					break;
				case '3':
					echo '星期三';
					break;
				case '4':
					echo '星期四';
					break;
				case '5':
					echo '星期五';
					break;
				case '6':
					echo '星期六';
					break;
				default:
					echo '某天';
					break;
			}
			?></strong>
		<em><?php echo $this->Time->nice($webcontent['Webcontent']['created'],NULL,'%Y %m月'); ?></em>
		</span>
		<dfn> <?php echo $webcontent['User']['username']; ?></dfn>
	</h3>
	<p> <?php echo $webcontent['Webcontent']['abstract']; ?> </p>
	<?php echo $this->Html->link($webcontent['Webcontent']['browse_count'].'次阅读',
		array('controller' => 'webcontents', 'action' => 'view', $webcontent['Webcontent']['id']),
		array('class' => 'blgo_read')); ?>
	<?php echo $this->Html->link($webcontent['Webcontent']['comment_count'].'条评论',
		'/webcontents/view/'.$webcontent['Webcontent']['id'].'#leave_comment',
		array('class' => 'blgo_read')); ?>
	<?php echo $this->Html->link('编辑', array('controller' => 'webontents', 'action' => 'edit', $webcontent['Webcontent']['id']), array('class' => 'button'))?>
	<?php echo $this->Form->postLink('删除', array('controller' => 'webontents', 'action' => 'delete', $webcontent['Webcontent']['id']), array('confirm' => '确定删除吗？','class' => 'button'))?>
	<?php 
		if($currentUser['User']['role'] == 4)
		{
			$recommend_data = array('title' => $webcontent['Webcontent']['title'], 'abstract' => $webcontent['Webcontent']['abstract'], 'url' => '/webcontents/view/'.$webcontent['Webcontent']['id']);
			echo $this->Form->postLink('添加为首页推荐', array('controller' => 'recommendContents', 'action' => 'add'),  array('data' => array_merge($recommend_data, array('action' => 'autoAdd')), 'confirm' => '确定添加为推荐吗?', 'class' => 'button'));
		}
	?>
	<div class="blgo_developer_icon">
	<ul>
		<li><a href="/tags/"><img src="/images/p84.png" alt=""></a></li>
		<?php foreach ($webcontent['WecontentTags'] as $tag) : ?>
		<li><a href="/webcontents/tag/<?php echo $tag['id']; ?>"><?php echo $tag['tag']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	</div>
</div>

<?php endforeach; ?>
<?php unset($webcontent);?>



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
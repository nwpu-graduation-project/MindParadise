<div id="blog_right">

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
		'view/'.$webcontent['Webcontent']['id'].'#leave_comment',
		array('class' => 'blgo_read')); ?>
	<div class="blgo_developer_icon">
	<ul>
		<li><a href="#"><img src="/mp/images/p84.png" alt=""></a></li>
		<?php foreach ($webcontent['WecontentTags'] as $tag) : ?>
		<li><a href="#"><?php echo $tag['tag']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	</div>
</div>

<?php endforeach; ?>
<?php unset($webcontent);?>

</div>
<div id="wrapper">

<div id="blog_content">
    <div class="center_frame">
    	
    	<div id="blog_left">
<?php
echo $this->element('artical_categories',array('current' => $webcontent['Webcontent']['category']));
?>
    	</div>

<div id="blog_right">
<?php // WebcontentsController::_echoArray($webcontent); ?>
<?php // WebcontentsController::_echoArray($comments); ?>

<div class="post_blog">
	<h2>
		<?php echo $webcontent['Webcontent']['title']; ?>
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
	<div>
	<?php echo $page; ?>
	</div>
	<a href="#blog_right" class="blgo_read"><?php echo ++$webcontent['Webcontent']['browse_count'].'次阅读'; ?></a>
	<a href="#leave_comment" class="blgo_comment"><?php echo $webcontent['Webcontent']['comment_count'].'条评论'; ?></a>
	<?php echo $this->Html->link('发表评论',array('action' => 'postcomment',$webcontent['Webcontent']['id'])); ?>
	<div class="blgo_developer_icon">
	<ul>
		<li><a href="/tags/"><img src="/images/p84.png" alt=""></a></li>
		<?php foreach ($webcontent['WecontentTags'] as $tag) : ?>
		<li><a href="#"><?php echo $tag['tag']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	</div>
</div>

<div id="leave_comment">
<?php foreach ($comments as $comment) : ?>
	<div class="person_icon">
		<h5>
			<img src="/images/anoyous.png" alt="">
			<span><?php echo $comment['Commentor']['username'] ?></span>
			<em><?php echo $this->Time->nice($comment['Comment']['created'],NULL,'%Y-%m-%d');?></em>
		</h5>
		<div class="person_comment" id="<?php echo $webcontent['Webcontent']['id'].'_'.$comment['Comment']['id']; ?>">
			<img src="/images/anoyous_icon.png" alt="" class="comment_tooltip">
		<?php echo $comment['Comment']['content'] ?>
    	</div>
    	<?php echo $this->Html->link('回复他',array(
    		'action' => 'postcomment',
    		$webcontent['Webcontent']['id'],
    		$comment['Comment']['id'])); ?>
    </div>
    
    <!-- Children Comments -->
    <?php foreach ($comment['FollowedComments'] as $childComment) : ?>
    <div class="person_icon leve_margin">
    	<h5>
    		<img src="/images/anoyous.png" alt="">
    		<span>
    		<?php
    		echo $childComment['Commentor']['username'];
    		if($childComment['CommenttedUser']) {
    			echo ' 回复 '.$childComment['CommenttedUser']['username'];
    		}
    		?>
    		</span>
    		<em><?php echo $this->Time->nice($childComment['created'],NULL,'%Y-%m-%d');?></em>
    	</h5>
    	<div class="person_comment short_width" id="<?php echo $webcontent['Webcontent']['id'].'_'.$childComment['id']; ?>">
    	<img src="/images/anoyous_icon.png" alt="" class="comment_tooltip">
    	<?php echo $childComment['content'] ?>
    	</div>
    	<?php echo $this->Html->link('回复他',array(
    		'action' => 'postcomment',
    		$webcontent['Webcontent']['id'],
    		$childComment['id'])); ?>
    </div>
    <?php endforeach; ?>
<?php endforeach; ?>
</div>

<!-- div id="comment_form">
	<h2>评论</h2>
	<form action="" name="levecomment" method="post">
		<textarea class="coment_message" rows="" cols=""></textarea>
		<input type="submit" value="Post comment" name="submit">
	</form>
</div -->
</div>
</div>
</div>

<div id="page_navigation">
    <div class="center_frame"> <a href="/webcontents/index" class="leave_back">&nbsp;</a> </div>
</div>

</div>
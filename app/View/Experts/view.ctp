<!-- File: /app/View/Experts/view.ctp -->

	<?php $this->start('css'); ?>
  	<link rel="stylesheet" href="/css/zerogrid.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/page_style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/responsiveslides.css" type="text/css" media="screen">
	<?php $this->end(); ?>

	<?php $this->start('script'); ?>
    <script src="/js/jquery.min.v8.js" type="text/javascript"></script>
	<script src="/js/responsiveslides.js" type="text/javascript"></script>
	<script src="/js/page_detail.js" type="text/javascript"></script>
	<?php $this->end(); ?>

<section id="content">
	<div class="wrap-content zerogrid">
		<div class="row">
			<div id="main-content" class="col-2-3">
				<div class="wrap-col">
					<article>

						<h2><?php echo h($expert['Expert']['realname']); ?></h2>
						
						<span class="info">发布于:<?php echo h($expert['Expert']['created']); ?>&nbsp;| 职业资格:<?php echo h($expert['Expert']['education']); ?></span><br><br>
							<div align="center"><?php $string = $expert['Expert']['avatar']; 
						echo "<img src='$string' alt='photo'/>"; ?></div><br>
							
						
						<div class="photos">
							<ul>
								<li><h3>个人简介:</h3><br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo h($expert['Expert']['personal_information']); ?></p></li>
								<li><h3>重点阅历:</h3><br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo h($expert['Expert']['experience']); ?></p></li>
								<li><h3>擅长领域:</h3><br><p><?php echo h($expert['Expert']['profession']); ?></p></li>
								<li><h3>收费标准:</h3><br><p><?php echo h($expert['Expert']['price']); ?></p></li>
								<li><h3>联系方式:</h3><br><p><?php echo h($expert['Expert']['phone']); ?></p></li>
							</ul>
						</div>
						
					</article>
					
					<div class="comment">
						<?php echo $this->Html->link('留言咨询',array('action' => 'postcomment',$expert['Expert']['id'])); ?>
						<div id="leave_comment">
						<?php foreach ($contacts as $contact) : ?>
							<div class="person_icon">
								<div class="person_comment" id="<?php echo $expert['Expert']['id'].'_'.$contact['Contact']['id']; ?>">
								<h5>
									<img src="/images/anoyous.png" alt="">
									<span><?php echo $contact['Commentor']['username'] ?></span>
									<em><?php echo $this->Time->nice($contact['Contact']['created'],NULL,'%Y-%m-%d');?></em>
								</h5>
								&nbsp;&nbsp;&nbsp;&nbsp;
									<!-- <img src="/images/anoyous_icon.png" alt="" class="comment_tooltip"> -->
								<?php echo $contact['Contact']['content'] ?>
						    	</div>
						    	
						    	<?php echo $this->Html->link('回复他',array(
						    		'action' => 'postcomment',
						    		$expert['Expert']['id'],
						    		$contact['Contact']['id'])); ?>
						    </div>
						    
						    <!-- Children Comments -->
						    <?php foreach ($contact['FollowedComments'] as $childComment) : ?>
						    <div class="person_icon leve_margin">
						    	<div class="person_comment short_width" id="<?php echo $expert['Expert']['id'].'_'.$childComment['id']; ?>">
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
						    	&nbsp;&nbsp;&nbsp;&nbsp;
						    	<!-- <img src="/images/anoyous_icon.png" alt="" class="comment_tooltip"> -->
						    	<?php echo $childComment['content'] ?>
						    	</div>
						    	
						    	<?php echo $this->Html->link('回复他',array(
						    		'action' => 'postcomment',
						    		$expert['Expert']['id'],
						    		$childComment['id'])); ?>
						    </div>
						    <?php endforeach; ?>
						<?php endforeach; ?>
						</div>
						
						
						

					</div>
				</div>
			</div>
			<div id="sidebar" class="col-1-3">
				<div class="wrap-col">
					<div class="box">
						<div class="heading"><h2>编者推荐</h2></div>
						<div class="content">
							<div class="photos">
								<a href="http://themeforest.net/category/site-templates?ref=4themes" target="_blank"><img src="/display/images/themeforest.jpg"/></a>
								<a href="http://www.cssmoban.com/" target="_blank"><img src="/display/images/zerotheme.jpg"/></a>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>图片</h2></div>
						<div class="content">
							<div class="photos">
								<a href="#"><img src="/display/images/photo01.png" /></a>
								<a href="#"><img src="/display/images/photo02.png" /></a>
								<a href="#"><img src="/display/images/photo03.png" /></a>
								<a href="#"><img src="/display/images/photo04.png" /></a>
								<a href="#"><img src="/display/images/photo05.png" /></a>
								<a href="#"><img src="/display/images/photo01.png" /></a>
								<a href="#"><img src="/display/images/photo02.png" /></a>
								<a href="#"><img src="/display/images/photo03.png" /></a>
								<a href="#"><img src="/display/images/photo05.png" /></a>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>分类</h2></div>
						<div class="content">
							<div class="photos">
								<ul>
									<li><a href="http://baike.baidu.com/subview/5371/5096866.htm">普通心理学</a></li>
									<li><a href="http://baike.baidu.com/subview/69235/11404016.htm">变态心理学</a></li>
									<li><a href="http://baike.baidu.com/subview/5441/11073621.htm">社会心理学</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>最新文章</h2></div>
						<div class="content">
							<div class="posts">
								<img src="/display/images/post01.png"/>
								<h4><a href="http://www.xinli001.com/info/10766/">沙盘中常见动物的象征意义</a></h4>
								<p>浏览者590次</p>
							</div>
							<div class="posts">
								<img src="/display/images/post02.png"/>
								<h4><a href="http://www.xinli001.com/info/10686/">有用才是王道:12月译文精选</a></h4>
								<p>浏览者1500次</p>
							</div>
							<div class="posts">
								<img src="/display/images/post03.png"/>
								<h4><a href="http://www.xinli001.com/info/10839/">儿童身上的两颗种子</a></h4>
								<p>浏览者1090次</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





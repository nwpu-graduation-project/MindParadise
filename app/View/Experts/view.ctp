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
								<a href="http://www.mindparadise.com/Experts/view/22" target="_blank"><img src="/upload/uploads/31/1403010969_112.jpg"/></a>
								<a href="http://www.mindparadise.com/Experts/view/24" target="_blank"><img src="/upload/uploads/33/1403012767_112.jpg"/></a>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>图片</h2></div>
						<div class="content">
							<div class="photos">
								<a href="http://www.mindparadise.com/caseArticles/view/51"><img src="/img/cases_photos/2041250ce6fd3f1006eb87.jpg" width="75px" height="100px"/></a>
								<a href="http://www.mindparadise.com/caseArticles/view/50"><img src="/img/cases_photos/16593372c588a314816075.jpg" width="75px" height="100px"/></a>
								<a href="http://www.mindparadise.com/caseArticles/view/49"><img src="/img/cases_photos/18134531c5b4f16ad5c438.jpg" width="75px" height="100px"/></a>
								<a href="http://www.mindparadise.com/caseArticles/view/47"><img src="/img/cases_photos/1139516c22443ac5c0246f.jpg!600.jpeg" width="75px" height="50px"/></a>
								<a href="http://www.mindparadise.com/caseArticles/view/53"><img src="/img/cases_photos/17503940b45f9dac7ec486.jpg" width="75px" height="100px" /></a>
								<a href="http://www.mindparadise.com/caseArticles/view/52"><img src="/img/cases_photos/1057204fb378c60909384f.jpg" width="75px" height="100px" /></a>
								<a href="http://www.mindparadise.com/caseArticles/view/44"><img src="/img/cases_photos/112726d9c9b86748a87235.jpg" width="75px" height="100px"/></a>
								<a href="http://www.mindparadise.com/caseArticles/view/43"><img src="/img/cases_photos/165450c230f9a58f45262a.jpg" width="75px" height="100px"/></a>
								<a href="http://www.mindparadise.com/caseArticles/view/42"><img src="/img/cases_photos/1723594754a4078a5ef16a.jpg" width="75px" height="100px" /></a>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>分类</h2></div>
						<div class="content">
							<div class="photos">
								<ul>
									<li><a href="http://www.mindparadise.com/Documents/view/17">焦虑症</a></li>
									<li><a href="http://www.mindparadise.com/Documents/view/18">恐惧症</a></li>
									<li><a href="http://www.mindparadise.com/Documents/view/19">抑郁症</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>最新文章</h2></div>
						<div class="content">
							<div class="posts">
								<img src="/img/cases_photos/2041250ce6fd3f1006eb87.jpg" width="62px" height="62px" />
								<h4><a href="http://www.mindparadise.com/caseArticles/view/51">为什么羞耻是人类最强烈的感情</a></h4><br>
								<p>浏览2次</p>
							</div>
							<div class="posts">
								<img src="/img/cases_photos/16593372c588a314816075.jpg" width="62px" height="62px" />
								<h4><a href="http://www.mindparadise.com/caseArticles/view/50">爆粗口他妈对你很好</a></h4><br><br>
								<p>浏览3次</p>
							</div>
							<div class="posts">
								<img src="/img/cases_photos/18134531c5b4f16ad5c438.jpg" width="62px" height="62px" />
								<h4><a href="http://www.mindparadise.com/caseArticles/view/49">我们为什么会过于相信陌生人</a></h4><br>
								<p>浏览3次</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





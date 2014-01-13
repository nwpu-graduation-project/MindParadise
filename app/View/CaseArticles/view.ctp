
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
						
						<h2><?php echo h($caseArticle['CaseArticle']['title']); ?></h2>
						
						<span>发布于:<?php echo h($caseArticle['CaseArticle']['created']); ?>&nbsp;浏览</span><?php echo h($caseArticle['CaseArticle']['count']); ?>次&nbsp;评论<?php echo h($caseArticle['CaseArticle']['count']); ?>条<br>
						作者:<span class="info"><?php echo h($caseArticle['CaseArticle']['source']); ?></span><br><br>
						<h3><b>导读:<?php echo h($caseArticle['CaseArticle']['abstract']); ?></b></h3><br>
	
							<div align="center"><?php $string = $caseArticle['CaseArticle']['photo']; 
						echo "<img src='/img/cases_photos/$string' alt='photo'/>"; ?></div><br>
							
					
						<p><?php echo h($caseArticle['CaseArticle']['body']); ?></p>
					</article>
					
					<div class="comment">
						你的邮箱不会被公开, * 为必填项!
						<form>
							<div><input type="text" name="name" id="name"> 姓名 *</div>
							<div><input type="email" name="email" id="email"> 邮箱 *</div>
							<div><input type="url" name="website" id="website"> 个人网站</div>
							<div><textarea rows="10" name="comment" id="comment"></textarea></div>
							<div><input type="submit" name="submit" value="提交"></div>
						</form>
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




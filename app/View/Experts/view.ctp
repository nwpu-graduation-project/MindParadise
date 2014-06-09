<!-- File: /app/View/Experts/view.ctp -->


<?php

session_name("fancyform");
session_start();


$_SESSION['n1'] = rand(1,20);
$_SESSION['n2'] = rand(1,20);
$_SESSION['expect'] = $_SESSION['n1']+$_SESSION['n2'];


$str='';
if($_SESSION['errStr'])
{
	$str='<div class="error">'.$_SESSION['errStr'].'</div>';
	unset($_SESSION['errStr']);
}

$success='';
if($_SESSION['sent'])
{
	$success='<h1>Thank you!</h1>';
	
	$css='<style type="text/css">#contact-form{display:none;}</style>';
	
	unset($_SESSION['sent']);
}
?>


	<?php $this->start('css'); ?>
  	<link rel="stylesheet" href="/css/zerogrid.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/page_style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/responsiveslides.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/expert_comment.css" type="text/css" media="screen">
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
						<div id='form-container'>
						<h1>留言咨询</h1><br>
						<form id='' name='' method='post' action=''>
							<table width='100%' border='0' cellspacing='0' cellpadding='5'>
								<tr>
									<td width='15%' align='center'><h2>姓名<h2></td>
									<td width='70%'><input type='text' class='' name='' id='' value='' /></td>
									<td width='15%' id=''>&nbsp;</td>
								</tr>
								<tr>
									<td align='center'><h2>邮箱</h2></td>
									<td><input type='text' calss='' name='' id='' value='' /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align='center'><h2>主题</h2></td>
									<td><select name='subject' id='subject'>
										<option value='' selected='selected'>-请选择-</option>
										<option value='question'>问题</option>
										<option value='proposal'>解决方案</option>
										<option value='knowledge'>心理知识</option>
										<option value='complaint'>抱怨</option>
									</select>
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align='center'><h2>内容</h2></td>
									<td><textarea name='message' id='message' calss='' cols='50' rows='5'></textarea></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align='center'><?=$_SESSION['n1']?> + <?=$_SESSION['n2']?> =</td>
									<td><input input='text' class='' name='' id=''/></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align='right' colspan='2'><input type='submit' name='button' id='button' value='提交'/></td>
								</tr>
							</table>
						</form>
						<?=$str?><img id='loading' src='img/ajax-load.gif' width='16' height='16' alt='loading'>
						<?=$success?>
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





<?php 
$this->start('css');
echo $this->Html->css('common');
echo $this->Html->css('index');
?>
<style>
.content_wrap {
	border: 1px solid #dfdfdf;
	padding: 5px 0;
}
.content_wrap li {
	padding: 0;
	margin: 0;
	height: 30px;
}
.content_wrap li:hover {
	padding: 10px;
	margin-bottom: 5px;
	position: relative;
	height: 50px;
	border-bottom: 1px dashed #dedede;
	border-top: 1px dashed #dedede;
}

.content_wrap li span.view_num {
	display: none;
}

.content_wrap li:hover span.view_num {
	position: absolute;
	right: 15px;
	bottom: 10px;
	font-size: 12px;
	color: #999;
	display: block;
}
.content_wrap li p.txt_box {
	margin: 0;
}
.content_wrap li:hover p.txt_box {
	padding-left: 5px;
}
.content_wrap li:hover p {
	margin: 0;
	padding: 0;
	float: left;
}
.content_wrap li p.txt_box a {
	display: block;
	color: #444;
	height: 30px;
	line-height: 30px;
	padding-left: 15px;
	width: 228px;
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
	text-decoration: none;
}
.content_wrap li:hover p.txt_box * {
	display: block;
}
.content_wrap li:hover p.txt_box a {
	padding: 0;
	color: #2f7eba;
	text-decoration: none;
	width: 243px;
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
}
.cleara:after, .clearb:before {
content: ".";
display: block;
height: 0;
clear: both;
visibility: hidden;
}
.content_wrap li:hover.firstLi {
    border-bottom: 1px dashed #dedede;
    border-top: 0
}

.content_wrap li:hover.lastLi {
    border-top: 1px dashed #dedede;
    border-bottom: 0
}


</style>
<?php
$this->end(); 

//bshare of the side
$this->start('bshare_side');
echo $this->element('bshare_side');
$this->end();

$this->start('script');
echo $this->Html->script('common');
echo $this->Html->script('index');
?>
<script>
$(function(){
	setFocusSlid('#focus_links', '#focus_img', 640, 'h');
	setDayCeshi();
	setTestSels('#day_sels .items');
	$('#id_subscribe_form').submit(subscribeSubmit);
	new Rollable('#id_fm_part', 640);
	new Rollable('#id_game_part', 640);
	new Rollable('#id_group_part', 640);
	$('img.lazyload').lazyload();
	$('#focus_us_a2').mouseenter(function(){
		$('#focus_us_weixin').show();
	});
	$('#focus_us_a3').mouseenter(function(){
		$('#focus_us_phone').show();
	});
	$('#focus_us_a2').mouseleave(function(){
		$('#focus_us_weixin').hide();
		
	});
	$('#focus_us_a3').mouseleave(function(){
		$('#focus_us_phone').hide();
	});
});
</script>
<?php
$this->end();

?>
<div class="main center_frame">
	<div class="mleft fl">
	    <div class="focus">
			<div id="focus_img">
				<div class="nbox">
					<?php foreach($recommend_entries as $entry): ?>
					<div class="focus_box">
						<div class="pbox">
							<a href="<?php echo $entry['RecommendContent']['url']; ?>">
								<img src="<?php echo $entry['RecommendContent']['picture']; ?>" width="300" height="200" hover="true" alt="<?php echo $entry['RecommendContent']['title']; ?>" style="opacity: 1;">
							</a>
						</div>
						<div class="descs">
							<a href="<?php echo $entry['RecommendContent']['url']; ?>"><?php echo $entry['RecommendContent']['title']; ?></a>
							<p class="intro">
								<?php echo $entry['RecommendContent']['abstract']; ?>
								<span class="fgrey">(7843人路过)</span>
							</p>
							
							<p class="rmd_read">
		                        <a href="http://www.xinli001.com/ceshi/416/">九型人格测试</a><br>
		               
		                    </p>
		                    
						</div>
					</div>
					<?php endforeach ?>

					
	
					
					
				</div>
			</div>
			<div id="focus_links">
		    	<ul>
		    		<?php 
		    		$num = sizeof($recommend_entries);
		    		for($tmp = 0; $tmp < $num; $tmp++):
		    		?>
		        	  <li class="act"><a href="javascript:void(0)" target="_self"></a></li>
		        	<?php endfor ?>
		    	
		    	<ul>
		    	</ul>
		    	</ul>
		    </div>
		</div>
		
	   	<div class="psy_goods">
			<div class="goods_box">
		    	
				<div class="goods fl">
					<h2 class="gt">
						<span class="fgreen">心理文章···</span>&nbsp; 
						(<a href="/webcontents/index" class="glink">更多</a>)&nbsp;
					</h2>
				    <div class="fg">
				    	
				    	
				    	
				    	
				    	<?php if($popular_article): ?>
				    	<p class="pbox">
				        	<a href="http://talk.xinli001.com/32764/"><img src="http://image.xinli001.com/20140113/094740474afaf55765e51a.jpg!195x130" width="195" height="130" alt="" hover="true" style="opacity: 1;"></a>
				       </p> 
				        <p><a href="/webcontents/view/<?php echo $popular_article['Webcontent']['id']; ?>" class="first"><?php echo $popular_article['Webcontent']['title']; ?></a></p>
				        <p class="plist">
				       	
				       
				    	
				        	<span class="fcn">·</span><a href="#" title=""></a><br>
				        	<span class="fcn">·</span><a href="#" title=""></a><br>
				        
				      
				        
				        </p>
				        <?php endif; ?>
				        
				        
				    </div>
				</div>

					        <!--part-->
					        
				<div class="goods fl">
					<h2 class="gt">
						<span class="fgreen">心理图片···</span>&nbsp; 
						(<a href="/webcontents/index" class="glink">更多</a>)&nbsp; 
					</h2>
				    <div class="fg">
				    	
				    	
				    	<?php if($popular_picture): ?>
				    	<p class="pbox">
				        	<a href="http://www.xinli001.com/oxygen/8600/"><img src="http://image.xinli001.com/20140114/175546fa012ca629987223.jpg!195x130" width="195" height="130" alt="" hover="true"></a>
				        </p>
				        <p><a href="/webcontents/view/<?php echo $popular_picture['Webcontent']['id']; ?>" class="first"><?php echo $popular_picture['Webcontent']['title']; ?></a></p>
				        <p class="plist">
				       	
				        
				
				    	
				        	<span class="fcn">·</span><a href="#" title=""></a><br>
				        	<span class="fcn">·</span><a href="#" title=""></a><br>
				        
				        
				        </p>
				        <?php endif; ?>
				        
				    </div>
				</div>

					        <!--part-->
					        
				<div class="goods fl">
					<h2 class="gt">
						<span class="fgreen">心理视频···</span>&nbsp; 
						(<a href="/webcontents/index" class="glink">更多</a>)&nbsp; 
					</h2>
				    <div class="fg">
				    	
				    	
				    	
				    	<?php if($popular_vedio): ?>
				    	<p class="pbox">
				        	<a href="http://www.xinli001.com/oxygen/8589/"><img src="http://image.xinli001.com/20140114/1558278901de92674880a5.jpg!195x130" width="195" height="130" alt="" hover="true"></a>
				        </p>
				        <p><a href="/webcontents/view/<?php echo $popular_vedio['Webcontent']['id']; ?>" class="first"><?php echo $popular_vedio['Webcontent']['title']; ?></a></p>
				        <p class="plist">
				       	
				    
				        	<span class="fcn">·</span><a href="#" title=""></a><br>
				        	<span class="fcn">·</span><a href="#" title=""></a><br>br>
				        
				        
				        </p>
				        <?php endif; ?>
				        
				    </div>
				</div>

		        <!--part-->
		    </div>
		</div> 

		<div class="middlead" style="padding-top:20px">
	    	<a href="http://www.xinli001.com/site/">
	    		<img src="http://image.xinli001.com/images/xinliquan.jpg" width="640" height="100">
	    	</a>
	    </div>
	    

		<div class="psy_part" id="id_group_part">
			<div class="psy_title">
				<span class="fgreen">专家团队······</span> &nbsp;
				(<a href="http://group.xinli001.com/" class="glink">更多</a>)&nbsp;
				<div class="roll">
					<a href="javascript:void(0)" class="arrow" title="后退" target="_self"></a><span class="act"></span><span></span><a href="javascript:void(0)" class="arrow aright ract" title="前进" target="_self"></a>
				</div>
			</div>
			<div class="roll_box">
				<div class="hbox">
					
					<div class="psy_group">
						<ul>
							
							<?php foreach($experts as $expert): ?>

							
							<li>
								<p class="pbox">
									<a href="/experts/view/<?php echo $expert['Expert']['id'];?>">
										<img alt="<?php echo $expert['Expert']['realname']; ?>" class="lazyload" src="<?php echo $expert['Expert']['avatar']; ?>"  width="80" height="80" hover="true" style="display: inline; opacity: 1;">
									</a>
								</p>
								<p>
									<a href="/experts/view/<?php echo $expert['Expert']['id'];?>" class="t" title="咨询师">咨询师：<?php echo $expert['Expert']['realname']; ?></a>
									<br>
									<span class="fgrey">擅长领域：<?php echo $expert['Expert']['profession']; ?></span>
									<br>
									<span class="links">
										<span class="fcn">·</span><a href="#" class="nlink"></a><br>
									</span>
									
								</p>
							</li>
							
							<?php endforeach ?>
							
							
						</ul>
					</div>
					<!--1-->
					
					
				</div>
				<!--hbox-->
			</div>
		</div>



	</div>

	<div class="mright fl">

		<div class="art_clock">
			<div class="dt">
				<span class="fgreen">新闻公告</span> &nbsp;
				(<a href="http://www.xinli001.com/daka/" class="glink">更多</a>)&nbsp;
			</div>
			<div class = 'content_wrap'>
				<ul>
					<?php
					$num = sizeof($news_and_anouncements);
					$temp = 1;
					foreach($news_and_anouncements as $news_and_anouncements_entry):
					?>
						<?php if($num == 1): ?>
                        <li class="cleara clearfix firstLi lastLi">
                        <?php elseif($temp == 1): ?>
                        <li class="cleara clearfix firstLi ">
                        <?php elseif($temp == $num): ?>
                        <li class="cleara clearfix lastLi">
                    	<?php else: ?>
                    	<li class="cleara clearfix">
                        <?php endif ?>
                            <span class="view_num"><?php echo $news_and_anouncements_entry['Webcontent']['browse_count']; ?>人看过</span>
                            <p class="txt_box">
                            <?php 
                            	echo $this->Html->link($news_and_anouncements_entry['Webcontent']['title'], '/webcontents/view/'.$news_and_anouncements_entry['Webcontent']['id']);
                            ?>
                            </p>
                        </li>
                    	<?php $temp++; ?>
                	<?php endforeach ?>
                        
                       
                    </ul>
			</div>
		</div>
		<!--学习打卡结束-->
		

		<div class="day_test">
			<div class="dt">
				<span class="fgreen">热门案例······</span> &nbsp;
				(<a href="http://www.xinli001.com/ceshi/" class="glink">更多</a>)&nbsp;
			</div>
		    
		    <?php foreach( $popular_cases as $case): ?>
		    <div class="ftest">
		    	<p class="pbox fl"><a href="/CaseArticles/view/<?php echo $case['CaseArticle']['id']; ?>">
		    		<img src="/img/cases_photos/<?php echo $case['CaseArticle']['photo']; ?>" width="90" height="60" hover="true" alt="<?php echo $case['CaseArticle']['title']; ?>">
		    	</a></p>
		    	<p>
		    		<a href="/CaseArticles/view/<?php echo $case['CaseArticle']['id']; ?>" title="<?php echo $case['CaseArticle']['title']; ?>"><?php echo $case['CaseArticle']['title']; ?></a>
		    		<br><span class="fgrey">来自<?php echo $case['CaseArticle']['source']; ?></span>
		    	</p>
		    </div>
		    <?php endforeach; ?>
		    
		    
		</div>
	    <!--每日一测-->
	    

	
		<br>
	    

		<div class="ads">
			
			<a href="http://murl.xinli001.com/aacgx/" target="_blank">
				<img src="http://image.xinli001.com/20140106/191219bc1f4fec762bdccb.jpg" width="280" height="160" hover="true" alt="看见隐形的力量" style="opacity: 1;">
			</a>
		</div>


		<div class="editor_rmd pt30">
			<div class="side_title">
				<span class="fgreen">最热词条······ </span>
			</div>
			
			<div class="editor_rmd_list fixed">
				<dl class="fixed">
					
					
					<dt>
						<a href="#" target="#"><img src="http://image.xinli001.com/20140107/092635da928204bbc15733.jpg" width="280" height="60" hover="true" alt="正能量"></a>
					</dt>
					
					
					<?php foreach($popular_entries as $encyclopedia_entry): ?>
					<dd>
						<a href="/EncyclopediaEntrys/view/<?php echo $encyclopedia_entry['EncyclopediaEntry']['id']; ?>" title="<?php echo $encyclopedia_entry['EncyclopediaEntry']['entry']; ?>"><?php echo $encyclopedia_entry['EncyclopediaEntry']['entry']; ?></a>
					</dd>
					<?php endforeach; ?>
					
					
					
				</dl>
			</div>
			<!-- template.cache.index-bianjire.d41d8cd98f00b204e9800998ecf8427e -->
		</div>
		<!--编辑推荐-->


	    <div class="side_title pt30">
			<span class="fgreen">关注我们······ </span>
		</div>

		<div class="focus_us">
			<ul>
				<li class="li_1">
					<a href="#" class="a1">
						<span></span>
						<div class="focus_us_t">
							<p>邮件</p>
						</div>
					</a>
				</li>
				<li>
					<div class="focus_us_weixin" id="focus_us_weixin" style="display: none;">
						<div class="">
							<img src="http://media.xinli001.com/images/index/w_1.1.jpg" width="150" height="150">
							<p>微信扫描，关注心理学与生活，在这里找到你内心的答案！</p>
						</div>
						<em class="">◆</em>
					</div>
					<a href="javascript:void(0)" class="a2" id="focus_us_a2">
						<span></span>
						<div class="focus_us_t">
							<p>微信</p>
						</div>
					</a>
				</li>
				<li>
					
					<div class="focus_us_phone" id="focus_us_phone" style="display: none;width:322px;height:186px;left:-240px;top:-230px;">
						<img src="http://media.xinli001.com/images/index/w_4.png" width="322" height="166">
						<em class="" style="top: 188px;left:256px">◆</em>
					</div>
					<a href="javascript:void(0)" class="a3" id="focus_us_a3">
						<span></span>
						<div class="focus_us_t">
							<p>手机</p>
						</div>
					</a>
				</li>
			</ul>
		</div>
	    <!--邮件订阅-->
	</div>
</div>
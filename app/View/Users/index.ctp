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
						(<a href="http://talk.xinli001.com/" class="glink">更多</a>)&nbsp;
					</h2>
				    <div class="fg">
				    	
				    	
				    	
				    	
				    	<p class="pbox">
				        	<a href="http://talk.xinli001.com/32764/"><img src="http://image.xinli001.com/20140113/094740474afaf55765e51a.jpg!195x130" width="195" height="130" alt="你觉得人生最好的投资是什么？" hover="true" style="opacity: 1;"></a>
				       </p> 
				        <p><a href="http://talk.xinli001.com/32764/" class="first">你觉得人生最好的投资是什么？</a></p>
				        <p class="plist">
				       	
				        
				        
				        
				    	
				    	
				        	<span class="fcn">·</span><a href="http://talk.xinli001.com/32632/" title="遇到低谷时，你是怎么熬过来的？">遇到低谷时，你是怎么熬过来的？</a><br>
				        
				        
				        
				        
				    	
				    	
				        	<span class="fcn">·</span><a href="http://talk.xinli001.com/32560/" title="你做什么事情时最自信？">你做什么事情时最自信？</a><br>
				        
				        
				        </p>
				        
				        
				        
				    </div>
				</div>

					        <!--part-->
					        
				<div class="goods fl">
					<h2 class="gt">
						<span class="fgreen">心理图片···</span>&nbsp; 
						(<a href="http://www.xinli001.com/oxygen/cure/" class="glink">更多</a>)&nbsp; 
					</h2>
				    <div class="fg">
				    	
				    	
				    	
				    	<p class="pbox">
				        	<a href="http://www.xinli001.com/oxygen/8600/"><img src="http://image.xinli001.com/20140114/175546fa012ca629987223.jpg!195x130" width="195" height="130" alt="森林中的可爱小精灵" hover="true"></a>
				        </p>
				        <p><a href="http://www.xinli001.com/oxygen/8600/" class="first">森林中的可爱小精灵</a></p>
				        <p class="plist">
				       	
				        
				        
				    	
				        	<span class="fcn">·</span><a href="http://www.xinli001.com/oxygen/8604/" title="走在市区的悬挂列车">走在市区的悬挂列车</a><br>
				        
				        
				        
				    	
				        	<span class="fcn">·</span><a href="http://www.xinli001.com/oxygen/8598/" title="陪人逛街也可以找点乐子">陪人逛街也可以找点乐子</a><br>
				        
				        
				        </p>
				        
				        
				    </div>
				</div>

					        <!--part-->
					        
				<div class="goods fl">
					<h2 class="gt">
						<span class="fgreen">心理视频···</span>&nbsp; 
						(<a href="http://www.xinli001.com/oxygen/daemon/" class="glink">更多</a>)&nbsp; 
					</h2>
				    <div class="fg">
				    	
				    	
				    	
				    	<p class="pbox">
				        	<a href="http://www.xinli001.com/oxygen/8589/"><img src="http://image.xinli001.com/20140114/1558278901de92674880a5.jpg!195x130" width="195" height="130" alt="1分钟让你学会小黄人洗脑歌" hover="true"></a>
				        </p>
				        <p><a href="http://www.xinli001.com/oxygen/8589/" class="first">1分钟让你学会小黄人洗脑歌</a></p>
				        <p class="plist">
				       	
				        
				        
				    	
				        	<span class="fcn">·</span><a href="http://www.xinli001.com/oxygen/8586/" title="DIG心理讲座(31)：还原男人味(中)">DIG心理讲座(31)：还原男人味(中)</a><br>
				        
				        
				        
				    	
				        	<span class="fcn">·</span><a href="http://www.xinli001.com/oxygen/8637/" title="兔子小姐和鹿先生">兔子小姐和鹿先生</a><br>
				        
				        
				        </p>
				        
				        
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
	    <div class="psy_part" id="id_fm_part">
			<div class="psy_title">
				<span class="fgreen">心理测试······</span> &nbsp;
				(<a href="http://fm.xinli001.com/" class="glink">更多</a>)&nbsp;
				<div class="roll">
					<a href="javascript:void(0)" class="arrow" title="后退" target="_self"></a><span class="act"></span><span></span><a href="javascript:void(0)" class="arrow aright ract" title="前进" target="_self"></a>
				</div>
			</div>
			<div class="roll_box">
				<div class="hbox">
				
				

					<div class="psy_fm">
						
						
						<div class="fbox">
							<p class="pbox">
								<a href="http://fm.xinli001.com/1385/"><img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140114/165945d7509fd0a4f7a160.jpg!200x200" width="195" height="195" hover="true"></a>
							</p>
							<p>
								<a href="http://fm.xinli001.com/1385/" class="fa">你既行为，必有其因</a>
								<span class="fgrey"> 文： <a href="http://www.xinli001.com/info/8513/">简里里</a> 
									&nbsp; 主播：
									 <a href="http://www.xinli001.com/user/114404/">晨曦</a>  </span>
									你无法不倚照你的潜意识去行为，但是你可以停下来，给自己个空间去思考：我为什么这么做？
								<br>
								<br>
								<span class="listen"></span><a href="http://fm.xinli001.com/1385/">立即收听</a>
							</p>
						</div>
						<div class="fm_list">
							<dl>
								
								
						
						
								<dd>
									<p class="pbox">
										<a href="http://fm.xinli001.com/1394/">
										<img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140114/17340778bded6396f43ac1.jpg!50" width="50" height="50" hover="true">
										</a>
									</p>
									<p class="descs">
										<a href="http://fm.xinli001.com/1394/" class="fa">睡前故事の小王子VOL9</a>
										<span class="fgrey">主播：纱朵&amp;峰小峰</span>
										<span class="more">
										<a href="http://fm.xinli001.com/1394/">收听</a>
										<span class="listen"></span>
										</span>
									</p>
								</dd>
								
								
						
						
								<dd>
									<p class="pbox">
										<a href="http://fm.xinli001.com/1352/">
										<img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140113/174802dfc1e5136e03d1d7.jpg!50" width="50" height="50" hover="true">
										</a>
									</p>
									<p class="descs">
										<a href="http://fm.xinli001.com/1352/" class="fa">过去的是假，留下的是真</a>
										<span class="fgrey">主播： <a href="http://www.xinli001.com/user/237194">子辕</a> </span>
										<span class="more">
										<a href="http://fm.xinli001.com/1352/">收听</a>
										<span class="listen"></span>
										</span>
									</p>
								</dd>
								
								
						
						
								<dd>
									<p class="pbox">
										<a href="http://fm.xinli001.com/1358/">
										<img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140113/180518c44b724c276a123e.jpg!50" width="50" height="50" hover="true">
										</a>
									</p>
									<p class="descs">
										<a href="http://fm.xinli001.com/1358/" class="fa">睡前故事の小王子VOL8</a>
										<span class="fgrey">主播：纱朵&amp;峰小峰</span>
										<span class="more">
										<a href="http://fm.xinli001.com/1358/">收听</a>
										<span class="listen"></span>
										</span>
									</p>
								</dd>
								
								
							</dl>
						</div>
						
						
					</div>
								<!--1-->
								
								

					<div class="psy_fm">
						
						
						<div class="fbox">
							<p class="pbox">
								<a href="http://fm.xinli001.com/1382/"><img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140111/180342a9fbbf4188476bf7.jpg!200x200" width="195" height="195" hover="true"></a>
							</p>
							<p>
								<a href="http://fm.xinli001.com/1382/" class="fa">最终依赖自己的力量成长</a>
								<span class="fgrey"> 文： <a href="http://www.xinli001.com/info/8750/">简里里</a> 
									&nbsp; 主播：
									 <a href="http://www.xinli001.com/user/1669226/">小怪</a>  </span>
									我也是脆弱和焦虑的。但终究，你还是会依赖自己的力量，和自己越长越像。
								<br>
								<br>
								<span class="listen"></span><a href="http://fm.xinli001.com/1382/">立即收听</a>
							</p>
						</div>
						<div class="fm_list">
							<dl>
								
								
						
						
								<dd>
									<p class="pbox">
										<a href="http://fm.xinli001.com/1384/">
										<img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140111/1808455bc630face20471e.jpg!50" width="50" height="50" hover="true">
										</a>
									</p>
									<p class="descs">
										<a href="http://fm.xinli001.com/1384/" class="fa">睡前故事の小王子VOL7</a>
										<span class="fgrey">主播： <a href="http://www.xinli001.com/user/742450/">峰_小峰</a> </span>
										<span class="more">
										<a href="http://fm.xinli001.com/1384/">收听</a>
										<span class="listen"></span>
										</span>
									</p>
								</dd>
								
								
						
						
								<dd>
									<p class="pbox">
										<a href="http://fm.xinli001.com/1368/">
										<img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140111/173812cf03ed828b9eb8ad.jpg!50" width="50" height="50" hover="true">
										</a>
									</p>
									<p class="descs">
										<a href="http://fm.xinli001.com/1368/" class="fa">焚一炷香，听一曲古筝</a>
										<span class="fgrey">主播： <a href="http://www.xinli001.com/user/619353/">周小猫</a> </span>
										<span class="more">
										<a href="http://fm.xinli001.com/1368/">收听</a>
										<span class="listen"></span>
										</span>
									</p>
								</dd>
								
								
						
						
								<dd>
									<p class="pbox">
										<a href="http://fm.xinli001.com/1372/">
										<img class="lazyload" src="http://media.xinli001.com/images/2013/grey.gif" data-original="http://image.xinli001.com/20140111/1755256a90d6c3f204e6c8.jpg!50" width="50" height="50" hover="true">
										</a>
									</p>
									<p class="descs">
										<a href="http://fm.xinli001.com/1372/" class="fa">睡前故事の小王子VOL6</a>
										<span class="fgrey">主播： <a href="http://www.xinli001.com/user/742450/">峰_小峰</a> </span>
										<span class="more">
										<a href="http://fm.xinli001.com/1372/">收听</a>
										<span class="listen"></span>
										</span>
									</p>
								</dd>
								
								
							</dl>
						</div>
						
						
					</div>
				<!--2-->
				</div>
			<!--hbox-->
			</div>
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
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/1/">
										<img alt="我们都是测试控" class="lazyload" src="http://imagexinli.b0.upaiyun.com/20120306/144143152123e1485d0dbb.jpg!80" data-original="http://imagexinli.b0.upaiyun.com/20120306/144143152123e1485d0dbb.jpg!80" width="80" height="80" hover="true" style="display: inline; opacity: 1;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/1/" class="t" title="我们都是测试控">我们都是测试控</a>
									<br>
									<span class="fgrey">成员：6520  话题：5255</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/1/14218/" class="nlink">专业测试：你的身体年龄几岁了？（女士版）</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/1/14198/" class="nlink">哈佛性向测试（专业测试）</a><br>
										
									</span>
								</p>
							</li>
							
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/10/">
										<img alt="心理咨询师成长营" class="lazyload" src="http://imagexinli.b0.upaiyun.com/20120306/1455495c9f5f2389a764be.jpg!80" data-original="http://imagexinli.b0.upaiyun.com/20120306/1455495c9f5f2389a764be.jpg!80" width="80" height="80" hover="true" style="display: inline; opacity: 1;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/10/" class="t" title="心理咨询师成长营">心理咨询师成长营</a>
									<br>
									<span class="fgrey">成员：1888  话题：245</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/10/6390/" class="nlink">沙盘中一些事物的象征意义(转，比较全)</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/10/1947/" class="nlink">我眼中的心理咨询，和路人眼中的心理咨询</a><br>
										
									</span>
								</p>
							</li>
							
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/6/">
										<img alt="心理学资料分享汇" class="lazyload" src="http://imagexinli.b0.upaiyun.com/20120306/1422347983ee63aa329333.jpg!80" data-original="http://imagexinli.b0.upaiyun.com/20120306/1422347983ee63aa329333.jpg!80" width="80" height="80" hover="true" style="display: inline;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/6/" class="t" title="心理学资料分享汇">心理学资料分享汇</a>
									<br>
									<span class="fgrey">成员：22782  话题：254</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/6/6250/" class="nlink">【TED演讲精选】看完这些心理讲座，你的内心也就强大了！</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/6/112/" class="nlink">看完这些视频你就半个心理学家了！ </a><br>
										
									</span>
								</p>
							</li>
							
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/5/">
										<img alt="非正常人类研究中心" class="lazyload" src="http://image.xinli001.com/20120910/17130930d5fb97c361207f.jpg!80" data-original="http://image.xinli001.com/20120910/17130930d5fb97c361207f.jpg!80" width="80" height="80" hover="true" style="display: inline; opacity: 1;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/5/" class="t" title="非正常人类研究中心">非正常人类研究中心</a>
									<br>
									<span class="fgrey">成员：10410  话题：399</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/5/6047/" class="nlink">10个心理游戏挑战你的大脑极限</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/5/1644/" class="nlink">假设你被困在了一个奇怪的房间里 </a><br>
										
									</span>
								</p>
							</li>
							
							
						</ul>
					</div>
					<!--1-->
					
					<div class="psy_group">
						<ul>
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/8/">
										<img alt="治愈系音乐" class="lazyload" src="http://imagexinli.b0.upaiyun.com/20120306/143128089bc5e4ff3874ef.jpg!80" data-original="http://imagexinli.b0.upaiyun.com/20120306/143128089bc5e4ff3874ef.jpg!80" width="80" height="80" hover="true" style="display: inline;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/8/" class="t" title="治愈系音乐">治愈系音乐</a>
									<br>
									<span class="fgrey">成员：3948  话题：223</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/8/652/" class="nlink">治愈歌曲 《小王子》歌曲 </a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/8/627/" class="nlink">[转] 治愈系歌曲，非常好听，非常难找。</a><br>
										
									</span>
								</p>
							</li>
							
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/9/">
										<img alt="犯罪心理学" class="lazyload" src="http://imagexinli.b0.upaiyun.com/20120306/1443050a08e0827cd0f1d3.jpg!80" data-original="http://imagexinli.b0.upaiyun.com/20120306/1443050a08e0827cd0f1d3.jpg!80" width="80" height="80" hover="true" style="display: inline;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/9/" class="t" title="犯罪心理学">犯罪心理学</a>
									<br>
									<span class="fgrey">成员：4212  话题：64</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/9/673/" class="nlink">群体犯罪心理——就在你我之间，当代国民群体的劣根性浅析</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/9/647/" class="nlink">如此犯罪心理学不研究也罢</a><br>
										
									</span>
								</p>
							</li>
							
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/17/">
										<img alt="壹心理官方小组" class="lazyload" src="http://image.xinli001.com/20121015/16504013478a66d2d516c4.jpg!80" data-original="http://image.xinli001.com/20121015/16504013478a66d2d516c4.jpg!80" width="80" height="80" hover="true" style="display: inline;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/17/" class="t" title="壹心理官方小组">壹心理官方小组</a>
									<br>
									<span class="fgrey">成员：92  话题：14</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/17/13813/" class="nlink">【Q&amp;A】壹心理投稿审稿系统释疑</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/17/1436/" class="nlink">小组管理员招募</a><br>
										
									</span>
								</p>
							</li>
							
							
							
							<li>
								<p class="pbox">
									<a href="http://group.xinli001.com/15/">
										<img alt="新人报道" class="lazyload" src="http://imagexinli.b0.upaiyun.com/20120326/132220967077bf633c4f1d.jpg!80" data-original="http://imagexinli.b0.upaiyun.com/20120326/132220967077bf633c4f1d.jpg!80" width="80" height="80" hover="true" style="display: inline;">
									</a>
								</p>
								<p>
									<a href="http://group.xinli001.com/15/" class="t" title="新人报道">新人报道</a>
									<br>
									<span class="fgrey">成员：255  话题：52</span>
									<br>
									<span class="links">
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/15/13802/" class="nlink">大家都是从哪里知道壹心理的阿？</a><br>
										
										<span class="fcn">·</span><a href="http://group.xinli001.com/15/13801/" class="nlink">留下你的微信，看看最近加你的人多不</a><br>
										
									</span>
								</p>
							</li>
							
							
						</ul>
					</div>
					<!--2-->
				</div>
				<!--hbox-->
			</div>
		</div>


		<div class="psy_part" id="id_game_part">
			<div class="psy_title">
				<span class="fgreen">心理游戏······</span> &nbsp;(<a href="http://www.xinli001.com/oxygen/game/" class="glink">更多</a>)&nbsp;
				<div class="roll">
					<a href="javascript:void(0)" class="arrow" title="后退" target="_self"></a><span class="act"></span><span></span><a href="javascript:void(0)" class="arrow aright ract" title="前进" target="_self"></a>
				</div>
			</div>
			<div class="roll_box">
				<div class="hbox">
					<div class="psy_test">
						<dl>
							
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/8471/"><img class="lazyload" src="http://image.xinli001.com/20131231/131526ca3a8ec1333dbeea.jpg!144x96" data-original="http://image.xinli001.com/20131231/131526ca3a8ec1333dbeea.jpg!144x96" width="144" height="96" alt="解谜游戏：萌萌要回家 BLYM" hover="true" style="display: block; opacity: 1;"></a>
					            <a href="http://www.xinli001.com/oxygen/8471/" class="nlink" title="解谜游戏：萌萌要回家 BLYM">解谜游戏：萌萌要回家 BLYM</a>
							</dd>
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/2771/"><img class="lazyload" src="http://image.xinli001.com/20121222/15043740f52fcd26270dee.jpg!144x96" data-original="http://image.xinli001.com/20121222/15043740f52fcd26270dee.jpg!144x96" width="144" height="96" alt="圣诞小游戏：爱跳舞的圣诞老人" hover="true" style="display: block; opacity: 1;"></a>
					            <a href="http://www.xinli001.com/oxygen/2771/" class="nlink" title="圣诞小游戏：爱跳舞的圣诞老人">圣诞小游戏：爱跳舞的圣诞老人</a>
							</dd>
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/7700/"><img class="lazyload" src="http://image.xinli001.com/20131206/1125069f3131b189f41fed.jpg!144x96" data-original="http://image.xinli001.com/20131206/1125069f3131b189f41fed.jpg!144x96" width="144" height="96" alt="我的女友是僵尸2  I Saw Her Too With Lasers" hover="true" style="display: block; opacity: 1;"></a>
					            <a href="http://www.xinli001.com/oxygen/7700/" class="nlink" title="我的女友是僵尸2  I Saw Her Too With Lasers">我的女友是僵尸2  I Saw Her Too With Lasers</a>
							</dd>
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/7435/"><img class="lazyload" src="http://image.xinli001.com/20131123/230055cee9d84c7fa8e8da.jpg!144x96" data-original="http://image.xinli001.com/20131123/230055cee9d84c7fa8e8da.jpg!144x96" width="144" height="96" alt="解谜游戏：企鹅和钥匙（Me and the key 3）" hover="true" style="display: block;"></a>
					            <a href="http://www.xinli001.com/oxygen/7435/" class="nlink" title="解谜游戏：企鹅和钥匙（Me and the key 3）">解谜游戏：企鹅和钥匙（Me and the key 3）</a>
							</dd>
							
						</dl>
					</div>
					<!--1-->
					<div class="psy_test">
						<dl>
							
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/7305/"><img class="lazyload" src="http://image.xinli001.com/20131117/19001863e51bbbb1a024f1.jpg!144x96" data-original="http://image.xinli001.com/20131117/19001863e51bbbb1a024f1.jpg!144x96" width="144" height="96" alt="逆向思维游戏：坑爹之靴（Reverse Boots）" hover="true" style="display: block;"></a>
					            <a href="http://www.xinli001.com/oxygen/7305/" class="nlink" title="逆向思维游戏：坑爹之靴（Reverse Boots）">逆向思维游戏：坑爹之靴（Reverse Boots）</a>
							</dd>
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/7151/"><img class="lazyload" src="http://image.xinli001.com/20131109/220718f0e6304100053147.jpg!144x96" data-original="http://image.xinli001.com/20131109/220718f0e6304100053147.jpg!144x96" width="144" height="96" alt="解谜游戏：笼中鸟 White Cage" hover="true" style="display: block;"></a>
					            <a href="http://www.xinli001.com/oxygen/7151/" class="nlink" title="解谜游戏：笼中鸟 White Cage">解谜游戏：笼中鸟 White Cage</a>
							</dd>
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/6044/"><img class="lazyload" src="http://image.xinli001.com/20131009/21140442ecebf4bf049207.jpg!144x96" data-original="http://image.xinli001.com/20131009/21140442ecebf4bf049207.jpg!144x96" width="144" height="96" alt="解谜游戏：司空摘星9" hover="true" style="display: block;"></a>
					            <a href="http://www.xinli001.com/oxygen/6044/" class="nlink" title="解谜游戏：司空摘星9">解谜游戏：司空摘星9</a>
							</dd>
							
							<dd>
					        	<a href="http://www.xinli001.com/oxygen/4939/"><img class="lazyload" src="http://image.xinli001.com/20130905/1804048689a739fe781ed8.jpg!144x96" data-original="http://image.xinli001.com/20130905/1804048689a739fe781ed8.jpg!144x96" width="144" height="96" alt="动作游戏：逃离噩梦（escape from nightmare）" hover="true" style="display: block;"></a>
					            <a href="http://www.xinli001.com/oxygen/4939/" class="nlink" title="动作游戏：逃离噩梦（escape from nightmare）">动作游戏：逃离噩梦（escape from nightmare）</a>
							</dd>
							
						</dl>
					</div>
					<!--2-->
				</div>
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
		    
		    
		    <div class="ftest">
		    	<p class="pbox fl"><a href="http://www.xinli001.com/ceshi/680/">
		    		<img src="http://image.xinli001.com/20121106/1807041f78ef06a01009c8.jpg!90x60" width="90" height="60" hover="true" alt="MBTI测试：哪类异性更适合你？">
		    	</a></p>
		    	<p>
		    		<a href="http://www.xinli001.com/ceshi/680/" title="MBTI测试：哪类异性更适合你？">MBTI测试：哪类异性更...</a>
		    		<br><span class="fgrey">此测试结果仅对会员开放</span>
		    	</p>
		    </div>
		    
		    
		    <form id="id_day_ceshi_form" action="http://www.xinli001.com/ceshi/680/start/" method="post">
		        <div id="day_sels">
		        	1、你倾向从何处得到力量：<br>
		        	
		            <p class="items"><input type="radio" value="27829" name="choice">
		            <label>别人</label></p>
		            
		            <p class="items"><input type="radio" value="27830" name="choice">
		            <label>自己的想法</label></p>
		            
		        </div>
		    </form>
		    
		    <p class="day_btns"><a id="id_ceshi_next" href="javascript:void(0)" class="next">下一题</a></p>
		    
		</div>
	    <!--每日一测-->
	    

		<div class="rmd pt30">
			<div class="side_title">
				<span class="fgreen">你问我答······ </span> &nbsp;(<a href="http://qa.xinli001.com/" class="glink">更多</a>)
			</div>
			<div class="qa_list">
				<ul>
					
					
					<li>
						<a href="http://qa.xinli001.com/158574/" class="fa">怎样化解南北方朋友之间的思想差异？</a>
						<br>
						<span class="fgrey">来自 <a href="http://www.xinli001.com/user/6027974/">月下玫瑰</a></span>
						<span class="answer">6</span>
					</li>
					
					<li>
						<a href="http://qa.xinli001.com/158518/" class="fa">害怕出门见人怎么办？</a>
						<br>
						<span class="fgrey">来自 <a href="http://www.xinli001.com/user/5766248/">蒲公英coco</a></span>
						<span class="answer">5</span>
					</li>
					
					<li>
						<a href="http://qa.xinli001.com/158319/" class="fa">为什么遇到比自己强的人，总是那么的自卑？</a>
						<br>
						<span class="fgrey">来自 <a href="http://www.xinli001.com/user/5942337/">醉爱OL</a></span>
						<span class="answer">10</span>
					</li>
					
					<li>
						<a href="http://qa.xinli001.com/158338/" class="fa">如何与喜欢的女生交往？</a>
						<br>
						<span class="fgrey">来自 <a href="http://www.xinli001.com/user/1818805/">项敏</a></span>
						<span class="answer">4</span>
					</li>
					
				</ul>
			</div>
		</div>
		<!--心理问答-->
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
						<a href="http://murl.xinli001.com/aacgy/" target="_blank"><img src="http://image.xinli001.com/20140107/092635da928204bbc15733.jpg" width="280" height="60" hover="true" alt="正能量"></a>
					</dt>
					
					
					
					<dd>
						<a href="http://view.xinli001.com/procrastination/" title="一起战胜万恶的拖延症">一起战胜万恶的拖延症</a>
					</dd>
					
					<dd>
						<a href="http://view.xinli001.com/love/" title="地球人搞对象攻略">地球人搞对象攻略</a>
					</dd>
					
					<dd>
						<a href="http://www.xinli001.com/info/2534/" title="如何学习心理学？">如何学习心理学？</a>
					</dd>
					
					<dd>
						<a href="http://app.xinli001.com/hole/" title="树洞：说出你的秘密">树洞：说出你的秘密</a>
					</dd>
					
					<dd>
						<a href="http://app.xinli001.com/smile/" title="微笑墙：一起自曝真相">微笑墙：一起自曝真相</a>
					</dd>
					
					<dd>
						<a href="http://app.xinli001.com/empty/" title="减压游戏：放空一分钟">减压游戏：放空一分钟</a>
					</dd>
					
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
					<a href="http://list.qq.com/cgi-bin/qf_invite?id=88908245092044edb3b24bc5788b7693ad7181deace8a029" class="a1">
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
<?php $this->start('css'); ?>
<style>
	.main-header-search {
		margin-top: 10px;
		margin-bottom: 10px;
		box-shadow: 5px 5px 5px #f3f3f4;
		background-color: #cccccc;
		background-image: url("http://i.imgur.com/zqZfaSF.png");
		background-position: 10px center;
		background-repeat: no-repeat;
		height: 60px;
	}

	.main-header-search input {
		background-color: transparent;
		border: 0;
		font-size: 1.25em;
		font-weight: 200;
		height: 100%;
		outline: 0;
		padding: 0 10px 0 50px;
		width: 100%;
	}
	
	input[type="search"] {
		-webkit-appearance: textfield;
		-moz-box-sizing: content-box;
	}

	.category-name {
		font-size: 30px;
		color: #106C91;
		width: auto;
		display: inline-block;
		padding-right: 20px;
	}
	
	a.read-more {
		float: left;
		margin-top: 30px;
		width: 83px;
		height: 31px;
		background-image: url(../img/more_info.png);
		background-position: 0 0;
		background-repeat: no-repeat;
	}
	
	a.read-more:hover {
		background-image: url(../img/more_info_hover.png);
		background-position: 0 0;
		background-repeat: no-repeat;
	}
</style>
<?php $this->end(); ?>

<div id="main_contant">
	<div class="center_frame">

		<form action="/search/" method="post" class="main-header-search">
			<input type="search" name="data[keyword]" placeholder="想要找什么？输入关键词然后按回车~">
			<input type="hidden" name="data[type]" value="2">
		</form>
		
		<div class="box_1">
			<div class="text" style="margin-left: 30px; width: 624px;">
				<h6 style="margin-top: 30px;">最新添加</h6>
				<div class="entry-left" style="float: left; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
				<div class="entry-right" style="float: right; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
				<div class="entry-left" style="float: left; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
				<div class="entry-right" style="float: right; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
			</div>
			<table style="float: right">
				<tr><td><img src="/img/box_1.png" alt="" class="main_img_1" style="height: 260px"></td></tr>
				<tr><td><a href="#" style="margin-top: 10px;"></a></td></tr>
			</table>
		</div>
		
		<div class="box_2" >
			<table style="float: left">
				<tr><td><img src="/img/box_2.png"  style="height: 260px" alt="" class="main_img_2"></td></tr>
				<tr><td><a href="#"  style="float:right; margin-top: 10px;"></a></td></tr>
			</table>
			<div class="text_2" style="margin-right: 30px; width: 624px;">
				<h6 style="margin-top: 30px;">热门词条</h6>
				<div class="entry-left" style="float: left; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
				<div class="entry-right" style="float: right; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
				<div class="entry-left" style="float: left; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
				<div class="entry-right" style="float: right; width: 300px">
					<h5 style="width: auto;">slax</h5>
					<p style="width: auto;">Come down to our clinic today and we will insert your new favourite.</p>
				</div>
			</div>
		</div>
		
		<a name='fff'></a>
		<div class="box_3">
			<div class="text" style="margin-left: 30px; width: 624px;">
				<h6 style="margin-top: 30px;">分类浏览</h6>
				<div style="margin-left: 10px; float:left; width: 620px; height: 90%">
					<?php
					for($i=0;$i<20;$i++) {
						echo '<h4 class="category-name"><a href="#fff" style="float: none;">Slax</a></h4>';
					}
					?>
				</div>
			</div>
			<table style="float: right; margin-right: 35px;">
				<tr><td><img src="/img/books.png" alt="" class="main_img_3" style="height: 240px"></td></tr>
				<tr><td><a class="read-more" href="/encyclopediaentries/category" style="margin-top: 10px;"></a></td></tr>
			</table>
		</div>
	</div>
</div>
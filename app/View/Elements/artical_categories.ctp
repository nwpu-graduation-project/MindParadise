<div id="blog_cat" class="blog_side_bg">
	<h4>文章分类</h4>
	<ul id="categories">
<?php
$categories = array('0' => '全部','1' => '文章','2' => '新闻','3' => '视频','4' => '图片');
foreach ($categories as $key => $value) {
	if($current == $key) {
		echo '<li><a href="/webcontents/category/'.$key.'" class="active">'.$value.'</a></li>';
	} else {
		echo '<li><a href="/webcontents/category/'.$key.'">'.$value.'</a></li>';
	}
}
?>
	</ul>
</div>

<div id="blog_cat" class="blog_side_bg">
	<h4>文章分类</h4>
	<ul id="categories">
<?php
$categories = $this->requestAction('/webcontents/getCategories');
foreach ($categories as $key => $value) {
	if($current == $key) {
		echo '<li><a href="/webcontents/category/'.$key.'#blog_right" class="active">'.$value.'</a></li>';
	} else {
		echo '<li><a href="/webcontents/category/'.$key.'#blog_right">'.$value.'</a></li>';
	}
}
?>
	</ul>
</div>

<!-- a simple div with some links -- >
<div class="breadcrumb flat"></div -->

<div id="catrgoy_holder" class="breadcrumb">
	<?php
	echo '<a href="/encyclopediaentries/category/" href="#catrgoy_holder">全部分类</a>';
	if($categoryID != NULL) {
		$array = $this->requestAction('/categories/getAncestors/'.$categoryID);
		while (count($array) > 1) {
			$category = array_pop($array);
			echo '<a href="/encyclopediaentries/category/'.$category['Category']['id'].'">'.
				$category['Category']['name'].'</a>';
		}
		$category = array_pop($array);
			echo '<a class="active" href="/encyclopediaentries/category/'.$category['Category']['id'].'">'.
				$category['Category']['name'].'</a>';
	}
	?>
</div>

<!-- Prefixfree -->
<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript">
</script>
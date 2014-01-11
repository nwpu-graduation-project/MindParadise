<!-- a simple div with some links -- >
<div class="breadcrumb flat"></div -->
<?php $array = $this->requestAction('/categories/getAncestors/'.$categoryID); 
?>
<!-- another version - flat style with animated hover effect -->
<div id="catrgoy_holder" class="breadcrumb">
	<?php
	while (count($array) > 1) {
		echo '<a href="#">'.array_pop($array).'</a>';
	}
	echo '<a href="#" class="active">'.array_pop($array).'</a>';
	?>
</div>

<!-- Prefixfree -->
<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript">
</script>
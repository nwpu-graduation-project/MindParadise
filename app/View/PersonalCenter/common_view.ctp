<?php $this->start('css');?>
<style>
.text{
	float: none;
	margin-left: 0px;
}
</style>
<?php $this->end();?>

<!-- BLOG_CONTENT START HERE -->
<div id="blog_content">
	<!-- CENTER_FRAME START HERE -->
	<div class="center_frame">
		<!-- BLOG_LEFT START HERE -->
		<div id="blog_left">
			<?php echo $this->fetch('sidebar'); ?>
		</div>
		<!-- BLOG_LEFT END HERE -->
		<!-- BLGG_RIGHT START HERE -->
		<div id="blog_right">
			<?php echo $this->fetch('content'); ?>
		</div>
		<!-- BLOG_RIGHT END HERE -->
	</div>
	<!-- CENTER_FRAME END HERE -->
</div>
<!-- BLOG_CONTENT END HERE -->

<div id="all_tags_container" class = "center_frame" style="width: 50%">
	<ul id="plpular_tags_icon" style="width: 100%">
<?php foreach ($tags as $tag): ?>
<li><a href="/webcontents/tag/<?php echo $tag['Tag']['id']; ?>"><span><?php echo $tag['Tag']['tag']; ?></span></a></li>
<?php
endforeach;
unset($tag);
?>
	</ul>
</div>

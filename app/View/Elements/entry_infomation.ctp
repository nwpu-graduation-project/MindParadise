<div id="entryInfoDiv" class="blog_side_bg">
	<h4>词条信息</h4>
	<br><br>
	<ul>
		<li>创建者：<?php echo $entry['Author']['username']; ?></li>
		<li>创建时间：<?php echo $entry['EncyclopediaEntry']['modified']; ?></li>
		<li>修改时间：<?php echo $entry['EncyclopediaEntry']['created']; ?></li>
		<li>浏览量：<?php echo $entry['EncyclopediaEntry']['browse_count']; ?></li>
	</ul>
</div>

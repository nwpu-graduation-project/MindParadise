<?php $webcontents = $this->requestAction('/webcontents/getMostViewedArticals');
?>

<div id="polular" class="blog_side_bg">
	<h4>浏览最多</h4>
	
	<?php foreach ($webcontents as $key => $value) : ?>
	
	<span class="margin">
		<strong>
		<?php
		echo //$this->Html->link(
			$value['Webcontent']['title'];//,
			//'/webcontents/view/'.$value['Webcontent']['id']);
		?>
		</strong>
		<?php
		
		$str = $value['Webcontent']['abstract'];
		if(mb_strlen($str,'utf-8') > 45) {
			$str = mb_substr($str, 0, 41, 'utf-8').'...';
		}
		echo $this->Html->link($str,'/webcontents/view/'.$value['Webcontent']['id']); ?>
	</span>
	
	<?php endforeach; ?>
</div>
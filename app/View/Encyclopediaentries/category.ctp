<?php
$this->start('css');
echo $this->Html->css('breadcrumb-category');
$this->end();

$this->start('script');
$this->end();
?>

	<div id="blog_content">
		<div class="center_frame">
			
			<div id="blog_left">
				<div id="entryIndex" class="blog_side_bg">
					<h2 style="font-size: 30px;height: 36px; margin-bottom: 5px;">分类</h2>
					<ul>
					<?php
					if(!$childCategories) {
						echo '没有子分类了';
					} else {
						foreach ($childCategories as $key => $value) {
							echo '<li><a href="/encyclopediaentries/category/'.$value['Category']['id'].'"'.
								'style="float: none;">'.$value['Category']['name'].'</a></li>';
						}
					}
					?>
					</ul>
				</div>
			</div>
			
			<?php
				echo $this->element('breadcrumb_category', array('categoryID' => $currentCategory));
			?>
				
			<div id="blog_right">
				
				<div class="post_blog">
					<?php
					if(!$entries) {
						echo '<h2>该分类下没有词条</h2>';
					} else {
						foreach ($entries as $key => $value) {
							echo '<h2><a href="/encyclopediaentries/view/'.$value['EncyclopediaEntry']['id'].'"'.
								'style="float: none;">'.$value['EncyclopediaEntry']['entry'].'<?a></h2>';
						}
					}
					?>
				</div>
			</div>
			
		</div>
	</div>
	<div id="page_navigation">
    <div class="center_frame"> <a href="/encyclopediaentries/index" class="leave_back"></a> </div>
    </div>
</div>
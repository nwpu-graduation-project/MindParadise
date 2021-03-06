<?php
$this->start('css');
echo $this->Html->css('treeview');
echo '<link rel="stylesheet" type="text/css" href="/css/breadcrumb-category.css">';
?>

<style>

table {
    display:table;
    margin-left:auto;
    margin-right:auto;
    border-collapse: collapse;
}

thead {
    font-weight:lighter;
    background-color:#404853;
    color:white;
}

td, th {
    padding:6px;
}

tbody tr th {
    font-weight:lighter;
    background-color:#404853;
    color:white;
    border-top:1px solid #c6c9cc;
    padding:6px;
}

tbody tr td {
    background-color:#e8eae9;
}

</style>

<?php
$this->end();

$this->start('script');
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
echo $this->Html->script('treeview');
$this->end();
?>

	<div id="blog_content">
		<div class="center_frame">
			
			<div id="blog_left">
				<div id="entryIndex" class="blog_side_bg">
				<h2 style="font-size: 30px;height: 36px; margin-bottom: 5px;">目录</h2>
				<?php echo $indexPage; ?>
				</div>
				
				<?php echo $this->element('entry_infomation',array('entry' => $entry)); ?>
			</div>
			
			<?php echo $this->element('breadcrumb_category',
				array('categoryID' => $entry['EncyclopediaEntry']['category_id'])); ?>
				
			<div id="blog_right">
				
				<div class="post_blog">
					<h2><?php echo $entry['EncyclopediaEntry']['entry']; ?></h2>
				</div>
				
				<div class="entry_view" style="width: 100%; padding-left: 5px">
					<?php echo $page; ?>
				</div>
			</div>
			
		</div>
	</div>
	<div id="page_navigation">
    <div class="center_frame"> <a href="/encyclopediaentries/index" class="leave_back"></a> </div>
    </div>
</div>
<?php
$this->start('css');
echo '<link rel="stylesheet" type="text/css" href="/ueditor_mini/themes/default/css/umeditor.min.css">';
?>
<style type="text/css">
	.edui-container {
		border: none;
		box-shadow: none;
	} 
</style>
<?php
echo $this->Html->css('treeview');
$this->end();

$this->start('script');
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
echo '<script src="/ueditor_mini/umeditor.config.js"></script>';
echo '<script src="/ueditor_mini/umeditor.min.js"></script>';
// for category_selector
echo $this->Html->script('treeview');
$this->end();
?>

<div id="" style="float: none">
	
	<div id="left" style="float: left">
<?php echo $this->element('category_selector'); ?>
	</div>
	
	<form action="/encyclopediaentries/add" id="WebcontentAddForm" method="post" accept-charset="utf-8">
	<input type="hidden" name="data[category_id]" value="1"/>
	<div id="editorContainer" name="editorContainerDiv" style="width: 70%;float: left">
		<input type="text" name="data[entry]" maxlength="10" placeholder="词条名" style="font-size: 36px"/>
		<div>
		<script type="text/plain" id="pageEditor" name="data[entryPage]" style="width:100%; height:900px;">
			heheh
		</script>
		</div>
		<script type="text/javascript">
			var um = UM.getEditor("pageEditor");
		</script>
		<input type="submit" value="提交">
	</div>
	
	</form>

</div>
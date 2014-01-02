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
$this->end();

$this->start('script');
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
echo '<script src="/ueditor_mini/umeditor.config.js"></script>';
echo '<script src="/ueditor_mini/umeditor.min.js"></script>';
?>

<?php
$this->end();
?>

<div id="" style="float: none">
	
	<div id="left" style="float: left">
		<ul>
		<?php echo 'hehehehehehehehehehehehehehe'; ?>
		<li><input type="text" /></li>
		<li><input type="button" value="create node"/></li>
		<li><input type="button" value="create child"/></li>
		</ul>
	</div>
	
	<form action="/encyclopediaentries/add" id="WebcontentAddForm" method="post" accept-charset="utf-8">
	<input type="hidden" name="data[category_id]"/>
	<div id="editorContainer" name="editorContainerDiv" style="width: 70%;float: left">
		<input type="text" name="data[entry]" maxlength="10" placeholder="Entry Name" style="font-size: 36px"/>
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
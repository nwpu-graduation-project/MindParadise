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
?>

<script>
	var headings = ["H1", "H2", "H3", "H4", "H5", "H6"];
	
	function genIndex () {
		var divNode = document.getElementById("pageEditor")
		var headings = ["h1", "h2", "h3", "h4", "h5", "h6"];
		for(index=0;index<headings.length;index++) {
			var headingNodes = UM.dom.domUtils.getElementsByTagName(divNode, headings[index]);
			for(i=0; i<headingNodes.length; i++) {
				// alert(headingNodes[i].innerHTML);
				headingNodes[i].id = 'heading_'+ headings[index]+'_'+i;
			}
		}
		genTree( document.getElementById("pageEditor"));
	}
	
	function genTree(pnode) {
		var nodes = pnode.childNodes;
		for(index=0;index<nodes.length;index++) {
			// alert(nodes[index].tagName);
			if(nodes[index].tagName == 'H1')
			if(nodes[index].hasChildNodes()) {
				genTree(nodes[index]);
			}
		}
	}
</script>

<?php
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
<h1>hehe</h1>
		</script>
		</div>
		<script type="text/javascript">
			var um = UM.getEditor("pageEditor");
		</script>
		<input type="button" onclick="genIndex()" value="生成目录">
		<input type="submit" value="提交">
	</div>
	
	</form>

</div>
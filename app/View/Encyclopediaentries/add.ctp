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
	function genIndex () {
		var divNode = document.getElementById("pageEditor")
		var headings = ["h1", "h2", "h3", "h4", "h5", "h6"];
		for(index=0;index<headings.length;index++) {
			var headingNodes = UM.dom.domUtils.getElementsByTagName(divNode, headings[index]);
			for(i=0; i<headingNodes.length; i++) {
				headingNodes[i].id = 'heading_'+ headings[index]+'_'+i;
			}
		}
	}
	
	function selectID(id) {
		var element = document.getElementById("selectedCategoryId");
		element.value = id;
		
		var nameInput = document.getElementById("categoryName");
		nameInput.value = document.getElementById("category_"+id).textContent;
	}
	
	function setPlainText() {
		
		var divNode = document.getElementById("pageEditor")
		var headings = ["h1", "h2", "h3", "h4", "h5", "h6"];
		for(index=0;index<headings.length;index++) {
			var headingNodes = UM.dom.domUtils.getElementsByTagName(divNode, headings[index]);
			for(i=0; i<headingNodes.length; i++) {
				// alert(headingNodes[i].innerHTML);
				headingNodes[i].id = 'heading_'+ headings[index]+'_'+i;
			}
		}
		alert(um.getContent());
		var element = document.getElementById("plainText");
		element.value = um.getContentTxt();
		return true;
	}
</script>

<?php
$this->end();
?>

<div id="" style="float: none">
	
	<div id="left" style="float: left">
<?php echo $this->element('category_selector'); ?>
	</div>
	
	<form action="/encyclopediaentries/add" id="entryAddForm" method="post"
		accept-charset="utf-8" onsubmit="return setPlainText()">
	<input type="hidden" id="selectedCategoryId" name="data[category_id]" />
	<input type="hidden" id="plainText" name="data[plainText]" />
	<div id="editorContainer" name="editorContainerDiv" style="width: 70%;float: left">
		<input type="text" name="data[entry]" maxlength="10" placeholder="词条名" style="font-size: 36px"/>
		<label for="">分类</label>
		<input type="text" id="categoryName" disabled="disabled" style="font-size: 24px"/>
		<div>
		<script type="text/plain" id="pageEditor" name="data[entryPage]" style="width:100%; height:900px;">
<h1>hehe</h1>
		</script>
		</div>
		<script type="text/javascript">
			var um = UM.getEditor("pageEditor");
			
		</script>
		<input type="button" onclick="hehe()" value="hehe">
		<input type="submit" value="提交">
	</div>
	
	</form>

</div>